<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story | Artisan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary-text: #1a1a1a;
            --accent-gold: #b58d4c;
            --accent-brown: #5c4b43;
            --bg-cream: #fdfbf7;
            --white: #ffffff;
            --gray: #666;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--white);
            color: var(--primary-text);
            line-height: 1.6;
        }

        /* --- Reuse Header Styles --- */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: rgba(217, 197, 163, 0.35);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo { font-family: 'Dancing Script', cursive; font-size: 2.5rem; color: var(--primary-text); text-decoration: none; }
        nav a { text-decoration: none; color: var(--primary-text); margin: 0 15px; font-weight: 500; font-size: 0.9rem; }
        .nav-icons { display: flex; gap: 20px; align-items: center; }
        .nav-icons i { width: 20px; height: 20px; cursor: pointer; }

        /* --- About Hero Section --- */
        .about-hero {
            position: relative;
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), 
                        url('assets/aboutbg.svg');
            background-size: cover;
            display: flex;
            object-fit: cover;
            justify-content: center;
            align-items: flex-end;
            margin-bottom: 100px;
        }

        .hero-titles {
            position: absolute;
            bottom: -60px;
            text-align: center;
            z-index: 10;
        }

        .title-top {
            background: var(--accent-brown);
            color: white;
            padding: 15px 40px;
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            display: inline-block;
            margin-bottom: -5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .title-bottom {
            background: #4a3c36;
            color: white;
            padding: 10px 30px;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            display: block;
        }

        /* --- Story Content --- */
        .story-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 80px 5%;
            display: grid;
            grid-template-columns: 1fr 1.2fr 1fr;
            gap: 40px;
            align-items: flex-start;
        }

        .story-col {
            font-size: 0.95rem;
            color: #333;
        }

        .story-col strong { color: var(--primary-text); }

        .story-image img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 2px;
        }

        .philosophy-title {
            font-weight: 700;
            margin-bottom: 15px;
            display: block;
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


        @media (max-width: 900px) {
            .story-container { grid-template-columns: 1fr; }
            .title-top { font-size: 1.8rem; }
            .title-bottom { font-size: 0.9rem; letter-spacing: 2px; }
        }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Artisan</a>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php" style="color: var(--accent-gold);">About</a>
            <a href="products.php">Products</a>
            <a href="contact.php">Contacts</a>
        </nav>
        <div class="nav-icons">
            <i data-lucide="search"></i>
            <a href="login.php" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:5px;">
                <i data-lucide="user"></i> <span>Log in</span>
            </a>
            <i data-lucide="shopping-cart"></i>
        </div>
    </header>

    <section class="about-hero">
        <div class="hero-titles">
            <span class="title-top">Our Story</span>
            <span class="title-bottom">The Soul of the Weave</span>
        </div>
    </section>

    <div class="story-container">
        <div class="story-col">
            <p>At <strong>Artisan</strong>, we believe that a bag is never just a bag, and a bracelet is never just an accessory. They are living pieces of history. Born from the rich, diverse landscapes of Mindanao, our shop was created to bridge the gap between ancient tradition and modern life.</p>
            <br>
            <p>We serve as a canvas for the incredible weavers and artisans of the South, bringing the soul of the Philippines to your doorstep.</p>
        </div>

        <div class="story-image">
            <img src="assets/storybg.svg" alt="Artisan Product Collection">
        </div>

        <div class="story-col">
            <span class="philosophy-title">Our Philosophy</span>
            <p>We believe that every thread tells a story and every piece has "puso" (heart). Our shop serves as a bridge between the rich traditions of the South and the modern home. We don't just curate products; we preserve the living history of the Philippines, ensuring that the soul of our heritage continues to thrive in contemporary world.</p>
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

    <script>
        lucide.createIcons();
    </script>
    <script src="auth-ui.js"></script>
</body>
</html>