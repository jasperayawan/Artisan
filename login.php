<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Artisan</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500&family=Dancing+Script:wght@700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Shared Styles (Exactly same as above for consistency) */
        :root {
            --accent-brown: #6b4f31;
            --glass-bg: rgba(255, 255, 255, 0.75);
            --text-dark: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('assets/authbg.svg') center/cover no-repeat;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 550px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .auth-brand {
            background: rgba(107, 79, 49, 0.85);
            backdrop-filter: blur(10px);
            color: white;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-brand .logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            margin-bottom: 40px;
        }

        .auth-brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .auth-brand p {
            font-size: 1.1rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .auth-form-side {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            padding: 40px 60px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-small {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--accent-brown);
            margin-bottom: 10px;
        }

        .auth-form-side h2 {
            font-size: 1.4rem;
            margin-bottom: 25px;
            color: var(--text-dark);
        }

        .input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group input {
            width: 100%;
            padding: 8px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
            outline: none;
            font-size: 0.9rem;
        }

        .input-group label {
            position: absolute;
            left: 0;
            top: 8px;
            font-size: 0.85rem;
            color: #555;
            pointer-events: none;
            transition: 0.3s;
        }

        .input-group input:focus~label,
        .input-group input:not(:placeholder-shown)~label {
            top: -12px;
            font-size: 0.75rem;
            color: var(--accent-brown);
        }

        .submit-btn {
            background: var(--accent-brown);
            color: white;
            border: none;
            padding: 10px 40px;
            margin: 20px auto 0;
            display: block;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        .social-sidebar {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .social-sidebar i {
            width: 18px;
            opacity: 0.7;
            cursor: pointer;
        }

        .toggle-text {
            margin-top: 30px;
            font-size: 0.8rem;
            text-align: center;
        }

        .toggle-text a {
            color: var(--accent-brown);
            text-decoration: none;
            font-weight: 600;
        }

        .form-feedback {
            margin-top: 12px;
            text-align: center;
            font-size: 0.8rem;
            color: #333;
            min-height: 20px;
        }

        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-brand {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-brand">
            <div class="logo">Artisan</div>
            <h1>Join Our Family</h1>
            <p>Step into our world of craftsmanship and help us keep the tradition of the loom breathing.</p>
        </div>
        <div class="auth-form-side">
            <div class="social-sidebar">
                <i data-lucide="facebook"></i>
                <i data-lucide="twitter"></i>
                <i data-lucide="instagram"></i>
            </div>
            <div class="logo-small">Artisan</div>
            <h2>Log In</h2>
            <form id="loginForm">
                <div class="input-group">
                    <input id="loginEmail" type="email" placeholder=" " required>
                    <label>E-Mail:</label>
                </div>
                <div class="input-group">
                    <input id="loginPassword" type="password" placeholder=" " required>
                    <label>Password:</label>
                </div>
                <button type="submit" class="submit-btn">LOG IN</button>
            </form>
            <p class="form-feedback" id="loginFeedback"></p>
            <p class="toggle-text">Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>
    <script>
        lucide.createIcons();

        const loginForm = document.getElementById('loginForm');
        const loginEmail = document.getElementById('loginEmail');
        const loginPassword = document.getElementById('loginPassword');
        const loginFeedback = document.getElementById('loginFeedback');

        if (loginForm && loginEmail && loginPassword && loginFeedback) {
            loginForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                loginFeedback.textContent = 'Signing in...';
                loginFeedback.style.color = '#555';

                try {
                    const response = await fetch('api/login.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            email: loginEmail.value.trim(),
                            password: loginPassword.value
                        })
                    });
                    const payload = await response.json();
                    if (!response.ok || !payload.ok) {
                        throw new Error(payload.message || 'Login failed.');
                    }

                    const user = payload.data || {};
                    localStorage.setItem('artisanAuthUser', JSON.stringify({
                        id: user.id || null,
                        first_name: user.first_name || '',
                        last_name: user.last_name || '',
                        email: user.email || '',
                        role: user.role || 'customer'
                    }));

                    loginFeedback.textContent = 'Login successful. Redirecting...';
                    loginFeedback.style.color = '#2e7d32';
                    setTimeout(() => {
                        window.location.href = String(user.role || '').toLowerCase() === 'admin'
                            ? 'admin-dashboard.php'
                            : 'customer-dashboard.php';
                    }, 700);
                } catch (error) {
                    loginFeedback.textContent = error.message || 'Unable to login right now.';
                    loginFeedback.style.color = '#c0392b';
                }
            });
        }
    </script>
</body>

</html>