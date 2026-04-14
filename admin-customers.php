<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Users | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css?v=5">
</head>
<body>
  <div class="admin-layout">
    <aside class="admin-sidebar">
      <a class="admin-brand" href="admin-dashboard.php">Artisan</a>
      <p class="admin-subtitle">Admin Panel</p>
      <nav class="admin-nav">
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="admin-products.php">Products</a>
        <a href="admin-orders.php">Orders</a>
        <a class="active" href="admin-users.php">Users</a>
        <a href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Users</h1>
          <p class="admin-meta">Manage admin and customer accounts</p>
        </div>
      </div>

      <section class="grid-cards">
        <article class="card"><p class="label">Total Customers</p><p class="value">1,247</p><p class="delta up">+4.9% this month</p></article>
        <article class="card"><p class="label">Returning</p><p class="value">38%</p><p class="delta up">+1.2 points</p></article>
        <article class="card"><p class="label">Top Region</p><p class="value">NCR</p><p class="delta">432 customers</p></article>
        <article class="card"><p class="label">Avg. Spend</p><p class="value">₱2,140</p><p class="delta warn">-0.8% this month</p></article>
      </section>

      <section class="card">
        <div class="toolbar">
          <div class="left">
            <input type="text" placeholder="Search customer name/email">
          </div>
          <div class="right">
            <button class="btn btn-ghost">Export list</button>
          </div>
        </div>
        <table>
          <thead>
            <tr><th>Name</th><th>Email</th><th>Total Orders</th><th>Total Spent</th><th>Last Order</th></tr>
          </thead>
          <tbody id="customersTableBody">
            <tr><td>Maria Cruz</td><td>maria@email.com</td><td>8</td><td>₱9,240</td><td>Apr 08, 2026</td></tr>
            <tr><td>Rafael Santos</td><td>rafael@email.com</td><td>5</td><td>₱6,120</td><td>Apr 07, 2026</td></tr>
            <tr><td>Lia Reyes</td><td>lia@email.com</td><td>3</td><td>₱3,250</td><td>Apr 05, 2026</td></tr>
            <tr><td>John Ramos</td><td>john@email.com</td><td>2</td><td>₱2,150</td><td>Apr 02, 2026</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <script src="admin.js?v=5"></script>
</body>
</html>
