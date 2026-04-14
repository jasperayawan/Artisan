<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('POST');

$body = read_json_body();
$name = trim((string)($body['name'] ?? ''));
$email = strtolower(trim((string)($body['email'] ?? '')));
$subject = optional_string($body, 'subject');
$message = trim((string)($body['message'] ?? ''));

if ($name === '' || $email === '' || $message === '') {
    respond_json(422, ['ok' => false, 'message' => 'Name, email, and message are required.']);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond_json(422, ['ok' => false, 'message' => 'Please provide a valid email address.']);
}

if (mb_strlen($message) < 10) {
    respond_json(422, ['ok' => false, 'message' => 'Message is too short.']);
}

$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$ua = $_SERVER['HTTP_USER_AGENT'] ?? null;

try {
    $pdo = artisan_db();

    // Basic abuse protection: limit rapid repeats by IP.
    if ($ip) {
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) AS c
             FROM contact_messages
             WHERE ip_address = :ip
               AND created_at >= (NOW() - INTERVAL 60 SECOND)'
        );
        $stmt->execute([':ip' => $ip]);
        $count = (int)($stmt->fetch()['c'] ?? 0);
        if ($count >= 5) {
            respond_json(429, ['ok' => false, 'message' => 'Too many messages. Please wait a moment and try again.']);
        }
    }

    $insert = $pdo->prepare(
        'INSERT INTO contact_messages (name, email, subject, message, ip_address, user_agent, status)
         VALUES (:name, :email, :subject, :message, :ip, :ua, :status)'
    );
    $insert->execute([
        ':name' => $name,
        ':email' => $email,
        ':subject' => $subject,
        ':message' => $message,
        ':ip' => $ip,
        ':ua' => $ua ? mb_substr((string)$ua, 0, 255) : null,
        ':status' => 'new',
    ]);

    respond_json(201, ['ok' => true, 'message' => 'Message received.']);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to send message.']);
}

