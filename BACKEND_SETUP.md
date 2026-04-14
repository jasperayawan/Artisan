# Artisan Backend Setup (XAMPP + MySQL)

## 1) Create schema and seed products

1. Open phpMyAdmin (`http://localhost/phpmyadmin`).
2. Import `database/schema.sql`.

This creates:
- database: `artisan_db`
- tables: `products`, `users`, `orders`, `order_items`
- seed rows for current storefront items

## 2) Verify PHP API

Open in browser:

- `http://localhost/Artisan/api/products.php`
- `http://localhost/Artisan/api/orders.php`
- `http://localhost/Artisan/api/customers.php`

Expected: JSON response with `ok: true` and data array.

## 3) Pages already connected

- `products.html` fetches products from `api/products.php` and renders cards.
- `admin-products.html` fetches products from `api/products.php`.
- Admin "Add Product" posts to `api/products.php` and inserts into DB.
- `checkout.html` posts order payloads to `api/orders.php`.
- `admin-orders.html` fetches order records from `api/orders.php`.
- `admin-customers.html` fetches customer aggregates from `api/customers.php`.
- `signup.html` posts registration to `api/register.php`.
- `login.html` posts login to `api/login.php`.

If API is unavailable, pages keep their static fallback behavior.

## 4) DB credentials

Default credentials are defined in `api/config.php`:
- host: `127.0.0.1`
- port: `3306`
- db: `artisan_db`
- user: `root`
- pass: ``

You can override via environment variables:
- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`

