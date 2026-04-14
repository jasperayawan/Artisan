<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('GET');

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 100;
if ($limit < 1) {
    $limit = 100;
}
if ($limit > 500) {
    $limit = 500;
}

try {
    $pdo = artisan_db();
    $sql = "SELECT id, name, email, subject, message, status, created_at
            FROM contact_messages
            ORDER BY id DESC
            LIMIT {$limit}";
    $rows = $pdo->query($sql)->fetchAll();
    respond_json(200, ['ok' => true, 'data' => $rows]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to load contact messages.']);
}
