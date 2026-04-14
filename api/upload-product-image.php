<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    respond_json(405, ['ok' => false, 'message' => 'Method not allowed.']);
}

if (!isset($_FILES['image']) || !is_array($_FILES['image'])) {
    respond_json(422, ['ok' => false, 'message' => 'Image file is required.']);
}

$file = $_FILES['image'];
if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    respond_json(422, ['ok' => false, 'message' => 'Failed to upload image.']);
}

$tmpPath = (string)($file['tmp_name'] ?? '');
if ($tmpPath === '' || !is_uploaded_file($tmpPath)) {
    respond_json(422, ['ok' => false, 'message' => 'Invalid uploaded file.']);
}

$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
    'image/gif' => 'gif',
];

$mime = (string)(mime_content_type($tmpPath) ?: '');
if (!isset($allowedTypes[$mime])) {
    respond_json(422, ['ok' => false, 'message' => 'Only JPG, PNG, WEBP, and GIF are allowed.']);
}

$uploadDir = dirname(__DIR__) . '/assets/uploads';
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to prepare upload directory.']);
}

$filename = 'product-' . date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $allowedTypes[$mime];
$targetPath = $uploadDir . '/' . $filename;

if (!move_uploaded_file($tmpPath, $targetPath)) {
    respond_json(500, ['ok' => false, 'message' => 'Failed to save uploaded image.']);
}

respond_json(201, [
    'ok' => true,
    'data' => [
        'image_path' => 'assets/uploads/' . $filename,
    ],
]);
