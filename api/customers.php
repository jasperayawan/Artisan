<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('GET');

try {
    $pdo = artisan_db();

    $sql = "SELECT
                customer_email AS email,
                MAX(customer_name) AS name,
                COUNT(*) AS total_orders,
                SUM(total) AS total_spent,
                MAX(created_at) AS last_order
            FROM orders
            WHERE customer_email <> ''
            GROUP BY customer_email
            ORDER BY last_order DESC";

    $rows = $pdo->query($sql)->fetchAll();
    respond_json(200, ['ok' => true, 'data' => $rows]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to load customers.']);
}
