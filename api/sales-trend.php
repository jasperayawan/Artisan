<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

require_method('GET');

try {
    $pdo = artisan_db();

    $sql = "SELECT
                oi.product_name,
                SUM(oi.quantity) AS units_sold,
                SUM(oi.quantity * oi.unit_price) AS revenue
            FROM order_items oi
            INNER JOIN orders o ON o.id = oi.order_id
            WHERE o.status <> 'Cancelled'
            GROUP BY oi.product_name
            ORDER BY units_sold DESC, revenue DESC
            LIMIT 8";

    $rows = $pdo->query($sql)->fetchAll();

    $normalized = array_map(static function (array $row): array {
        return [
            'product_name' => (string)($row['product_name'] ?? ''),
            'units_sold' => (int)($row['units_sold'] ?? 0),
            'revenue' => (float)($row['revenue'] ?? 0),
        ];
    }, $rows);

    respond_json(200, ['ok' => true, 'data' => $normalized]);
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to load sales trend.']);
}
