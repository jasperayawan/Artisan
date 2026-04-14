<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan | Handcrafted with Soul</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=1">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Artisan</a>
        <nav>
            <a href="index.php" style="color: var(--accent-gold);">Home</a>
            <a href="about.php">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contacts</a>    
        </nav>
        <div class="nav-icons">
            <a href="#" aria-label="Search"><i data-lucide="search"></i></a>
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

    <section class="hero">
        <h1>Welcome to Artisan.</h1>
        <p>Handcrafted with soul, rooted in tradition.</p>
    </section>

    <div class="features-strip">
        <div class="feature-item">
            <img src="assets/ph.svg" alt="Handcrafted">
            <p>FILIPINO HANDCRAFTED</p>
        </div>
        <div class="feature-item">
            <img  src="assets/leaves.svg" alt="Natural">
            <p>NATURAL MATERIALS</p>
        </div>
        <div class="feature-item">
            <img  src="assets/leaves2.svg" alt="Sustainable">
            <p>SUSTAINABLE  & ETHICAL</p>
        </div>
        <div class="feature-item">
            <img  src="assets/hands.svg" alt="Unique">
            <p>UNIQUE & ARTISANAL</p>
        </div>
        <div class="feature-item">
            <img  src="assets/cycle.svg" alt="Eco">
            <p>ECO-FRIENDLY</p>
        </div>
    </div>

    <section class="purpose-section">
        <div class="purpose-image">
            <img src="assets/purpose.png" alt="Weaving">
        </div>
        <div class="purpose-content">
            <h2>Our Purpose</h2>
            <div class="purpose-grid">
                <div>
                    <h3>Our Mission</h3>
                    <p>To empower Filipino artisans by bridging the gap between traditional craftsmanship and contemporary living. We are dedicated to delivering ethically made, sustainable, and high-quality handwoven products.</p>
                </div>
                <div>
                    <h3>Our Vision</h3>
                    <p>To become a globally recognized symbol of Filipino artistry, where every home values the story behind the weave, and every artisan community thrives through preservation.</p>
                </div>
            </div>
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

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();
      });
    </script>
    <script src="auth-ui.js"></script>

</body>
</html>