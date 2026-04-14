<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('POST');

$body = read_json_body();

$firstName = trim((string)($body['first_name'] ?? ''));
$lastName = trim((string)($body['last_name'] ?? ''));
$email = strtolower(trim((string)($body['email'] ?? '')));
$password = (string)($body['password'] ?? '');
$confirmPassword = (string)($body['confirm_password'] ?? '');

if ($firstName === '' || $lastName === '' || $email === '' || $password === '') {
    respond_json(422, ['ok' => false, 'message' => 'All required fields must be provided.']);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond_json(422, ['ok' => false, 'message' => 'Please provide a valid email address.']);
}

if (strlen($password) < 8) {
    respond_json(422, ['ok' => false, 'message' => 'Password must be at least 8 characters.']);
}

if ($password !== $confirmPassword) {
    respond_json(422, ['ok' => false, 'message' => 'Password confirmation does not match.']);
}

try {
    $pdo = artisan_db();

    $check = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $check->execute([':email' => $email]);
    if ($check->fetch()) {
        respond_json(409, ['ok' => false, 'message' => 'An account with this email already exists.']);
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        'INSERT INTO users (first_name, last_name, email, password_hash, role) VALUES (:first_name, :last_name, :email, :password_hash, :role)'
    );
    $stmt->execute([
        ':first_name' => $firstName,
        ':last_name' => $lastName,
        ':email' => $email,
        ':password_hash' => $hash,
        ':role' => 'customer',
    ]);

    respond_json(201, [
        'ok' => true,
        'message' => 'Account created successfully.',
        'data' => [
            'id' => (int)$pdo->lastInsertId(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'role' => 'customer',
        ],
    ]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to create account.']);
}
