<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Artisan</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="style.css?v=1">
    <style>
        :root {
            --accent-gold: #8b6d4d;
            --form-bg: rgba(139, 109, 77, 0.4); /* Translucent brown */
            --input-bg: rgba(255, 255, 255, 0.2);
        }                                  
        .contact-hero {
            min-height: 90vh;
            background: url('assets/contactbg.svg') no-repeat center center/cover; /* Use your weaving background image here */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .contact-overlay {
            background: rgba(0, 0, 0, 0.6); /* Dark tint over the background image */
            width: 100%;
            max-width: 900px;
            padding: 50px;
            border-radius: 4px;
            color: white;
        }

        .contact-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-header h1 {
            font-size: 2.5rem;
            font-family: serif;
            margin-bottom: 10px;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 50px;
        }

        /* Info Section */
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
        }

        .info-item span {
            display: block;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .social-links {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .social-links i {
            cursor: pointer;
            transition: color 0.3s;
        }

        .social-links i:hover {
            color: var(--accent-gold);
        }

        /* Form Section */
        .contact-form {
            background: var(--form-bg);
            padding: 30px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .form-group input, 
        .form-group textarea {
            width: 100%;
            padding: 10px;
            background: var(--input-bg);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: white;
            border-radius: 4px;
        }

        .send-btn {
            background: #5d4037; /* Darker brown from design */
            color: white;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .send-btn:hover {
            background: var(--accent-gold);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
            }
            .contact-overlay {
                padding: 20px;
            }
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
            <a href="contact.php" style="color: var(--accent-gold);">Contacts</a>    
        </nav>
        <div class="nav-icons">
            <i data-lucide="search"></i>
            <a href="login.php" style="color:inherit;"><i data-lucide="user"></i></a>
            <i data-lucide="shopping-cart"></i>
        </div>
    </header>

    <section class="contact-hero">
        <div class="contact-overlay">
            <div class="contact-header">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you. Connect with us to learn more about our handcrafted products or for any inquiries.</p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="info-item">
                        <i data-lucide="mail"></i>
                        <div>
                            <span>EMAIL:</span>
                            <p>Artisan@craftph.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i data-lucide="phone"></i>
                        <div>
                            <span>PHONE:</span>
                            <p>+63 123 456 7890</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i data-lucide="map-pin"></i>
                        <div>
                            <span>LOCATION:</span>
                            <p>Mindanao, Philippines</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <i data-lucide="facebook"></i>
                        <i data-lucide="twitter"></i>
                        <i data-lucide="instagram"></i>
                    </div>
                </div>

                <form class="contact-form">
                    <p id="contactFeedback" style="margin-bottom:12px; font-size:0.9rem; color:#fff; display:none;"></p>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Subject:</label>
                        <input type="text" name="subject">
                    </div>
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="send-btn">SEND MESSAGE</button>
                </form>
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
        lucide.createIcons();
    </script>
    <script>
        (function () {
            const form = document.querySelector('.contact-form');
            if (!form) return;
            const feedback = document.getElementById('contactFeedback');
            const btn = form.querySelector('button[type="submit"]');

            const show = (message, type) => {
                if (!feedback) return;
                feedback.style.display = 'block';
                feedback.textContent = message;
                feedback.style.color = type === 'ok' ? '#b7f7c2' : (type === 'warn' ? '#ffe8b2' : '#ffd0cc');
            };

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                if (!btn) return;

                const fd = new FormData(form);
                const payload = {
                    name: String(fd.get('name') || '').trim(),
                    email: String(fd.get('email') || '').trim(),
                    subject: String(fd.get('subject') || '').trim(),
                    message: String(fd.get('message') || '').trim()
                };

                if (!payload.name || !payload.email || !payload.message) {
                    show('Please fill in name, email, and message.', 'error');
                    return;
                }

                btn.disabled = true;
                const oldText = btn.textContent;
                btn.textContent = 'SENDING...';
                show('Sending your message...', 'warn');

                try {
                    const res = await fetch('api/contact.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                    const data = await res.json().catch(() => ({}));
                    if (!res.ok || !data.ok) {
                        throw new Error(data.message || 'Unable to send message.');
                    }
                    form.reset();
                    show('Message sent! We’ll get back to you soon.', 'ok');
                } catch (err) {
                    show(err.message || 'Unable to send message right now.', 'error');
                } finally {
                    btn.disabled = false;
                    btn.textContent = oldText;
                }
            });
        })();
    </script>
    <script src="auth-ui.js?v=2"></script>
</body>
</html>