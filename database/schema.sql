CREATE DATABASE IF NOT EXISTS artisan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE artisan_db;

CREATE TABLE IF NOT EXISTS products (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  category VARCHAR(120) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT UNSIGNED NOT NULL DEFAULT 0,
  image_path VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO products (name, category, price, stock, image_path)
SELECT * FROM (
  SELECT 'Native Handbag', 'Handcrafted Bags', 1200.00, 12, 'assets/bagaggah-removebg-preview 1.svg'
  UNION ALL SELECT 'Striped Bow Tote', 'Handcrafted Bags', 1450.00, 10, 'assets/iofgd-removebg-preview 1.svg'
  UNION ALL SELECT 'Crimson Weave Fan', 'Traditional Fans', 450.00, 7, 'assets/kdjsfh-removebg-preview 1.svg'
  UNION ALL SELECT 'Multi-Color Palm Fan', 'Traditional Fans', 500.00, 18, 'assets/Colorful_fan01-removebg-preview 1.svg'
  UNION ALL SELECT 'Patterned Bangle', 'Artisan Bracelets', 250.00, 5, 'assets/bbbb-removebg-preview 1.svg'
  UNION ALL SELECT 'Obsidian Cord', 'Artisan Bracelets', 180.00, 14, 'assets/download__1_-removebg-preview 1.svg'
  UNION ALL SELECT 'Terra Cotta Cord', 'Artisan Bracelets', 180.00, 13, 'assets/download__2_-removebg-preview 2.svg'
  UNION ALL SELECT 'Natural Fiber Slides', 'Native Sandals', 950.00, 15, 'assets/gfds-removebg-preview 1.svg'
  UNION ALL SELECT 'Textured Raphia Sliders', 'Native Sandals', 1100.00, 11, 'assets/bkjgf-removebg-preview 1.svg'
  UNION ALL SELECT 'Classic Abaca Step-ins', 'Native Sandals', 850.00, 9, 'assets/asdf-removebg-preview 1.svg'
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM products LIMIT 1);

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (first_name, last_name, email, password_hash, role)
SELECT 'System', 'Admin', 'admin@artisan.local', '$2y$10$Mzt6qYu18f2Jv0cZIcOsfeAPIDIJ/sQq2qU6Hr6RCsGAl0vLGJMQm', 'admin'
WHERE NOT EXISTS (
  SELECT 1 FROM users WHERE email = 'admin@artisan.local'
);

CREATE TABLE IF NOT EXISTS orders (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_code VARCHAR(20) NOT NULL UNIQUE,
  customer_name VARCHAR(180) NOT NULL,
  customer_email VARCHAR(190) NOT NULL,
  customer_phone VARCHAR(50) NOT NULL,
  street_address VARCHAR(255) NOT NULL,
  city VARCHAR(120) NOT NULL,
  province VARCHAR(120) NOT NULL,
  region VARCHAR(120) NOT NULL,
  zip_code VARCHAR(20) NOT NULL,
  payment_method VARCHAR(40) NOT NULL,
  status ENUM('Pending', 'Paid', 'Shipped', 'Delivered', 'Cancelled') NOT NULL DEFAULT 'Pending',
  subtotal DECIMAL(10,2) NOT NULL DEFAULT 0,
  shipping_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
  discount DECIMAL(10,2) NOT NULL DEFAULT 0,
  total DECIMAL(10,2) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id INT UNSIGNED NOT NULL,
  product_name VARCHAR(180) NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  unit_price DECIMAL(10,2) NOT NULL DEFAULT 0,
  image_path VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

