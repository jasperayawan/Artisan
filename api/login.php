<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('POST');

$body = read_json_body();
$email = strtolower(trim((string)($body['email'] ?? '')));
$password = (string)($body['password'] ?? '');

if ($email === '' || $password === '') {
    respond_json(422, ['ok' => false, 'message' => 'Email and password are required.']);
}

try {
    $pdo = artisan_db();
    $stmt = $pdo->prepare(
        'SELECT id, first_name, last_name, email, role, password_hash FROM users WHERE email = :email LIMIT 1'
    );
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, (string)$user['password_hash'])) {
        respond_json(401, ['ok' => false, 'message' => 'Invalid email or password.']);
    }

    respond_json(200, [
        'ok' => true,
        'message' => 'Login successful.',
        'data' => [
            'id' => (int)$user['id'],
            'first_name' => (string)$user['first_name'],
            'last_name' => (string)$user['last_name'],
            'email' => (string)$user['email'],
            'role' => (string)$user['role'],
        ],
    ]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Login failed.']);
}
