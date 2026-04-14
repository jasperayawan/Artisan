<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Artisan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="components.css">
    <style>
        .page-header {
            padding: 40px 8% 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #1a1a1a;
        }
        .page-header p {
            font-size: 0.85rem;
            color: #999;
            margin-top: 4px;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 40px;
            padding: 40px 8%;
            max-width: 1300px;
            margin: 0 auto;
            align-items: start;
        }

        /* Cart Table */
        .cart-table { width: 100%; }

        .cart-table-head {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 40px;
            padding: 0 0 12px;
            border-bottom: 2px solid #eee;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: #999;
        }

        .cart-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 40px;
            align-items: center;
            padding: 24px 0;
            border-bottom: 1px solid #f0f0f0;
            gap: 10px;
        }

        .cart-row-product {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .cart-row-product img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: #f9f6f2;
            border-radius: 6px;
            padding: 8px;
            flex-shrink: 0;
        }

        .cart-row-product-info h4 {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .cart-row-product-info span {
            font-size: 0.8rem;
            color: #999;
        }

        .cart-row-price {
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }

        .cart-qty {
            display: flex;
            align-items: center;
            border: 1.5px solid #ddd;
            width: fit-content;
        }

        .cart-qty-btn {
            background: none;
            border: none;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 1rem;
            color: #555;
            transition: background 0.2s;
        }
        .cart-qty-btn:hover { background: #f5f5f5; }

        .cart-qty-input {
            width: 36px;
            text-align: center;
            border: none;
            border-left: 1.5px solid #ddd;
            border-right: 1.5px solid #ddd;
            padding: 6px 0;
            font-size: 0.85rem;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .cart-row-subtotal {
            font-size: 0.9rem;
            font-weight: 600;
            color: #5c4b43;
        }

        .cart-row-remove {
            background: none;
            border: none;
            cursor: pointer;
            color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
            padding: 4px;
        }
        .cart-row-remove:hover { color: #c0392b; }
        .cart-row-remove i { width: 18px; height: 18px; }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .continue-link {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #5c4b43;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: gap 0.2s;
        }
        .continue-link:hover { gap: 12px; }
        .continue-link i { width: 16px; height: 16px; }

        /* Order Summary */
        .order-summary {
            background: #fdfbf7;
            padding: 28px;
            border-radius: 4px;
            position: sticky;
            top: 100px;
        }

        .order-summary h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.88rem;
            color: #555;
            margin-bottom: 12px;
        }

        .summary-row.total {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eee;
        }

        .summary-row.total span:last-child { color: #5c4b43; }

        .promo-row {
            display: flex;
            gap: 8px;
            margin: 20px 0;
        }

        .promo-row input {
            flex: 1;
            padding: 10px 12px;
            border: 1.5px solid #ddd;
            font-size: 0.85rem;
            outline: none;
            font-family: 'Inter', sans-serif;
        }
        .promo-row input:focus { border-color: #5c4b43; }

        .promo-row button {
            padding: 10px 16px;
            background: #D9C5A3;
            border: none;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .promo-row button:hover { background: #c4ad8a; }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: #5c4b43;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 8px;
            transition: background 0.3s;
        }
        .checkout-btn:hover { background: #4a3c36; }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 14px;
            font-size: 0.75rem;
            color: #aaa;
        }
        .secure-note i { width: 13px; height: 13px; }

        /* Delivery + Trust */
        .delivery-note {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            margin-top: 14px;
            font-size: 0.78rem;
            color: #999;
            text-align: center;
            line-height: 1.4;
        }
        .delivery-note i { width: 14px; height: 14px; }

        .trust-badges {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #eee;
        }
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1px solid rgba(92, 75, 67, 0.18);
            background: rgba(217, 197, 163, 0.10);
            border-radius: 6px;
            color: #4a3c36;
            font-size: 0.82rem;
            letter-spacing: 0.2px;
        }
        .trust-badge i { width: 16px; height: 16px; color: #5c4b43; }

        /* Promo feedback states (design only) */
        .promo-row { align-items: stretch; }
        .promo-row input { border-radius: 6px; }
        .promo-row button { border-radius: 6px; }
        .promo-helper {
            margin-top: 10px;
            font-size: 0.78rem;
            color: #999;
            line-height: 1.4;
        }
        .promo-row.applied input {
            border-color: rgba(46, 125, 50, 0.5);
            background: rgba(46, 125, 50, 0.06);
        }
        .promo-row.invalid input {
            border-color: rgba(192, 57, 43, 0.55);
            background: rgba(192, 57, 43, 0.05);
        }
        .promo-helper.applied { color: #2e7d32; }
        .promo-helper.invalid { color: #c0392b; }

        /* Full-page empty state (design only; toggle later) */
        .cart-empty-state {
            display: none;
            padding: 50px 8% 30px;
            max-width: 900px;
            margin: 0 auto;
        }
        .cart-empty-card {
            border: 1px solid #eee;
            background: #fff;
            border-radius: 10px;
            padding: 34px 28px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        }
        .cart-empty-card i {
            width: 34px;
            height: 34px;
            color: #5c4b43;
            margin-bottom: 12px;
        }
        .cart-empty-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            margin-bottom: 6px;
            color: #1a1a1a;
        }
        .cart-empty-card p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 18px;
        }
        .empty-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 18px;
            background: #5c4b43;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .empty-cta:hover { background: #4a3c36; }
        .empty-cta i { width: 16px; height: 16px; color: #fff; }

        .empty-suggestions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 22px;
            text-align: left;
        }
        .empty-suggestion {
            border: 1px solid rgba(92, 75, 67, 0.14);
            background: #fdfbf7;
            border-radius: 10px;
            padding: 14px;
            transition: transform 0.25s ease, background 0.25s ease, border-color 0.25s ease;
        }
        .empty-suggestion:hover {
            transform: translateY(-3px);
            border-color: rgba(92, 75, 67, 0.28);
            background: #fff;
        }
        .empty-suggestion span {
            display: block;
            font-size: 0.78rem;
            color: #999;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .empty-suggestion strong {
            display: block;
            font-size: 0.95rem;
            color: #1a1a1a;
            letter-spacing: 0.2px;
        }

        /* Cross-sell */
        .cross-sell {
            padding: 10px 8% 60px;
            max-width: 1300px;
            margin: 0 auto;
        }
        .cross-sell-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
        }
        .cross-sell h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: #1a1a1a;
        }
        .cross-sell small {
            color: #999;
            font-size: 0.85rem;
        }
        .cross-sell-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }
        .cross-card {
            display: block;
            text-decoration: none;
            color: inherit;
            border: 1px solid rgba(92, 75, 67, 0.12);
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }
        .cross-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 50px rgba(0,0,0,0.08);
            border-color: rgba(92, 75, 67, 0.25);
        }
        .cross-card-media {
            background: #f9f6f2;
            padding: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 180px;
        }
        .cross-card-media img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        .cross-card-body { padding: 14px 14px 16px; }
        .cross-card-title {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
            color: #1a1a1a;
        }
        .cross-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            color: #777;
            font-size: 0.82rem;
        }
        .cross-card-price {
            color: #5c4b43;
            font-weight: 700;
        }

        /* Mobile sticky checkout bar */
        .checkout-bar {
            display: none;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1200;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(0,0,0,0.08);
            padding: 12px 14px;
        }
        .checkout-bar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .checkout-bar-total {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .checkout-bar-total span:first-child {
            font-size: 0.72rem;
            letter-spacing: 1.3px;
            text-transform: uppercase;
            color: #999;
            font-weight: 700;
        }
        .checkout-bar-total span:last-child {
            font-size: 1.05rem;
            font-weight: 800;
            color: #1a1a1a;
        }
        .checkout-bar a {
            flex: 0 0 auto;
            padding: 12px 14px;
            background: #5c4b43;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .checkout-bar a:hover { background: #4a3c36; }

        @media (max-width: 900px) {
            .cart-layout { grid-template-columns: 1fr; }
            .order-summary { position: static; }
            .cart-table-head { display: none; }
            .cart-row { grid-template-columns: 1fr auto; grid-template-rows: auto auto; }
            .cart-row-price { display: none; }
            .cross-sell-grid { grid-template-columns: repeat(2, 1fr); }
            .empty-suggestions { grid-template-columns: repeat(2, 1fr); }
            .checkout-bar { display: block; }
            body { padding-bottom: 76px; }
        }

        @media (max-width: 520px) {
            .cross-sell-grid { grid-template-columns: 1fr; }
            .empty-suggestions { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Artisan</a>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contacts</a>
        </nav>
        <div class="nav-icons">
            <a href="#" class="search-trigger" aria-label="Search"><i data-lucide="search"></i></a>
            <a href="login.php" class="login-link">
                <i data-lucide="user"></i>
                <span>Log in</span>
            </a>
            <a href="#" aria-label="Cart" class="cart-icon" style="color: var(--accent-gold);">
                <i data-lucide="shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </header>

    <div class="page-header">
        <h1>Shopping Cart</h1>
        <p>Review your items before checking out.</p>
    </div>

    <!-- Full-page Empty State (design only; toggle later) -->
    <section class="cart-empty-state" aria-hidden="true">
        <div class="cart-empty-card">
            <i data-lucide="shopping-bag"></i>
            <h2>Your cart is empty</h2>
            <p>Browse our handcrafted collections and add something with a story.</p>
            <a class="empty-cta" href="products.php">
                <i data-lucide="arrow-right"></i>
                Explore products
            </a>

            <div class="empty-suggestions" aria-label="Popular categories">
                <div class="empty-suggestion">
                    <span>Collection</span>
                    <strong>Handcrafted Bags</strong>
                </div>
                <div class="empty-suggestion">
                    <span>Collection</span>
                    <strong>Traditional Fans</strong>
                </div>
                <div class="empty-suggestion">
                    <span>Collection</span>
                    <strong>Artisan Bracelets</strong>
                </div>
                <div class="empty-suggestion">
                    <span>Collection</span>
                    <strong>Native Sandals</strong>
                </div>
            </div>
        </div>
    </section>

    <div class="cart-layout">
        <!-- Cart Items -->
        <div>
            <div class="cart-table">
                <div class="cart-table-head">
                    <span>Product</span>
                    <span>Price</span>
                    <span>Quantity</span>
                    <span>Subtotal</span>
                    <span></span>
                </div>

                <!-- Example Item 1 -->
                <div class="cart-row">
                    <div class="cart-row-product">
                        <img src="assets/bagaggah-removebg-preview 1.svg" alt="Native Handbag">
                        <div class="cart-row-product-info">
                            <h4>Native Handbag</h4>
                            <span>Handcrafted Bags</span>
                        </div>
                    </div>
                    <div class="cart-row-price">₱1,200.00</div>
                    <div class="cart-qty">
                        <button class="cart-qty-btn">−</button>
                        <input class="cart-qty-input" type="number" value="1" min="1">
                        <button class="cart-qty-btn">+</button>
                    </div>
                    <div class="cart-row-subtotal">₱1,200.00</div>
                    <button class="cart-row-remove" aria-label="Remove"><i data-lucide="x"></i></button>
                </div>

                <!-- Example Item 2 -->
                <div class="cart-row">
                    <div class="cart-row-product">
                        <img src="assets/kdjsfh-removebg-preview 1.svg" alt="Crimson Weave Fan">
                        <div class="cart-row-product-info">
                            <h4>Crimson Weave Fan</h4>
                            <span>Traditional Fans</span>
                        </div>
                    </div>
                    <div class="cart-row-price">₱450.00</div>
                    <div class="cart-qty">
                        <button class="cart-qty-btn">−</button>
                        <input class="cart-qty-input" type="number" value="2" min="1">
                        <button class="cart-qty-btn">+</button>
                    </div>
                    <div class="cart-row-subtotal">₱900.00</div>
                    <button class="cart-row-remove" aria-label="Remove"><i data-lucide="x"></i></button>
                </div>

                <!-- Example Item 3 -->
                <div class="cart-row">
                    <div class="cart-row-product">
                        <img src="assets/gfds-removebg-preview 1.svg" alt="Natural Fiber Slides">
                        <div class="cart-row-product-info">
                            <h4>Natural Fiber Slides</h4>
                            <span>Native Sandals</span>
                        </div>
                    </div>
                    <div class="cart-row-price">₱950.00</div>
                    <div class="cart-qty">
                        <button class="cart-qty-btn">−</button>
                        <input class="cart-qty-input" type="number" value="1" min="1">
                        <button class="cart-qty-btn">+</button>
                    </div>
                    <div class="cart-row-subtotal">₱950.00</div>
                    <button class="cart-row-remove" aria-label="Remove"><i data-lucide="x"></i></button>
                </div>
            </div>

            <div class="cart-actions">
                <a href="products.php" class="continue-link">
                    <i data-lucide="arrow-left"></i> Continue Shopping
                </a>
            </div>

            <!-- Cross-sell (design only) -->
            <section class="cross-sell" aria-label="Recommended products">
                <div class="cross-sell-header">
                    <h2>You may also like</h2>
                    <small>Handpicked pieces from our community</small>
                </div>
                <div class="cross-sell-grid">
                    <a class="cross-card" href="product-detail.php">
                        <div class="cross-card-media">
                            <img src="assets/iofgd-removebg-preview 1.svg" alt="Striped Bow Tote">
                        </div>
                        <div class="cross-card-body">
                            <div class="cross-card-title">Striped Bow Tote</div>
                            <div class="cross-card-meta">
                                <span>Handcrafted Bags</span>
                                <span class="cross-card-price">₱1,450.00</span>
                            </div>
                        </div>
                    </a>
                    <a class="cross-card" href="product-detail.php">
                        <div class="cross-card-media">
                            <img src="assets/Colorful_fan01-removebg-preview 1.svg" alt="Multi-Color Palm Fan">
                        </div>
                        <div class="cross-card-body">
                            <div class="cross-card-title">Multi-Color Palm Fan</div>
                            <div class="cross-card-meta">
                                <span>Traditional Fans</span>
                                <span class="cross-card-price">₱500.00</span>
                            </div>
                        </div>
                    </a>
                    <a class="cross-card" href="product-detail.php">
                        <div class="cross-card-media">
                            <img src="assets/download__1_-removebg-preview 1.svg" alt="Obsidian Cord">
                        </div>
                        <div class="cross-card-body">
                            <div class="cross-card-title">Obsidian Cord</div>
                            <div class="cross-card-meta">
                                <span>Artisan Bracelets</span>
                                <span class="cross-card-price">₱180.00</span>
                            </div>
                        </div>
                    </a>
                    <a class="cross-card" href="product-detail.php">
                        <div class="cross-card-media">
                            <img src="assets/sandal_2-removebg-preview 1.svg" alt="Textured Raphia Sliders">
                        </div>
                        <div class="cross-card-body">
                            <div class="cross-card-title">Textured Raphia Sliders</div>
                            <div class="cross-card-meta">
                                <span>Native Sandals</span>
                                <span class="cross-card-price">₱1,100.00</span>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </div>

        <!-- Order Summary -->
        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="summary-row"><span>Subtotal (4 items)</span><span>₱3,050.00</span></div>
            <div class="summary-row"><span>Shipping</span><span>₱150.00</span></div>
            <div class="summary-row"><span>Tax</span><span>Included</span></div>
            <div class="summary-row"><span>Discount</span><span>—</span></div>

            <div class="promo-row">
                <input type="text" placeholder="Promo code">
                <button>Apply</button>
            </div>
            <div class="promo-helper">Have a code? Apply it to see your savings at checkout.</div>

            <div class="summary-row total">
                <span>Total</span>
                <span>₱3,200.00</span>
            </div>

            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            <div class="secure-note">
                <i data-lucide="lock"></i>
                <span>Secure & encrypted checkout</span>
            </div>
            <div class="delivery-note">
                <i data-lucide="truck"></i>
                <span>Ships from the Philippines • Estimated delivery 3–5 business days</span>
            </div>

            <div class="trust-badges" aria-label="Checkout trust badges">
                <div class="trust-badge">
                    <i data-lucide="shield-check"></i>
                    <span>Protected payments and secure checkout</span>
                </div>
                <div class="trust-badge">
                    <i data-lucide="rotate-ccw"></i>
                    <span>Easy returns on eligible items</span>
                </div>
                <div class="trust-badge">
                    <i data-lucide="heart-handshake"></i>
                    <span>Every purchase supports artisan communities</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sticky Checkout Bar (design only) -->
    <div class="checkout-bar" role="region" aria-label="Checkout bar">
        <div class="checkout-bar-inner">
            <div class="checkout-bar-total">
                <span>Total</span>
                <span>₱3,200.00</span>
            </div>
            <a href="checkout.php">Checkout</a>
        </div>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <span class="footer-logo">Artisan</span>
                <p>Preserving heritage through every stitch and weave. Supporting local communities across the Philippines.</p>
            </div>
            <div class="footer-col">
                <h4>Shop</h4>
                <ul>
                    <li>Bags & Accessories</li>
                    <li>Home Decor</li>
                    <li>New Arrivals</li>
                    <li>Sale</li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li>Shipping Policy</li>
                    <li>Returns & Exchanges</li>
                    <li>Wholesale</li>
                    <li>FAQ</li>
                </ul>
            </div>
            <div class="footer-col newsletter">
                <h4>Join Our Journey</h4>
                <p style="font-size: 0.8rem; margin-bottom: 15px;">Subscribe for updates on new collections and artisan stories.</p>
                <input type="email" placeholder="Email Address">
                <button style="background: var(--accent-gold); border:none; padding: 10px 20px; color: white; cursor: pointer; width: 100%;">Subscribe</button>
            </div>
        </div>
        <div class="copyright">
            &copy; 2026 Artisan Handcrafted. All Rights Reserved.
        </div>
    </footer>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-sidebar-header">
            <h3>Your Cart</h3>
            <button class="cart-close" id="cartClose"><i data-lucide="x"></i></button>
        </div>
        <div class="cart-sidebar-body">
            <div class="cart-empty">
                <i data-lucide="shopping-bag"></i>
                <p>Your cart is empty</p>
            </div>
        </div>
        <div class="cart-sidebar-footer">
            <div class="cart-total"><span>Total</span><span>₱0.00</span></div>
            <a href="cart.php" class="btn-cart-view">View Cart</a>
            <a href="checkout.php" class="btn-cart-checkout">Checkout</a>
        </div>
    </div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Search Modal -->
    <div class="search-modal" id="searchModal">
        <input type="text" id="searchInput" placeholder="Search for handcrafted products...">
        <button class="search-close" id="searchClose"><i data-lucide="x"></i></button>
    </div>

    <script src="components.js"></script>
    <script>
        (function () {
            const SHIPPING_FEE = 150;
            const cartTable = document.querySelector('.cart-table');
            const summaryRows = document.querySelectorAll('.order-summary .summary-row');
            const checkoutBarTotal = document.querySelector('.checkout-bar-total span:last-child');
            const crossSellGrid = document.querySelector('.cross-sell-grid');

            const peso = (value) => '₱' + Number(value || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            const escapeHtml = (value) => String(value || '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');

            function getCart() {
                if (typeof getCartItems === 'function') return getCartItems();
                return [];
            }

            function setCart(next) {
                if (typeof setCartItems === 'function') {
                    setCartItems(next);
                    return;
                }
                try {
                    localStorage.setItem('artisanCart', JSON.stringify(next));
                } catch (e) {
                    // Ignore storage write failures.
                }
            }

            function computeSubtotal(items) {
                return items.reduce((sum, item) => sum + Number(item.price || 0) * Number(item.qty || 0), 0);
            }

            function renderSummary(items) {
                const subtotal = computeSubtotal(items);
                const totalItems = items.reduce((sum, item) => sum + Number(item.qty || 0), 0);
                const total = subtotal + (items.length ? SHIPPING_FEE : 0);
                if (summaryRows.length >= 4) {
                    const subtotalLabel = summaryRows[0].querySelector('span:first-child');
                    const subtotalValue = summaryRows[0].querySelector('span:last-child');
                    const shippingValue = summaryRows[1].querySelector('span:last-child');
                    const totalValue = document.querySelector('.order-summary .summary-row.total span:last-child');
                    if (subtotalLabel) subtotalLabel.textContent = `Subtotal (${totalItems} items)`;
                    if (subtotalValue) subtotalValue.textContent = peso(subtotal);
                    if (shippingValue) shippingValue.textContent = items.length ? peso(SHIPPING_FEE) : '—';
                    if (totalValue) totalValue.textContent = peso(total);
                }
                if (checkoutBarTotal) checkoutBarTotal.textContent = peso(total);
            }

            function renderCartRows(items) {
                if (!cartTable) return;
                const head = cartTable.querySelector('.cart-table-head');
                const oldRows = cartTable.querySelectorAll('.cart-row');
                oldRows.forEach((row) => row.remove());

                if (!items.length) {
                    const empty = document.createElement('div');
                    empty.className = 'cart-row';
                    empty.innerHTML = '<div class="cart-row-product"><div class="cart-row-product-info"><h4>Your cart is empty</h4><span>Add products to continue checkout.</span></div></div>';
                    cartTable.appendChild(empty);
                    return;
                }

                items.forEach((item, index) => {
                    const row = document.createElement('div');
                    row.className = 'cart-row';
                    const subtotal = Number(item.price || 0) * Number(item.qty || 1);
                    row.innerHTML = `
                        <div class="cart-row-product">
                            <img src="${escapeHtml(item.img)}" alt="${escapeHtml(item.name)}">
                            <div class="cart-row-product-info">
                                <h4>${escapeHtml(item.name)}</h4>
                                <span>Handcrafted Collection</span>
                            </div>
                        </div>
                        <div class="cart-row-price">${peso(item.price)}</div>
                        <div class="cart-qty">
                            <button class="cart-qty-btn" data-action="decrease">−</button>
                            <input class="cart-qty-input" type="number" value="${Number(item.qty || 1)}" min="1">
                            <button class="cart-qty-btn" data-action="increase">+</button>
                        </div>
                        <div class="cart-row-subtotal">${peso(subtotal)}</div>
                        <button class="cart-row-remove" aria-label="Remove"><i data-lucide="x"></i></button>
                    `;
                    const input = row.querySelector('.cart-qty-input');
                    row.querySelector('[data-action="decrease"]').addEventListener('click', () => updateQty(index, Number(input.value || 1) - 1));
                    row.querySelector('[data-action="increase"]').addEventListener('click', () => updateQty(index, Number(input.value || 1) + 1));
                    input.addEventListener('change', () => updateQty(index, Number(input.value || 1)));
                    row.querySelector('.cart-row-remove').addEventListener('click', () => removeItem(index));
                    if (head) cartTable.appendChild(row); else cartTable.prepend(row);
                });

                if (window.lucide && typeof lucide.createIcons === 'function') lucide.createIcons();
            }

            function updateQty(index, nextQty) {
                const items = getCart();
                if (!items[index]) return;
                items[index].qty = Math.max(1, Number(nextQty || 1));
                setCart(items);
                render();
            }

            function removeItem(index) {
                const items = getCart();
                items.splice(index, 1);
                setCart(items);
                render();
            }

            async function renderRecommendations() {
                if (!crossSellGrid) return;
                try {
                    const res = await fetch('api/products.php');
                    if (!res.ok) return;
                    const payload = await res.json();
                    if (!payload.ok || !Array.isArray(payload.data)) return;
                    const items = payload.data.slice(0, 4);
                    if (!items.length) return;
                    crossSellGrid.innerHTML = items.map((item) => {
                        const params = new URLSearchParams({
                            name: item.name || '',
                            price: String(item.price || 0),
                            img: item.image_path || '',
                            category: item.category || 'Handcrafted Collection'
                        });
                        return `
                            <a class="cross-card" href="product-detail.php?${params.toString()}">
                                <div class="cross-card-media"><img src="${escapeHtml(item.image_path || '')}" alt="${escapeHtml(item.name || 'Product')}"></div>
                                <div class="cross-card-body">
                                    <div class="cross-card-title">${escapeHtml(item.name || 'Handcrafted Item')}</div>
                                    <div class="cross-card-meta">
                                        <span>${escapeHtml(item.category || 'Collection')}</span>
                                        <span class="cross-card-price">${peso(item.price)}</span>
                                    </div>
                                </div>
                            </a>`;
                    }).join('');
                } catch (e) {
                    // Keep static recommendations fallback.
                }
            }

            function render() {
                const items = getCart();
                renderCartRows(items);
                renderSummary(items);
            }

            render();
            renderRecommendations();
        })();
    </script>
    <script src="auth-ui.js"></script>
</body>
</html>
