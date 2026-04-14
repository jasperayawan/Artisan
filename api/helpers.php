<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function respond_json(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload);
    exit;
}

function read_json_body(): array
{
    $raw = file_get_contents('php://input');
    if (!$raw) {
        return [];
    }

    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

function require_method(string $expected): void
{
    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    if ($method !== strtoupper($expected)) {
        respond_json(405, ['ok' => false, 'message' => 'Method not allowed.']);
    }
}

function optional_string(array $source, string $key): ?string
{
    if (!array_key_exists($key, $source)) {
        return null;
    }
    $value = trim((string)$source[$key]);
    return $value === '' ? null : $value;
}
