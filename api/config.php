<?php
declare(strict_types=1);

function artisan_db(): PDO
{
    // $host = getenv('DB_HOST') ?: '127.0.0.1';
    // $port = getenv('DB_PORT') ?: '3306';
    // $db   = getenv('DB_NAME') ?: 'artisan_db';
    // $user = getenv('DB_USER') ?: 'root';
    // $pass = getenv('DB_PASS') ?: '';

    $host = getenv('DB_HOST') ?: 'sql306.infinityfree.com';
    $port = getenv('DB_PORT') ?: '3306';
    $db   = getenv('DB_NAME') ?: 'artisan_db';
    $user = getenv('DB_USER') ?: 'if0_41656556';
    $pass = getenv('DB_PASS') ?: '5m7QDSt33ozsXhU';

    $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

    return new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

