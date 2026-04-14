-- Artisan initial product seed
-- Self-contained script: creates database + products table, then inserts products.

CREATE DATABASE IF NOT EXISTS artisan_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

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

-- Optional: uncomment next line to reset existing catalog first.
-- DELETE FROM products;

INSERT INTO products (name, category, price, stock, image_path) VALUES
('Woven Tote with Beaded Handles', 'Handcrafted Bags', 1200.00, 18, NULL),
('Raffia Braided Bracelet', 'Artisan Bracelets', 150.00, 40, NULL),
('Braided Raffia Slide Sandals', 'Native Sandals', 1500.00, 16, NULL),
('Natural Woven Fan-Shaped Clutch', 'Traditional Fans', 1800.00, 10, NULL),
('Single Wide-Strap Raffia Slides', 'Native Sandals', 1500.00, 14, NULL),
('Large Rectangular Straw Tote', 'Handcrafted Bags', 2500.00, 9, NULL),
('Cord Bracelet with Flower Charm', 'Artisan Bracelets', 99.00, 36, NULL),
('Double-Strap Raffia Slides', 'Native Sandals', 1500.00, 13, NULL),
('Patterned Woven Bracelet', 'Artisan Bracelets', 150.00, 30, NULL),
('Patterned Woven Fan', 'Traditional Fans', 1800.00, 11, NULL),
('Hexagonal Woven Shoulder Bag', 'Handcrafted Bags', 2200.00, 12, NULL),
('Cord Bracelet with Flower Charm', 'Artisan Bracelets', 99.00, 28, NULL),
('Basket Bag with Leather Pocket', 'Handcrafted Bags', 3500.00, 8, NULL),
('Woven Cord Bracelet', 'Artisan Bracelets', 150.00, 34, NULL),
('Fringed/Looped Edge Fan Clutch', 'Traditional Fans', 1500.00, 10, NULL),
('Striped Woven Friendship Bracelet', 'Artisan Bracelets', 150.00, 32, NULL),
('Braided Brown Cord Bracelet', 'Artisan Bracelets', 45.00, 42, NULL),
('Classic Raffia Wide-Strap Slides', 'Native Sandals', 1495.00, 15, NULL),
('Black Braided Cord Bracelet', 'Artisan Bracelets', 45.00, 38, NULL),
('Multi-Colored Traditional Abaca Fan', 'Traditional Fans', 150.00, 12, NULL);
