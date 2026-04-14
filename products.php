<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Artisan Handcrafted</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="components.css">
    <style>
        :root {
            --primary-text: #1a1a1a;
            --accent-gold: #b58d4c;
            --accent-brown: #5c4b43;
            --bg-cream: #f4eee8;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--primary-text);
        }

        /* --- Header --- */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: var(--bg-cream);
        }

        .logo { font-family: 'Dancing Script', cursive; font-size: 2.5rem; color: var(--primary-text); text-decoration: none; }
        nav a { text-decoration: none; color: var(--primary-text); margin: 0 15px; font-weight: 500; font-size: 0.9rem; }
        .nav-icons { display: flex; gap: 20px; align-items: center; }
        .nav-icons i { width: 20px; height: 20px; cursor: pointer; }

        /* --- Hero Banner --- */
        .product-hero {
            height: 25vh;
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
                        url('assets/productsbg.svg');
            background-size: cover;
            object-fit: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-hero h1 {
            font-family: 'Dancing Script', cursive;
            color: white;
            font-size: 4rem;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }

        /* --- Filter Bar --- */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px 0;
            background: white;
        }

        .filter-btn {
            background: #b59b81;
            color: white;
            border: none;
            padding: 8px 35px;
            font-family: 'Playfair Display', serif;
            cursor: pointer;
            transition: 0.3s;
            text-transform: capitalize;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--accent-brown);
        }

        /* --- Products Main Section --- */
        .products-section {
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                        url('https://images.unsplash.com/photo-1511119255013-094391696081?auto=format&fit=crop&q=80&w=1200') center/cover fixed;
            padding: 60px 5%;
            display: flex;
            justify-content: center;
        }

        .products-grid-overlay {
            background: rgba(92, 75, 67, 0.7); /* Deep brown semi-transparent */
            backdrop-filter: blur(5px);
            padding: 50px;
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .product-card:hover { transform: translateY(-5px); }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background: #f9f9f9;
            margin-bottom: 15px;
        }

        .product-card h3 {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            height: 40px;
            overflow: hidden;
        }

        .product-card p {
            font-weight: bold;
            color: var(--accent-brown);
            font-size: 0.9rem;
        }

        .product-card .card-actions {
            margin-top: 12px;
            display: flex;
            justify-content: center;
        }
        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(92, 75, 67, 0.25);
            background: rgba(92, 75, 67, 0.04);
            color: var(--accent-brown);
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }
        .add-btn:hover {
            transform: translateY(-1px);
            background: rgba(92, 75, 67, 0.08);
            border-color: rgba(92, 75, 67, 0.38);
        }
        .add-btn i { width: 16px; height: 16px; }
        .filter-wrapper {
            width: 100%;
            overflow-x: auto; /* Allows horizontal swipe on mobile */
            padding: 20px 0;
            scrollbar-width: none; /* Hides scrollbar for Firefox */
        }

        .filter-wrapper::-webkit-scrollbar { display: none; } /* Hides scrollbar for Chrome/Safari */

        .filter-container {
            display: flex;
            justify-content: center;
            gap: 12px;
            padding: 10px;
            min-width: max-content; /* Prevents squishing */
            margin: 0 auto;
        }

        .filter-btn {
            background: transparent;
            color: var(--accent-brown);
            border: 1px solid rgba(92, 75, 67, 0.3);
            padding: 10px 24px;
            border-radius: 50px; /* Pill shape */
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            white-space: nowrap;
        }

        /* Hover State */
        .filter-btn:hover {
            border-color: var(--accent-brown);
            background: rgba(92, 75, 67, 0.05);
            transform: translateY(-2px);
        }

        /* Active State */
        .filter-btn.active {
            background: var(--accent-brown);
            color: white;
            border-color: var(--accent-brown);
            box-shadow: 0 4px 15px rgba(92, 75, 67, 0.2);
        }

        /* Subtle dot indicator for the active button */
        .filter-btn.active::after {
            content: '';
            display: block;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            margin: 4px auto -8px;
        }

        /* --- Footer --- */
        footer {
            background: #1a1a1a;
            color: #ccc;
            padding: 60px 10% 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--white);
            margin-bottom: 15px;
            display: block;
        }

        .footer-col h4 {
            color: var(--white);
            margin-bottom: 20px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; font-size: 0.9rem; }

        .newsletter input {
            padding: 10px;
            width: 100%;
            background: #333;
            border: none;
            color: white;
            margin-bottom: 10px;
        }

        .copyright {
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 20px;
            font-size: 0.8rem;
        }


        @media (max-width: 768px) {
            .filter-container { flex-wrap: wrap; padding: 20px; }
            .products-grid-overlay { padding: 20px; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); }
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Artisan</a>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="products.php" style="color: var(--accent-gold);">Products</a>
            <a href="contact.php">Contacts</a>    
        </nav>
        <div class="nav-icons">
            <a href="#" class="search-trigger" aria-label="Search"><i data-lucide="search"></i></a>
            <a href="login.php" class="login-link" aria-label="Login">
                <i data-lucide="user"></i>
            </a>
            <a href="#" aria-label="Cart" class="cart-icon">
                <i data-lucide="shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </header>

    <section class="product-hero">
        <h1>Products</h1>
    </section>

    <div class="filter-wrapper">
        <div class="filter-container">
            <button class="filter-btn active" data-filter="all">All Items</button>
            <button class="filter-btn" data-filter="bags">Handcrafted Bags</button>
            <button class="filter-btn" data-filter="fan">Traditional Fans</button>
            <button class="filter-btn" data-filter="bracelet">Artisan Bracelets</button>
            <button class="filter-btn" data-filter="sandals">Native Sandals</button>
        </div>
    </div>

    <section class="products-section">
        <div class="products-grid-overlay" id="productGrid">
            <p id="productsStatus" style="grid-column: 1 / -1; color: #fff; text-align:center; font-size: 0.95rem;">Loading products from API...</p>
        </div>
    </section>


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
        lucide.createIcons();

        const filterBtns = document.querySelectorAll('.filter-btn');
        const productGrid = document.getElementById('productGrid');
        let productCards = document.querySelectorAll('.product-card');
        const API_PRODUCTS = 'api/products.php';
        const productsStatus = document.getElementById('productsStatus');
        const categoryToKey = {
            'Handcrafted Bags': 'bags',
            'Traditional Fans': 'fan',
            'Artisan Bracelets': 'bracelet',
            'Native Sandals': 'sandals'
        };
        const keyToCategory = {
            bags: 'Handcrafted Bags',
            fan: 'Traditional Fans',
            bracelet: 'Artisan Bracelets',
            sandals: 'Native Sandals'
        };

        function escapeHtml(value) {
            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function renderProducts(products) {
            productGrid.innerHTML = products.map(item => {
                const categoryKey = categoryToKey[item.category] || 'bags';
                const safeName = escapeHtml(item.name);
                const safeCategory = escapeHtml(item.category);
                const safeImg = item.image_path ? escapeHtml(item.image_path) : 'assets/bagaggah-removebg-preview 1.svg';
                const priceNum = Number(item.price || 0);
                const priceDisplay = '₱' + priceNum.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                return `
                    <div class="product-card" data-category="${categoryKey}" data-name="${safeName}" data-price="${priceNum}" data-img="${safeImg}">
                        <img src="${safeImg}" alt="${safeName}">
                        <h3>${safeName}</h3>
                        <p>${priceDisplay}</p>
                        <div class="card-actions">
                            <button class="add-btn" type="button"><i data-lucide="plus"></i> Add to Cart</button>
                        </div>
                    </div>`;
            }).join('');
            lucide.createIcons();
            productCards = document.querySelectorAll('.product-card');
            wireProductCards();
        }

        async function loadProductsFromApi() {
            try {
                const res = await fetch(API_PRODUCTS);
                if (!res.ok) {
                    throw new Error('API responded with an error.');
                }
                const payload = await res.json();
                if (!payload.ok || !Array.isArray(payload.data)) {
                    throw new Error(payload.message || 'Invalid API payload.');
                }
                renderProducts(payload.data);
                if (productsStatus) productsStatus.remove();
            } catch (e) {
                productGrid.innerHTML = `
                    <p style="grid-column: 1 / -1; color: #fff; text-align:center; font-size: 0.95rem;">
                        Failed to load products from API. Please check your backend server and database connection.
                    </p>`;
            }
        }

        function wireProductCards() {
            productCards.forEach(card => {
                card.style.cursor = 'pointer';
                card.addEventListener('click', () => {
                    const name = card.getAttribute('data-name') || 'Handcrafted Item';
                    const price = card.getAttribute('data-price') || '0';
                    const img = card.getAttribute('data-img') || '';
                    const categoryKey = card.getAttribute('data-category') || 'all';
                    const categoryLabel = keyToCategory[categoryKey] || 'Handcrafted Collection';
                    const params = new URLSearchParams({
                        name,
                        price,
                        img,
                        category: categoryLabel
                    });
                    window.location.href = `product-detail.php?${params.toString()}`;
                });

                const btn = card.querySelector('.add-btn');
                if (btn) {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const name = card.getAttribute('data-name') || 'Handcrafted Item';
                        const price = parseFloat(card.getAttribute('data-price') || '0');
                        const img = card.getAttribute('data-img') || '';
                        if (typeof addToCart === 'function') addToCart(name, price, img);
                    });
                }
            });
        }

        wireProductCards();
        loadProductsFromApi();

        // Filter logic
        filterBtns.forEach(button => {
            button.addEventListener('click', () => {
                filterBtns.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const filterValue = button.getAttribute('data-filter');
                productCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    if (filterValue === 'all' || cardCategory === filterValue) {
                        card.style.display = "block";
                        card.style.opacity = "0";
                        setTimeout(() => { card.style.opacity = "1"; }, 10);
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
    </script>
    <script src="auth-ui.js"></script>
</body>
</html>