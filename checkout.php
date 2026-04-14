<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Artisan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="components.css">
    <style>
        /* Progress Bar */
        .checkout-progress {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 8%;
            gap: 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .progress-step {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: #ccc;
        }

        .progress-step.done { color: #D9C5A3; }
        .progress-step.active { color: #5c4b43; }

        .progress-step .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .progress-step.done .step-num {
            background: #D9C5A3;
            color: white;
        }

        .progress-step.active .step-num {
            background: #5c4b43;
            color: white;
        }

        .progress-line {
            width: 60px;
            height: 1px;
            background: #eee;
            margin: 0 12px;
        }
        .progress-line.done { background: #D9C5A3; }

        /* Checkout Layout */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 50px;
            padding: 40px 8%;
            max-width: 1300px;
            margin: 0 auto;
            align-items: start;
        }

        /* Form Sections */
        .form-section {
            margin-bottom: 36px;
        }

        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
            color: #1a1a1a;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid.full { grid-template-columns: 1fr; }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-field label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #555;
        }

        .form-field input,
        .form-field select {
            padding: 11px 14px;
            border: 1.5px solid #ddd;
            font-size: 0.88rem;
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
            outline: none;
            transition: border-color 0.2s;
            background: white;
            border-radius: 2px;
        }

        .form-field input:focus,
        .form-field select:focus { border-color: #5c4b43; }

        .form-field.span-2 { grid-column: span 2; }

        /* Payment Methods */
        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1.5px solid #ddd;
            cursor: pointer;
            transition: border-color 0.2s;
            border-radius: 2px;
        }

        .payment-option:has(input:checked),
        .payment-option.selected { border-color: #5c4b43; background: #fdfbf7; }

        .payment-option input[type="radio"] { accent-color: #5c4b43; }

        .payment-option-label {
            flex: 1;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .payment-option-icons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .card-badge {
            background: #f0f0f0;
            border-radius: 3px;
            padding: 2px 7px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #555;
        }
        .card-badge.visa { background: #1a1f71; color: white; }
        .card-badge.mc { background: #eb001b; color: white; }

        .card-fields {
            display: none;
            padding: 16px;
            border: 1px solid #eee;
            background: #f9f9f9;
            margin-top: -2px;
        }
        .card-fields.active { display: block; }
        .card-fields .form-grid { gap: 12px; }

        /* Place Order */
        .place-order-btn {
            width: 100%;
            padding: 16px;
            background: #5c4b43;
            color: white;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
            font-family: 'Inter', sans-serif;
            margin-top: 8px;
        }
        .place-order-btn:hover { background: #4a3c36; }

        .terms-note {
            font-size: 0.75rem;
            color: #aaa;
            text-align: center;
            margin-top: 14px;
            line-height: 1.6;
        }

        /* Order Summary (right) */
        .checkout-summary {
            background: #fdfbf7;
            padding: 28px;
            border-radius: 4px;
            position: sticky;
            top: 100px;
        }

        .checkout-summary h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #eee;
        }

        .summary-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-item img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            background: white;
            border-radius: 4px;
            padding: 6px;
            flex-shrink: 0;
        }

        .summary-item-info { flex: 1; }

        .summary-item-info p {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-item-info span {
            font-size: 0.78rem;
            color: #999;
        }

        .summary-item-price {
            font-size: 0.88rem;
            font-weight: 600;
            color: #5c4b43;
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: #666;
            padding: 8px 0;
        }

        .summary-line.total {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            border-top: 1px solid #eee;
            margin-top: 8px;
            padding-top: 16px;
        }

        .summary-line.total span:last-child { color: #5c4b43; }

        @media (max-width: 900px) {
            .checkout-layout { grid-template-columns: 1fr; }
            .checkout-summary { position: static; }
            .form-grid { grid-template-columns: 1fr; }
            .form-field.span-2 { grid-column: span 1; }
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

    <!-- Progress -->
    <div class="checkout-progress">
        <div class="progress-step done">
            <div class="step-num"><i data-lucide="check" style="width:14px;height:14px;"></i></div>
            Cart
        </div>
        <div class="progress-line done"></div>
        <div class="progress-step active">
            <div class="step-num">2</div>
            Checkout
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <div class="step-num">3</div>
            Confirmation
        </div>
    </div>

    <div class="checkout-layout">
        <!-- Form Side -->
        <div>
            <!-- Contact -->
            <div class="form-section">
                <h2 class="form-section-title">Contact Information</h2>
                <div class="form-grid">
                    <div class="form-field">
                        <label>First Name</label>
                        <input id="checkoutFirstName" type="text" placeholder="Juan">
                    </div>
                    <div class="form-field">
                        <label>Last Name</label>
                        <input id="checkoutLastName" type="text" placeholder="Dela Cruz">
                    </div>
                    <div class="form-field">
                        <label>Email Address</label>
                        <input id="checkoutEmail" type="email" placeholder="juan@email.com">
                    </div>
                    <div class="form-field">
                        <label>Phone Number</label>
                        <input id="checkoutPhone" type="tel" placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>
            </div>

            <!-- Shipping -->
            <div class="form-section">
                <h2 class="form-section-title">Shipping Address</h2>
                <div class="form-grid">
                    <div class="form-field span-2">
                        <label>Street Address</label>
                        <input id="checkoutStreet" type="text" placeholder="House No., Street, Barangay">
                    </div>
                    <div class="form-field">
                        <label>City / Municipality</label>
                        <input id="checkoutCity" type="text" placeholder="City">
                    </div>
                    <div class="form-field">
                        <label>Province</label>
                        <input id="checkoutProvince" type="text" placeholder="Province">
                    </div>
                    <div class="form-field">
                        <label>Region</label>
                        <select id="checkoutRegion">
                            <option value="">Select Region</option>
                            <option>NCR</option>
                            <option>Region I</option>
                            <option>Region II</option>
                            <option>Region III</option>
                            <option>Region IV-A</option>
                            <option>Region VII</option>
                            <option>Region X</option>
                            <option>Region XI</option>
                            <option>Region XII</option>
                            <option>BARMM</option>
                        </select>
                    </div>
                    <div class="form-field">
                        <label>ZIP Code</label>
                        <input id="checkoutZipCode" type="text" placeholder="0000">
                    </div>
                </div>
            </div>

            <!-- Payment -->
            <div class="form-section">
                <h2 class="form-section-title">Payment Method</h2>
                <div class="payment-options">
                    <label class="payment-option selected" id="opt-card">
                        <input type="radio" name="payment" value="card" checked onchange="showCardFields(true)">
                        <span class="payment-option-label">Credit / Debit Card</span>
                        <div class="payment-option-icons">
                            <span class="card-badge visa">VISA</span>
                            <span class="card-badge mc">MC</span>
                        </div>
                    </label>
                    <label class="payment-option" id="opt-gcash">
                        <input type="radio" name="payment" value="gcash" onchange="showCardFields(false)">
                        <span class="payment-option-label">GCash</span>
                        <span class="card-badge" style="background:#0e7ef1;color:white;">G</span>
                    </label>
                    <label class="payment-option" id="opt-cod">
                        <input type="radio" name="payment" value="cod" onchange="showCardFields(false)">
                        <span class="payment-option-label">Cash on Delivery</span>
                        <i data-lucide="banknote" style="width:18px;height:18px;color:#999;"></i>
                    </label>
                </div>

                <div class="card-fields active" id="cardFields">
                    <div class="form-grid full">
                        <div class="form-field">
                            <label>Card Number</label>
                            <input type="text" placeholder="0000 0000 0000 0000" maxlength="19">
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="form-field">
                            <label>Expiry Date</label>
                            <input type="text" placeholder="MM / YY" maxlength="7">
                        </div>
                        <div class="form-field">
                            <label>CVV</label>
                            <input type="text" placeholder="•••" maxlength="4">
                        </div>
                    </div>
                </div>
            </div>

            <button class="place-order-btn" id="placeOrderBtn" type="button">
                Place Order — ₱3,200.00
            </button>
            <p class="terms-note" id="checkoutFeedback" style="margin-top:10px;"></p>
            <p class="terms-note">
                By placing your order, you agree to our Terms of Service and Privacy Policy.<br>
                Your payment is secured and encrypted.
            </p>
        </div>

        <!-- Order Summary -->
        <div class="checkout-summary">
            <h3>Your Order (4 items)</h3>

            <div class="summary-item">
                <img src="assets/bagaggah-removebg-preview 1.svg" alt="Native Handbag">
                <div class="summary-item-info">
                    <p>Native Handbag</p>
                    <span>Qty: 1</span>
                </div>
                <div class="summary-item-price">₱1,200.00</div>
            </div>

            <div class="summary-item">
                <img src="assets/kdjsfh-removebg-preview 1.svg" alt="Crimson Weave Fan">
                <div class="summary-item-info">
                    <p>Crimson Weave Fan</p>
                    <span>Qty: 2</span>
                </div>
                <div class="summary-item-price">₱900.00</div>
            </div>

            <div class="summary-item">
                <img src="assets/gfds-removebg-preview 1.svg" alt="Natural Fiber Slides">
                <div class="summary-item-info">
                    <p>Natural Fiber Slides</p>
                    <span>Qty: 1</span>
                </div>
                <div class="summary-item-price">₱950.00</div>
            </div>

            <div style="margin-top: 16px;">
                <div class="summary-line"><span>Subtotal</span><span>₱3,050.00</span></div>
                <div class="summary-line"><span>Shipping</span><span>₱150.00</span></div>
                <div class="summary-line"><span>Discount</span><span>—</span></div>
                <div class="summary-line total"><span>Total</span><span>₱3,200.00</span></div>
            </div>
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
        function showCardFields(show) {
            document.getElementById('cardFields').classList.toggle('active', show);
            document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
            const checked = document.querySelector('input[name="payment"]:checked');
            if (checked) checked.closest('.payment-option').classList.add('selected');
        }

        document.querySelectorAll('.payment-option input').forEach(input => {
            input.addEventListener('change', () => {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                input.closest('.payment-option').classList.add('selected');
            });
        });

        const SHIPPING_FEE = 150;
        const getCart = () => {
            try {
                const saved = localStorage.getItem('artisanCart');
                const parsed = saved ? JSON.parse(saved) : [];
                return Array.isArray(parsed) ? parsed : [];
            } catch (e) {
                return [];
            }
        };
        const peso = (value) => '₱' + Number(value || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        const escapeHtml = (value) => String(value || '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

        function collectOrderItems() {
            return getCart().map((item) => ({
                name: String(item.name || '').trim(),
                qty: Math.max(1, Number(item.qty || 1)),
                unit_price: Number(item.price || 0),
                image_path: String(item.img || '')
            })).filter((item) => item.name && item.unit_price > 0);
        }

        function renderCheckoutSummary() {
            const summary = document.querySelector('.checkout-summary');
            if (!summary) return;
            const items = collectOrderItems();
            const subtotal = items.reduce((sum, item) => sum + item.unit_price * item.qty, 0);
            const total = subtotal + (items.length ? SHIPPING_FEE : 0);

            const heading = summary.querySelector('h3');
            if (heading) {
                const itemCount = items.reduce((sum, item) => sum + item.qty, 0);
                heading.textContent = `Your Order (${itemCount} items)`;
            }

            const oldRows = Array.from(summary.querySelectorAll('.summary-item'));
            oldRows.forEach((row) => row.remove());

            const linesBlock = summary.querySelector('div[style="margin-top: 16px;"]');
            if (linesBlock && items.length) {
                items.forEach((item) => {
                    const row = document.createElement('div');
                    row.className = 'summary-item';
                    row.innerHTML = `
                        <img src="${escapeHtml(item.image_path)}" alt="${escapeHtml(item.name)}">
                        <div class="summary-item-info">
                            <p>${escapeHtml(item.name)}</p>
                            <span>Qty: ${item.qty}</span>
                        </div>
                        <div class="summary-item-price">${peso(item.unit_price * item.qty)}</div>
                    `;
                    summary.insertBefore(row, linesBlock);
                });
            }

            const summaryLines = summary.querySelectorAll('.summary-line');
            if (summaryLines.length >= 4) {
                summaryLines[0].querySelector('span:last-child').textContent = peso(subtotal);
                summaryLines[1].querySelector('span:last-child').textContent = items.length ? peso(SHIPPING_FEE) : '—';
                summaryLines[3].querySelector('span:last-child').textContent = peso(total);
            }

            const placeOrderBtn = document.getElementById('placeOrderBtn');
            if (placeOrderBtn) placeOrderBtn.textContent = `Place Order — ${peso(total)}`;
        }

        renderCheckoutSummary();

        const placeOrderBtn = document.getElementById('placeOrderBtn');
        const checkoutFeedback = document.getElementById('checkoutFeedback');
        const getField = (id) => document.getElementById(id);

        if (placeOrderBtn && checkoutFeedback) {
            placeOrderBtn.addEventListener('click', async () => {
                checkoutFeedback.textContent = 'Placing your order...';
                checkoutFeedback.style.color = '#666';

                const selectedPayment = document.querySelector('input[name="payment"]:checked');
                const payload = {
                    first_name: getField('checkoutFirstName')?.value.trim() || '',
                    last_name: getField('checkoutLastName')?.value.trim() || '',
                    customer_email: getField('checkoutEmail')?.value.trim() || '',
                    customer_phone: getField('checkoutPhone')?.value.trim() || '',
                    street_address: getField('checkoutStreet')?.value.trim() || '',
                    city: getField('checkoutCity')?.value.trim() || '',
                    province: getField('checkoutProvince')?.value.trim() || '',
                    region: getField('checkoutRegion')?.value || '',
                    zip_code: getField('checkoutZipCode')?.value.trim() || '',
                    payment_method: selectedPayment?.value || 'cod',
                    shipping_fee: SHIPPING_FEE,
                    items: collectOrderItems()
                };

                try {
                    const response = await fetch('api/orders.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                    const result = await response.json();
                    if (!response.ok || !result.ok || !result.data) {
                        throw new Error(result.message || 'Failed to place order.');
                    }

                    localStorage.setItem('artisanLastOrderCode', result.data.order_code || '');
                    localStorage.setItem('artisanLastOrderData', JSON.stringify(result.data));
                    localStorage.removeItem('artisanCart');
                    checkoutFeedback.textContent = 'Order placed successfully. Redirecting...';
                    checkoutFeedback.style.color = '#2e7d32';
                    setTimeout(() => {
                        window.location.href = 'order-confirmation.php';
                    }, 700);
                } catch (error) {
                    checkoutFeedback.textContent = error.message || 'Unable to place order now.';
                    checkoutFeedback.style.color = '#c0392b';
                }
            });
        }
    </script>
    <script src="auth-ui.js?v=2"></script>
</body>
</html>
