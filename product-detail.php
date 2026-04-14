<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Native Handbag | Artisan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="components.css">
    <style>
        /* Breadcrumb */
        .breadcrumb {
            padding: 16px 8%;
            font-size: 0.8rem;
            color: #999;
            border-bottom: 1px solid #f0f0f0;
        }
        .breadcrumb a { color: #999; text-decoration: none; }
        .breadcrumb a:hover { color: #5c4b43; }
        .breadcrumb span { margin: 0 8px; }

        /* Product Detail Layout */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            padding: 60px 8%;
            max-width: 1300px;
            margin: 0 auto;
        }

        /* Image Column */
        .product-images { position: sticky; top: 100px; align-self: start; }

        .main-image {
            background: #f9f6f2;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            margin-bottom: 16px;
            height: 480px;
        }

        .main-image img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .thumbnail-row {
            display: flex;
            gap: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            background: #f9f6f2;
            border-radius: 4px;
            padding: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .thumbnail.active { border-color: #5c4b43; }
        .thumbnail img { max-height: 100%; object-fit: contain; }

        /* Info Column */
        .product-info { padding-top: 10px; }

        .product-category {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #D9C5A3;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            color: #1a1a1a;
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .product-price {
            font-size: 1.6rem;
            font-weight: 600;
            color: #5c4b43;
            margin-bottom: 24px;
        }

        .product-divider {
            border: none;
            border-top: 1px solid #eee;
            margin: 24px 0;
        }

        .product-description {
            font-size: 0.9rem;
            color: #555;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        /* Quantity */
        .label-sm {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 10px;
            display: block;
        }

        .qty-selector {
            display: flex;
            align-items: center;
            gap: 0;
            border: 1.5px solid #ddd;
            width: fit-content;
            margin-bottom: 24px;
        }

        .qty-btn {
            background: none;
            border: none;
            padding: 10px 16px;
            font-size: 1.1rem;
            cursor: pointer;
            color: #555;
            transition: background 0.2s;
        }
        .qty-btn:hover { background: #f5f5f5; }

        .qty-input {
            width: 48px;
            text-align: center;
            border: none;
            border-left: 1.5px solid #ddd;
            border-right: 1.5px solid #ddd;
            padding: 10px 0;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            outline: none;
        }

        /* Add to Cart */
        .add-to-cart-btn {
            width: 100%;
            padding: 15px;
            background: #5c4b43;
            color: white;
            border: none;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 12px;
            font-family: 'Inter', sans-serif;
        }
        .add-to-cart-btn:hover { background: #4a3c36; }

        .wishlist-btn {
            width: 100%;
            padding: 14px;
            background: transparent;
            color: #5c4b43;
            border: 1.5px solid #5c4b43;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .wishlist-btn:hover { background: #5c4b43; color: white; }
        .wishlist-btn i { width: 16px; height: 16px; }
        .wishlist-btn.active {
            background: #5c4b43;
            color: white;
        }

        /* Product Details Accordion */
        .detail-accordion { margin-top: 32px; }

        .accordion-item { border-top: 1px solid #eee; }
        .accordion-item:last-child { border-bottom: 1px solid #eee; }

        .accordion-btn {
            width: 100%;
            background: none;
            border: none;
            padding: 16px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a1a;
        }
        .accordion-btn i { width: 16px; height: 16px; color: #999; transition: transform 0.3s; }
        .accordion-btn.open i { transform: rotate(180deg); }

        .accordion-content {
            display: none;
            padding: 0 0 16px;
            font-size: 0.88rem;
            color: #666;
            line-height: 1.8;
        }
        .accordion-content.open { display: block; }

        .detail-list { list-style: none; }
        .detail-list li {
            display: flex;
            gap: 10px;
            margin-bottom: 6px;
        }
        .detail-list li::before {
            content: '—';
            color: #D9C5A3;
            flex-shrink: 0;
        }

        /* Related Products */
        .related-section {
            padding: 60px 8%;
            background: #fdfbf7;
        }

        .related-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #1a1a1a;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .related-card {
            background: white;
            padding: 16px;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            color: inherit;
            transition: transform 0.3s;
            display: block;
        }
        .related-card:hover { transform: translateY(-4px); }

        .related-card img {
            width: 100%;
            height: 160px;
            object-fit: contain;
            background: #f9f6f2;
            margin-bottom: 12px;
            border-radius: 4px;
            padding: 10px;
        }

        .related-card h4 {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            color: #1a1a1a;
        }

        .related-card p {
            font-size: 0.88rem;
            font-weight: 600;
            color: #5c4b43;
        }

        @media (max-width: 900px) {
            .product-detail { grid-template-columns: 1fr; gap: 30px; }
            .product-images { position: static; }
            .related-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 500px) {
            .main-image { height: 300px; }
            .related-grid { grid-template-columns: repeat(2, 1fr); }
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

    <div class="breadcrumb">
        <a href="index.php">Home</a><span>/</span>
        <a href="products.php">Products</a><span>/</span>
        <a href="products.php" id="breadcrumbCategory">Handcrafted Bags</a><span>/</span>
        <span id="breadcrumbProduct">Native Handbag</span>
    </div>

    <div class="product-detail">
        <!-- Image Column -->
        <div class="product-images">
            <div class="main-image">
                <img src="assets/bagaggah-removebg-preview 1.svg" alt="Native Handbag" id="mainImg">
            </div>
            <div class="thumbnail-row">
                <div class="thumbnail active" onclick="setImg(this, 'assets/bagaggah-removebg-preview 1.svg')">
                    <img src="assets/bagaggah-removebg-preview 1.svg" alt="">
                </div>
                <div class="thumbnail" onclick="setImg(this, 'assets/iofgd-removebg-preview 1.svg')">
                    <img src="assets/iofgd-removebg-preview 1.svg" alt="">
                </div>
                <div class="thumbnail" onclick="setImg(this, 'assets/bag2-removebg-preview 1.svg')">
                    <img src="assets/bag2-removebg-preview 1.svg" alt="">
                </div>
            </div>
        </div>

        <!-- Info Column -->
        <div class="product-info">
            <p class="product-category" id="productCategory">Handcrafted Bags</p>
            <h1 class="product-name" id="productName">Native Handbag</h1>
            <p class="product-price" id="productPrice">₱1,200.00</p>

            <hr class="product-divider">

            <p class="product-description">
                Woven by hand in the highlands of Mindanao, this native handbag is a living piece of Filipino heritage.
                Each bag is made using traditional <em>abaca</em> fiber techniques passed down through generations of skilled weavers.
                No two bags are exactly alike — small variations in pattern and color are a mark of authentic craftsmanship.
            </p>

            <span class="label-sm">Quantity</span>
            <div class="qty-selector">
                <button class="qty-btn" onclick="changeQty(-1)">−</button>
                <input class="qty-input" type="number" value="1" min="1" max="10" id="qtyInput">
                <button class="qty-btn" onclick="changeQty(1)">+</button>
            </div>

            <button class="add-to-cart-btn" onclick="handleAddToCart()">
                Add to Cart
            </button>
            <button class="wishlist-btn" id="wishlistBtn" type="button">
                <i data-lucide="heart"></i> Add to Wishlist
            </button>

            <div class="detail-accordion">
                <div class="accordion-item">
                    <button class="accordion-btn" onclick="toggleAccordion(this)">
                        Materials & Origin
                        <i data-lucide="chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <ul class="detail-list">
                            <li>Handwoven abaca fiber from Mindanao</li>
                            <li>Natural plant-based dyes</li>
                            <li>Rattan handles, locally sourced</li>
                            <li>Unlined interior with one inner pocket</li>
                            <li>Made in the Philippines by artisan cooperatives</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-btn" onclick="toggleAccordion(this)">
                        Dimensions
                        <i data-lucide="chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <ul class="detail-list">
                            <li>Height: 28 cm</li>
                            <li>Width: 35 cm</li>
                            <li>Depth: 12 cm</li>
                            <li>Handle drop: 20 cm</li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-btn" onclick="toggleAccordion(this)">
                        Care Instructions
                        <i data-lucide="chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <ul class="detail-list">
                            <li>Spot clean only with a damp cloth</li>
                            <li>Avoid prolonged exposure to direct sunlight</li>
                            <li>Store in a cool, dry place</li>
                            <li>Do not submerge in water</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <section class="related-section">
        <h2>You May Also Like</h2>
        <div class="related-grid">
            <a href="product-detail.php" class="related-card">
                <img src="assets/iofgd-removebg-preview 1.svg" alt="Striped Bow Tote">
                <h4>Striped Bow Tote</h4>
                <p>₱1,450.00</p>
            </a>
            <a href="product-detail.php" class="related-card">
                <img src="assets/kdjsfh-removebg-preview 1.svg" alt="Crimson Weave Fan">
                <h4>Crimson Weave Fan</h4>
                <p>₱450.00</p>
            </a>
            <a href="product-detail.php" class="related-card">
                <img src="assets/bbbb-removebg-preview 1.svg" alt="Patterned Bangle">
                <h4>Patterned Bangle</h4>
                <p>₱250.00</p>
            </a>
            <a href="product-detail.php" class="related-card">
                <img src="assets/gfds-removebg-preview 1.svg" alt="Natural Fiber Slides">
                <h4>Natural Fiber Slides</h4>
                <p>₱950.00</p>
            </a>
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
        function setImg(thumb, src) {
            document.getElementById('mainImg').src = src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }

        function changeQty(delta) {
            const input = document.getElementById('qtyInput');
            const newVal = Math.max(1, Math.min(10, parseInt(input.value) + delta));
            input.value = newVal;
        }

        function handleAddToCart() {
            const qty = parseInt(document.getElementById('qtyInput').value);
            for (let i = 0; i < qty; i++) {
                addToCart(PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_IMG);
            }
        }

        const FALLBACK_WISHLIST_KEY = 'artisanWishlist';
        let PRODUCT_NAME = 'Native Handbag';
        let PRODUCT_PRICE = 1200;
        let PRODUCT_IMG = 'assets/bagaggah-removebg-preview 1.svg';
        let PRODUCT_CATEGORY = 'Handcrafted Bags';

        function formatPrice(amount) {
            return '₱' + Number(amount).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function hydrateProductFromQuery() {
            const params = new URLSearchParams(window.location.search);
            const name = params.get('name');
            const price = params.get('price');
            const img = params.get('img');
            const category = params.get('category');

            if (name) PRODUCT_NAME = name;
            if (price && !Number.isNaN(Number(price))) PRODUCT_PRICE = Number(price);
            if (img) PRODUCT_IMG = img;
            if (category) PRODUCT_CATEGORY = category;

            const nameEl = document.getElementById('productName');
            const priceEl = document.getElementById('productPrice');
            const categoryEl = document.getElementById('productCategory');
            const breadcrumbCategoryEl = document.getElementById('breadcrumbCategory');
            const breadcrumbProductEl = document.getElementById('breadcrumbProduct');
            const mainImgEl = document.getElementById('mainImg');

            if (nameEl) nameEl.textContent = PRODUCT_NAME;
            if (priceEl) priceEl.textContent = formatPrice(PRODUCT_PRICE);
            if (categoryEl) categoryEl.textContent = PRODUCT_CATEGORY;
            if (breadcrumbCategoryEl) breadcrumbCategoryEl.textContent = PRODUCT_CATEGORY;
            if (breadcrumbProductEl) breadcrumbProductEl.textContent = PRODUCT_NAME;
            if (mainImgEl) {
                mainImgEl.src = PRODUCT_IMG;
                mainImgEl.alt = PRODUCT_NAME;
            }
            document.title = `${PRODUCT_NAME} | Artisan`;
        }

        function getWishlistItemsFallback() {
            try {
                const saved = localStorage.getItem(FALLBACK_WISHLIST_KEY);
                return saved ? JSON.parse(saved) : [];
            } catch (e) {
                return [];
            }
        }

        function setWishlistItemsFallback(items) {
            try {
                localStorage.setItem(FALLBACK_WISHLIST_KEY, JSON.stringify(items));
            } catch (e) {
                // no-op
            }
        }

        function safeIsInWishlist(name) {
            if (typeof isInWishlist === 'function') return isInWishlist(name);
            return getWishlistItemsFallback().some(item => item.name === name);
        }

        function safeToggleWishlist(name, price, imgSrc) {
            if (typeof toggleWishlist === 'function') {
                return toggleWishlist(name, price, imgSrc);
            }
            const items = getWishlistItemsFallback();
            const index = items.findIndex(item => item.name === name);
            let added = false;
            if (index >= 0) {
                items.splice(index, 1);
            } else {
                items.push({ name, price, img: imgSrc });
                added = true;
            }
            setWishlistItemsFallback(items);
            return added;
        }

        function updateWishlistButton() {
            const btn = document.getElementById('wishlistBtn');
            if (!btn) return;
            const added = safeIsInWishlist(PRODUCT_NAME);
            btn.classList.toggle('active', added);
            btn.innerHTML = `<i data-lucide="heart"></i> ${added ? 'Remove from Wishlist' : 'Add to Wishlist'}`;
            if (window.lucide && typeof lucide.createIcons === 'function') {
                lucide.createIcons();
            }
        }

        function handleWishlist() {
            safeToggleWishlist(PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_IMG);
            updateWishlistButton();
        }

        function toggleAccordion(btn) {
            const content = btn.nextElementSibling;
            const isOpen = content.classList.contains('open');
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            document.querySelectorAll('.accordion-btn').forEach(b => b.classList.remove('open'));
            if (!isOpen) {
                content.classList.add('open');
                btn.classList.add('open');
            }
        }

        const wishlistBtn = document.getElementById('wishlistBtn');
        if (wishlistBtn) {
            wishlistBtn.addEventListener('click', handleWishlist);
        }

        hydrateProductFromQuery();
        updateWishlistButton();
    </script>
    <script src="auth-ui.js"></script>
</body>
</html>
