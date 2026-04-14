<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('GET');

$email = strtolower(trim((string)($_GET['email'] ?? '')));
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond_json(422, ['ok' => false, 'message' => 'Valid email is required.']);
}

try {
    $pdo = artisan_db();

    $sql = 'SELECT o.id, o.order_code, o.customer_name, o.customer_email, o.status, o.total, o.created_at,
                   COALESCE(SUM(oi.quantity), 0) AS item_count
            FROM orders o
            LEFT JOIN order_items oi ON oi.order_id = o.id
            WHERE o.customer_email = :email
            GROUP BY o.id
            ORDER BY o.id DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $rows = $stmt->fetchAll();

    respond_json(200, ['ok' => true, 'data' => $rows]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to load orders.']);
}

