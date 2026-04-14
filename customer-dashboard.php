<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="style.css?v=2">
  <link rel="stylesheet" href="components.css?v=2">
  <style>
    .account-hero {
      padding: 40px 8% 18px;
      border-bottom: 1px solid #f0f0f0;
      background: linear-gradient(180deg, rgba(217, 197, 163, 0.18), rgba(255,255,255,0));
    }
    .account-hero h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: #1a1a1a;
    }
    .account-hero p {
      margin-top: 8px;
      color: #777;
      font-size: 0.92rem;
      line-height: 1.6;
    }
    .account-layout {
      max-width: 1200px;
      margin: 0 auto;
      padding: 26px 8% 70px;
      display: grid;
      grid-template-columns: 320px 1fr;
      gap: 20px;
      align-items: start;
    }
    .account-card {
      background: #fff;
      border: 1px solid rgba(92, 75, 67, 0.14);
      border-radius: 12px;
      padding: 16px;
      box-shadow: 0 18px 50px rgba(0,0,0,0.06);
    }
    .profile-title {
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      color: #777;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .profile-name {
      font-weight: 800;
      font-size: 1.1rem;
      color: #1a1a1a;
      margin-bottom: 4px;
    }
    .profile-meta { color: #777; font-size: 0.88rem; }
    .profile-actions { display:flex; gap:10px; margin-top:14px; flex-wrap: wrap; }
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 11px 14px;
      border-radius: 10px;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      text-decoration: none;
      cursor: pointer;
      border: 1px solid rgba(92, 75, 67, 0.35);
      color: #5c4b43;
      background: transparent;
    }
    .btn-primary {
      background: #5c4b43;
      color: #fff;
      border-color: #5c4b43;
    }
    .btn-primary:hover { background: #4a3c36; border-color: #4a3c36; }
    .btn i { width: 16px; height: 16px; }

    table { width:100%; border-collapse: collapse; }
    th, td { padding: 10px 8px; border-bottom: 1px solid #eee; text-align: left; font-size: 0.9rem; }
    th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1.2px; color: #777; }
    .chip {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 0.75rem;
      font-weight: 700;
    }
    .chip.pending { background: #fff4e5; color: #aa6609; }
    .chip.paid { background: #e9f9ee; color: #1f7b3d; }
    .chip.shipped { background: #e8f1ff; color: #2058ac; }
    .chip.delivered { background: #e8f9f5; color: #15745b; }
    .chip.cancelled { background: #fdecea; color: #b3261e; }

    .empty {
      padding: 18px;
      color: #777;
      background: #fdfbf7;
      border: 1px dashed rgba(92, 75, 67, 0.25);
      border-radius: 12px;
      text-align: center;
    }

    @media (max-width: 900px) {
      .account-layout { grid-template-columns: 1fr; }
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
      <a href="login.php" class="login-link" aria-label="Login">
        <i data-lucide="user"></i>
        <span>Log in</span>
      </a>
      <a href="#" aria-label="Cart" class="cart-icon">
        <i data-lucide="shopping-cart"></i>
        <span class="cart-count">0</span>
      </a>
    </div>
  </header>

  <section class="account-hero">
    <h1>My Account</h1>
    <p>View your recent orders and manage your session.</p>
  </section>

  <main class="account-layout">
    <aside class="account-card">
      <div class="profile-title">Signed in as</div>
      <div class="profile-name" id="profileName">Customer</div>
      <div class="profile-meta" id="profileEmail">—</div>
      <div class="profile-actions">
        <a class="btn" href="products.php"><i data-lucide="shopping-bag"></i> Shop</a>
        <button class="btn btn-primary" type="button" id="logoutBtn"><i data-lucide="log-out"></i> Logout</button>
      </div>
    </aside>

    <section class="account-card">
      <div class="profile-title">My Orders</div>
      <div id="ordersState" class="empty">Loading your orders...</div>
      <div style="overflow:auto;">
        <table id="ordersTable" style="display:none;">
          <thead>
            <tr>
              <th>Order</th>
              <th>Items</th>
              <th>Total</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody id="ordersBody"></tbody>
        </table>
      </div>
    </section>
  </main>

  <script>
    lucide.createIcons();

    const peso = (value) => '₱' + Number(value || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    const statusClass = (status) => {
      const s = String(status || '').toLowerCase();
      if (s === 'paid') return 'paid';
      if (s === 'shipped') return 'shipped';
      if (s === 'delivered') return 'delivered';
      if (s === 'cancelled') return 'cancelled';
      return 'pending';
    };

    const getAuthUser = () => {
      try {
        const raw = localStorage.getItem('artisanAuthUser');
        return raw ? JSON.parse(raw) : null;
      } catch (e) {
        return null;
      }
    };

    const authUser = getAuthUser();
    if (!authUser || String(authUser.role || '').toLowerCase() !== 'customer') {
      window.location.href = 'login.php';
    }

    const profileName = document.getElementById('profileName');
    const profileEmail = document.getElementById('profileEmail');
    if (profileName) profileName.textContent = `${authUser.first_name || ''} ${authUser.last_name || ''}`.trim() || 'Customer';
    if (profileEmail) profileEmail.textContent = authUser.email || '—';

    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
      logoutBtn.addEventListener('click', () => {
        localStorage.removeItem('artisanAuthUser');
        window.location.href = 'index.php';
      });
    }

    const ordersState = document.getElementById('ordersState');
    const ordersTable = document.getElementById('ordersTable');
    const ordersBody = document.getElementById('ordersBody');

    (async function loadMyOrders() {
      try {
        const res = await fetch(`api/my-orders.php?email=${encodeURIComponent(authUser.email || '')}`);
        const payload = await res.json();
        if (!res.ok || !payload.ok || !Array.isArray(payload.data)) {
          throw new Error(payload.message || 'Failed to load orders.');
        }

        const orders = payload.data;
        if (!orders.length) {
          if (ordersState) ordersState.textContent = 'No orders found yet. Place an order to see it here.';
          return;
        }

        if (ordersState) ordersState.style.display = 'none';
        if (ordersTable) ordersTable.style.display = 'table';

        ordersBody.innerHTML = orders.map((o) => {
          const date = o.created_at ? new Date(o.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' }) : '—';
          return `
            <tr>
              <td>#${o.order_code || ''}</td>
              <td>${Number(o.item_count || 0)}</td>
              <td>${peso(o.total || 0)}</td>
              <td><span class="chip ${statusClass(o.status)}">${o.status || 'Pending'}</span></td>
              <td>${date}</td>
            </tr>
          `;
        }).join('');
      } catch (err) {
        if (ordersState) ordersState.textContent = err.message || 'Unable to load orders right now.';
      }
    })();
  </script>

  <script src="auth-ui.js?v=2"></script>
</body>
</html>

