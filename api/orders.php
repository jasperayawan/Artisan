<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

function parse_items(array $items): array
{
    $parsed = [];
    foreach ($items as $item) {
        if (!is_array($item)) {
            continue;
        }
        $name = trim((string)($item['name'] ?? ''));
        $qty = max(1, (int)($item['qty'] ?? 1));
        $unitPrice = (float)($item['unit_price'] ?? 0);
        $imagePath = trim((string)($item['image_path'] ?? ''));
        if ($name === '' || $unitPrice <= 0) {
            continue;
        }
        $parsed[] = [
            'name' => $name,
            'qty' => $qty,
            'unit_price' => $unitPrice,
            'image_path' => $imagePath !== '' ? $imagePath : null,
        ];
    }
    return $parsed;
}

function create_order_code(PDO $pdo): string
{
    do {
        $code = 'A-' . random_int(1000, 9999);
        $stmt = $pdo->prepare('SELECT id FROM orders WHERE order_code = :code LIMIT 1');
        $stmt->execute([':code' => $code]);
    } while ($stmt->fetch());

    return $code;
}

try {
    $pdo = artisan_db();
} catch (Throwable $e) {
    respond_json(500, ['ok' => false, 'message' => 'Database connection failed.']);
}

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

if ($method === 'GET') {
    try {
        $sql = 'SELECT o.id, o.order_code, o.customer_name, o.customer_email, o.status, o.total, o.created_at,
                       COALESCE(SUM(oi.quantity), 0) AS item_count
                FROM orders o
                LEFT JOIN order_items oi ON oi.order_id = o.id
                GROUP BY o.id
                ORDER BY o.id DESC';
        $rows = $pdo->query($sql)->fetchAll();
        respond_json(200, ['ok' => true, 'data' => $rows]);
    } catch (Throwable $e) {
        respond_json(500, ['ok' => false, 'message' => 'Failed to load orders.']);
    }
}

if ($method === 'POST') {
    $body = read_json_body();

    $firstName = trim((string)($body['first_name'] ?? ''));
    $lastName = trim((string)($body['last_name'] ?? ''));
    $customerEmail = strtolower(trim((string)($body['customer_email'] ?? '')));
    $customerPhone = trim((string)($body['customer_phone'] ?? ''));
    $street = trim((string)($body['street_address'] ?? ''));
    $city = trim((string)($body['city'] ?? ''));
    $province = trim((string)($body['province'] ?? ''));
    $region = trim((string)($body['region'] ?? ''));
    $zipCode = trim((string)($body['zip_code'] ?? ''));
    $paymentMethod = trim((string)($body['payment_method'] ?? 'cod'));
    $shippingFee = (float)($body['shipping_fee'] ?? 150);
    $discount = (float)($body['discount'] ?? 0);
    $items = parse_items(is_array($body['items'] ?? null) ? $body['items'] : []);

    if ($firstName === '' || $lastName === '' || $customerEmail === '' || $customerPhone === '' || $street === '' || $city === '' || $province === '' || $region === '' || $zipCode === '') {
        respond_json(422, ['ok' => false, 'message' => 'Please complete all checkout fields.']);
    }
    if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        respond_json(422, ['ok' => false, 'message' => 'Please provide a valid email address.']);
    }
    if (!$items) {
        respond_json(422, ['ok' => false, 'message' => 'Cannot place an order with no items.']);
    }

    $subtotal = 0.0;
    foreach ($items as $item) {
        $subtotal += (float)$item['unit_price'] * (int)$item['qty'];
    }
    $total = max(0, $subtotal + $shippingFee - $discount);

    try {
        $pdo->beginTransaction();
        $orderCode = create_order_code($pdo);
        $fullName = trim($firstName . ' ' . $lastName);

        $orderStmt = $pdo->prepare(
            'INSERT INTO orders
                (order_code, customer_name, customer_email, customer_phone, street_address, city, province, region, zip_code, payment_method, status, subtotal, shipping_fee, discount, total)
             VALUES
                (:order_code, :customer_name, :customer_email, :customer_phone, :street_address, :city, :province, :region, :zip_code, :payment_method, :status, :subtotal, :shipping_fee, :discount, :total)'
        );
        $orderStmt->execute([
            ':order_code' => $orderCode,
            ':customer_name' => $fullName,
            ':customer_email' => $customerEmail,
            ':customer_phone' => $customerPhone,
            ':street_address' => $street,
            ':city' => $city,
            ':province' => $province,
            ':region' => $region,
            ':zip_code' => $zipCode,
            ':payment_method' => $paymentMethod,
            ':status' => 'Pending',
            ':subtotal' => $subtotal,
            ':shipping_fee' => $shippingFee,
            ':discount' => $discount,
            ':total' => $total,
        ]);

        $orderId = (int)$pdo->lastInsertId();
        $itemStmt = $pdo->prepare(
            'INSERT INTO order_items (order_id, product_name, quantity, unit_price, image_path)
             VALUES (:order_id, :product_name, :quantity, :unit_price, :image_path)'
        );
        foreach ($items as $item) {
            $itemStmt->execute([
                ':order_id' => $orderId,
                ':product_name' => $item['name'],
                ':quantity' => $item['qty'],
                ':unit_price' => $item['unit_price'],
                ':image_path' => $item['image_path'],
            ]);
        }

        $pdo->commit();
        respond_json(201, [
            'ok' => true,
            'message' => 'Order placed successfully.',
            'data' => [
                'id' => $orderId,
                'order_code' => $orderCode,
                'customer_name' => $fullName,
                'customer_email' => $customerEmail,
                'status' => 'Pending',
                'item_count' => array_sum(array_map(static fn(array $item): int => (int)$item['qty'], $items)),
                'total' => $total,
            ],
        ]);
    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        respond_json(500, ['ok' => false, 'message' => 'Failed to place order.']);
    }
}

respond_json(405, ['ok' => false, 'message' => 'Method not allowed.']);
