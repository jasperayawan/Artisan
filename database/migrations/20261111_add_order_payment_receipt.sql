USE artisan_db;

ALTER TABLE orders
  ADD COLUMN payment_receipt VARCHAR(255) NULL AFTER payment_method;
