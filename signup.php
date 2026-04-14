<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Artisan</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;500&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; min-height: 100vh; display: grid; place-items: center; background: #f4eee8; margin: 0; }
        .card { width: min(460px, 92vw); background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.08); }
        h1 { margin: 0 0 16px; font-family: 'Playfair Display', serif; }
        .field { margin-bottom: 12px; }
        label { display:block; font-size: 0.78rem; color:#555; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 1px; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; border: 0; border-radius: 8px; background: #5c4b43; color:#fff; cursor: pointer; margin-top: 8px; }
        .feedback { min-height: 20px; margin-top: 10px; font-size: 0.85rem; }
        .muted { margin-top: 14px; font-size: 0.85rem; color:#666; text-align: center; }
    </style>
</head>
<body>
    <main class="card">
        <h1>Create your account</h1>
        <form id="signupForm">
            <div class="field"><label>First Name</label><input id="signupFirstName" required></div>
            <div class="field"><label>Last Name</label><input id="signupLastName" required></div>
            <div class="field"><label>Email</label><input id="signupEmail" type="email" required></div>
            <div class="field"><label>Password</label><input id="signupPassword" type="password" required></div>
            <div class="field"><label>Confirm Password</label><input id="signupConfirmPassword" type="password" required></div>
            <button type="submit">Sign Up</button>
        </form>
        <p class="feedback" id="signupFeedback"></p>
        <p class="muted">Already have an account? <a href="login.php">Log in</a></p>
    </main>

    <script>
        const signupForm = document.getElementById('signupForm');
        const signupFeedback = document.getElementById('signupFeedback');
        const firstName = document.getElementById('signupFirstName');
        const lastName = document.getElementById('signupLastName');
        const email = document.getElementById('signupEmail');
        const password = document.getElementById('signupPassword');
        const confirmPassword = document.getElementById('signupConfirmPassword');

        signupForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            signupFeedback.style.color = '#666';
            signupFeedback.textContent = 'Creating account...';

            if (password.value !== confirmPassword.value) {
                signupFeedback.style.color = '#c0392b';
                signupFeedback.textContent = 'Passwords do not match.';
                return;
            }

            try {
                const response = await fetch('api/register.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        first_name: firstName.value.trim(),
                        last_name: lastName.value.trim(),
                        email: email.value.trim(),
                        password: password.value,
                        confirm_password: confirmPassword.value
                    })
                });
                const payload = await response.json();
                if (!response.ok || !payload.ok) throw new Error(payload.message || 'Registration failed.');
                signupFeedback.style.color = '#2e7d32';
                signupFeedback.textContent = 'Account created. Redirecting to login...';
                setTimeout(() => { window.location.href = 'login.php'; }, 900);
            } catch (error) {
                signupFeedback.style.color = '#c0392b';
                signupFeedback.textContent = error.message || 'Unable to register right now.';
            }
        });
    </script>
</body>
</html>
