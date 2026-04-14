<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Confirmed | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="components.css" />
  <style>
    .confirm-hero {
      padding: 44px 8% 24px;
      border-bottom: 1px solid #f0f0f0;
      background: linear-gradient(180deg, rgba(217, 197, 163, 0.22), rgba(255,255,255,0));
    }
    .confirm-hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.1rem;
      color: #1a1a1a;
      line-height: 1.2;
    }
    .confirm-hero p {
      margin-top: 10px;
      font-size: 0.92rem;
      color: #777;
      max-width: 780px;
      line-height: 1.7;
    }

    .confirm-layout {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 50px;
      padding: 40px 8% 70px;
      max-width: 1300px;
      margin: 0 auto;
      align-items: start;
    }

    .confirm-card {
      background: #fff;
      border: 1px solid rgba(92, 75, 67, 0.14);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 55px rgba(0,0,0,0.06);
    }
    .confirm-card-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 18px 18px;
      border-bottom: 1px solid #eee;
      background: rgba(217, 197, 163, 0.10);
    }
    .confirm-check {
      width: 40px;
      height: 40px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #5c4b43;
      color: #fff;
      flex: 0 0 auto;
    }
    .confirm-check i { width: 18px; height: 18px; }
    .confirm-card-header strong {
      display: block;
      font-size: 0.95rem;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: #1a1a1a;
    }
    .confirm-card-header span {
      display: block;
      margin-top: 3px;
      font-size: 0.85rem;
      color: #777;
    }
    .confirm-card-body { padding: 18px; }

    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin-top: 14px;
    }
    .info-item {
      border: 1px solid rgba(92, 75, 67, 0.12);
      background: #fdfbf7;
      border-radius: 10px;
      padding: 12px 12px;
    }
    .info-item span {
      display: block;
      font-size: 0.72rem;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #999;
      font-weight: 700;
    }
    .info-item strong {
      display: block;
      margin-top: 6px;
      font-size: 0.9rem;
      color: #1a1a1a;
      line-height: 1.4;
    }

    .next-steps {
      margin-top: 18px;
      display: grid;
      gap: 10px;
    }
    .step {
      display: flex;
      gap: 12px;
      align-items: flex-start;
      padding: 12px;
      border: 1px solid rgba(92, 75, 67, 0.12);
      border-radius: 10px;
      background: #fff;
    }
    .step i {
      width: 18px;
      height: 18px;
      color: #5c4b43;
      flex: 0 0 auto;
      margin-top: 1px;
    }
    .step strong {
      display: block;
      font-size: 0.9rem;
      color: #1a1a1a;
      margin-bottom: 4px;
    }
    .step span {
      display: block;
      font-size: 0.85rem;
      color: #777;
      line-height: 1.55;
    }

    .confirm-actions {
      display: flex;
      gap: 12px;
      margin-top: 18px;
      flex-wrap: wrap;
    }
    .btn-primary, .btn-ghost {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 13px 16px;
      border-radius: 10px;
      font-size: 0.85rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      text-decoration: none;
      cursor: pointer;
    }
    .btn-primary { background: #5c4b43; color: #fff; border: 1px solid #5c4b43; }
    .btn-primary:hover { background: #4a3c36; border-color: #4a3c36; }
    .btn-ghost { background: transparent; color: #5c4b43; border: 1px solid rgba(92, 75, 67, 0.35); }
    .btn-ghost:hover { border-color: #5c4b43; background: rgba(92, 75, 67, 0.05); }
    .btn-primary i, .btn-ghost i { width: 16px; height: 16px; }

    /* Sidebar summary */
    .summary {
      background: #fdfbf7;
      padding: 24px;
      border-radius: 12px;
      border: 1px solid rgba(92, 75, 67, 0.12);
      position: sticky;
      top: 100px;
    }
    .summary h3 {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      margin-bottom: 16px;
      padding-bottom: 14px;
      border-bottom: 1px solid #eee;
    }
    .summary-row {
      display: flex;
      justify-content: space-between;
      font-size: 0.88rem;
      color: #666;
      margin-bottom: 10px;
    }
    .summary-row.total {
      margin-top: 14px;
      padding-top: 14px;
      border-top: 1px solid #eee;
      font-weight: 800;
      color: #1a1a1a;
      font-size: 1rem;
    }
    .summary-row.total span:last-child { color: #5c4b43; }
    .summary small {
      display: block;
      margin-top: 14px;
      color: #999;
      font-size: 0.78rem;
      line-height: 1.5;
      text-align: center;
    }

    @media (max-width: 900px) {
      .confirm-layout { grid-template-columns: 1fr; }
      .summary { position: static; }
      .info-grid { grid-template-columns: 1fr; }
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
      <a href="#" aria-label="Cart" class="cart-icon">
        <i data-lucide="shopping-cart"></i>
        <span class="cart-count">0</span>
      </a>
    </div>
  </header>

  <section class="confirm-hero">
    <h1>Order confirmed</h1>
    <p>
      Thank you for supporting Filipino craftsmanship. We’re preparing your items now — you’ll receive an email update once your order is on its way.
    </p>
  </section>

  <main class="confirm-layout">
    <section class="confirm-card" aria-label="Confirmation details">
      <div class="confirm-card-header">
        <div class="confirm-check"><i data-lucide="check"></i></div>
        <div>
          <strong>Thank you for your purchase</strong>
          <span>Order No. <span id="confirmOrderCode" style="letter-spacing:1px;">ART-2026-0410</span> • Estimated delivery 3–5 business days</span>
        </div>
      </div>
      <div class="confirm-card-body">
        <div class="info-grid">
          <div class="info-item">
            <span>Shipping to</span>
            <strong id="confirmShippingTo">Juan Dela Cruz<br/>City, Province, Philippines</strong>
          </div>
          <div class="info-item">
            <span>Payment method</span>
            <strong id="confirmPaymentMethod">Credit / Debit Card</strong>
          </div>
        </div>

        <div class="next-steps" aria-label="Next steps">
          <div class="step">
            <i data-lucide="package"></i>
            <div>
              <strong>We’re packing your order</strong>
              <span>Artisan partners prepare each item carefully before dispatch.</span>
            </div>
          </div>
          <div class="step">
            <i data-lucide="truck"></i>
            <div>
              <strong>Shipping updates</strong>
              <span>We’ll email you tracking information as soon as your parcel ships.</span>
            </div>
          </div>
          <div class="step">
            <i data-lucide="shield-check"></i>
            <div>
              <strong>Secure checkout</strong>
              <span>Your payment is protected and your details are encrypted.</span>
            </div>
          </div>
        </div>

        <div class="confirm-actions" aria-label="Actions">
          <a class="btn-primary" href="products.php"><i data-lucide="arrow-right"></i> Continue shopping</a>
          <a class="btn-ghost" href="index.php"><i data-lucide="home"></i> Back to home</a>
        </div>
      </div>
    </section>

    <aside class="summary" aria-label="Order summary">
      <h3>Order Summary</h3>
      <div class="summary-row"><span>Subtotal</span><span id="confirmSubtotal">₱3,050.00</span></div>
      <div class="summary-row"><span>Shipping</span><span id="confirmShippingFee">₱150.00</span></div>
      <div class="summary-row"><span>Tax</span><span>Included</span></div>
      <div class="summary-row"><span>Discount</span><span>—</span></div>
      <div class="summary-row total"><span>Total</span><span id="confirmTotal">₱3,200.00</span></div>
      <small>Design-only confirmation page. Values are placeholders.</small>
    </aside>
  </main>

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
    <input type="text" id="searchInput" placeholder="Search for handcrafted products..." />
    <button class="search-close" id="searchClose"><i data-lucide="x"></i></button>
  </div>

  <script src="components.js"></script>
  <script>
    (async function () {
      const formatPeso = (value) => '₱' + Number(value || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      const orderCode = localStorage.getItem('artisanLastOrderCode') || '';
      const cached = (() => {
        try {
          const raw = localStorage.getItem('artisanLastOrderData');
          return raw ? JSON.parse(raw) : null;
        } catch (e) {
          return null;
        }
      })();

      const codeNode = document.getElementById('confirmOrderCode');
      const shippingNode = document.getElementById('confirmShippingTo');
      const paymentNode = document.getElementById('confirmPaymentMethod');
      const subtotalNode = document.getElementById('confirmSubtotal');
      const shippingFeeNode = document.getElementById('confirmShippingFee');
      const totalNode = document.getElementById('confirmTotal');

      if (orderCode && codeNode) codeNode.textContent = orderCode;
      if (cached?.customer_name && shippingNode) shippingNode.innerHTML = `${cached.customer_name}<br/>Philippines`;
      if (cached?.payment_method && paymentNode) paymentNode.textContent = String(cached.payment_method).toUpperCase();
      if (cached?.total && totalNode) totalNode.textContent = formatPeso(cached.total);

      if (!orderCode) return;
      try {
        const response = await fetch('api/orders.php');
        if (!response.ok) return;
        const payload = await response.json();
        if (!payload.ok || !Array.isArray(payload.data)) return;
        const order = payload.data.find((item) => item.order_code === orderCode);
        if (!order) return;
        if (shippingNode) shippingNode.innerHTML = `${order.customer_name || 'Customer'}<br/>${order.customer_email || 'Philippines'}`;
        if (totalNode) totalNode.textContent = formatPeso(order.total || 0);
        if (subtotalNode && shippingFeeNode) {
          const shippingFee = 150;
          const total = Number(order.total || 0);
          subtotalNode.textContent = formatPeso(Math.max(0, total - shippingFee));
          shippingFeeNode.textContent = formatPeso(shippingFee);
        }
      } catch (e) {
        // Keep fallback confirmation values.
      }
    })();
  </script>
  <script src="auth-ui.js?v=2"></script>
</body>
</html>

