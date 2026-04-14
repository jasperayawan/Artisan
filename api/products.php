<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/config.php';

function respond(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload);
    exit;
}

try {
    $pdo = artisan_db();
} catch (Throwable $e) {
    respond(500, ['ok' => false, 'message' => 'Database connection failed.']);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    try {
        $stmt = $pdo->query('SELECT id, name, category, price, stock, image_path FROM products ORDER BY id DESC');
        $rows = $stmt->fetchAll();
        respond(200, ['ok' => true, 'data' => $rows]);
    } catch (Throwable $e) {
        respond(500, ['ok' => false, 'message' => 'Failed to load products.']);
    }
}

if ($method === 'POST') {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw ?: '{}', true);

    $name = trim((string)($body['name'] ?? ''));
    $category = trim((string)($body['category'] ?? ''));
    $price = (float)($body['price'] ?? 0);
    $stock = (int)($body['stock'] ?? -1);
    $imagePath = trim((string)($body['image_path'] ?? ''));

    if ($name === '' || $category === '' || $price <= 0 || $stock < 0) {
        respond(422, ['ok' => false, 'message' => 'Invalid product payload.']);
    }

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO products (name, category, price, stock, image_path) VALUES (:name, :category, :price, :stock, :image_path)'
        );
        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':image_path' => $imagePath !== '' ? $imagePath : null,
        ]);

        $id = (int)$pdo->lastInsertId();
        respond(201, [
            'ok' => true,
            'data' => [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'price' => $price,
                'stock' => $stock,
                'image_path' => $imagePath !== '' ? $imagePath : null,
            ],
        ]);
    } catch (Throwable $e) {
        respond(500, ['ok' => false, 'message' => 'Failed to create product.']);
    }
}

if ($method === 'PUT') {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw ?: '{}', true);

    $id = (int)($body['id'] ?? 0);
    $name = trim((string)($body['name'] ?? ''));
    $category = trim((string)($body['category'] ?? ''));
    $price = (float)($body['price'] ?? 0);
    $stock = (int)($body['stock'] ?? -1);
    $imagePath = trim((string)($body['image_path'] ?? ''));

    if ($id <= 0 || $name === '' || $category === '' || $price <= 0 || $stock < 0) {
        respond(422, ['ok' => false, 'message' => 'Invalid product payload.']);
    }

    try {
        $stmt = $pdo->prepare(
            'UPDATE products
             SET name = :name,
                 category = :category,
                 price = :price,
                 stock = :stock,
                 image_path = :image_path
             WHERE id = :id'
        );
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':image_path' => $imagePath !== '' ? $imagePath : null,
        ]);

        if ($stmt->rowCount() === 0) {
            $check = $pdo->prepare('SELECT id FROM products WHERE id = :id LIMIT 1');
            $check->execute([':id' => $id]);
            if (!$check->fetch()) {
                respond(404, ['ok' => false, 'message' => 'Product not found.']);
            }
        }

        respond(200, [
            'ok' => true,
            'data' => [
                'id' => $id,
                'name' => $name,
                'category' => $category,
                'price' => $price,
                'stock' => $stock,
                'image_path' => $imagePath !== '' ? $imagePath : null,
            ],
        ]);
    } catch (Throwable $e) {
        respond(500, ['ok' => false, 'message' => 'Failed to update product.']);
    }
}

if ($method === 'DELETE') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        $raw = file_get_contents('php://input');
        $body = json_decode($raw ?: '{}', true);
        $id = (int)($body['id'] ?? 0);
    }

    if ($id <= 0) {
        respond(422, ['ok' => false, 'message' => 'Product id is required.']);
    }

    try {
        $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute([':id' => $id]);
        if ($stmt->rowCount() === 0) {
            respond(404, ['ok' => false, 'message' => 'Product not found.']);
        }
        respond(200, ['ok' => true, 'message' => 'Product deleted.']);
    } catch (Throwable $e) {
        respond(500, ['ok' => false, 'message' => 'Failed to delete product.']);
    }
}

respond(405, ['ok' => false, 'message' => 'Method not allowed.']);

