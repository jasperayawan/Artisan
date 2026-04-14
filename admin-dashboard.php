<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css?v=6">
</head>
<body>
  <div class="admin-layout">
    <aside class="admin-sidebar">
      <a class="admin-brand" href="admin-dashboard.php">Artisan</a>
      <p class="admin-subtitle">Admin Panel</p>
      <nav class="admin-nav">
        <a class="active" href="admin-dashboard.php">Dashboard</a>
        <a href="admin-products.php">Products</a>
        <a href="admin-orders.php">Orders</a>
        <a href="admin-messages.php">Messages</a>
        <a href="admin-users.php">Users</a>
        <a href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Dashboard Overview</h1>
          <p class="admin-meta">Today: <span id="todayDate"></span></p>
        </div>
        <div class="topbar-right">
          <input class="search-input" type="text" placeholder="Search orders or products">
          <a class="btn btn-primary" href="admin-products.php" style="text-decoration:none;">Add Product</a>
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="grid-cards">
        <article class="card"><p class="label">Revenue</p><p class="value" id="dashboardRevenue">₱0.00</p><p class="delta up">Live from orders API</p></article>
        <article class="card"><p class="label">Orders</p><p class="value" id="dashboardOrders">0</p><p class="delta up">Live total orders</p></article>
        <article class="card"><p class="label">Avg. Order Value</p><p class="value" id="dashboardAov">₱0.00</p><p class="delta">Computed from API totals</p></article>
        <article class="card"><p class="label">Customers</p><p class="value" id="dashboardCustomers">0</p><p class="delta up">Unique purchasing customers</p></article>
        <article class="card"><p class="label">New contact messages</p><p class="value" id="dashboardNewMessages">0</p><p class="delta up">Unread (new)</p></article>
      </section>

      <section class="dashboard-grid">
        <article class="card">
          <h2 class="section-title">Sales Trend (Product Units Sold)</h2>
          <div id="dashboardSalesTrend" class="sales-trend-chart">
            <p class="sales-trend-empty">Loading product sales trend...</p>
          </div>
        </article>

        <article class="card">
          <h2 class="section-title">Low Stock Alerts</h2>
          <table>
            <thead><tr><th>Product</th><th>Stock</th></tr></thead>
            <tbody id="dashboardLowStockBody">
              <tr><td>Patterned Bangle</td><td>5 left</td></tr>
              <tr><td>Crimson Weave Fan</td><td>7 left</td></tr>
              <tr><td>Native Handbag</td><td>3 left</td></tr>
            </tbody>
          </table>
        </article>
      </section>

      <section class="card" style="margin-top:14px;">
        <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:10px;">
          <h2 class="section-title" style="margin-bottom:0;">Recent contact messages</h2>
          <a class="btn btn-ghost" href="admin-messages.php" style="text-decoration:none;">View all</a>
        </div>
        <table>
          <thead>
            <tr><th>From</th><th>Email</th><th>Subject</th><th>Preview</th><th>Status</th><th>Date</th></tr>
          </thead>
          <tbody id="dashboardContactMessagesBody">
            <tr><td colspan="6" style="color:#7a746f;">Loading...</td></tr>
          </tbody>
        </table>
      </section>

      <section class="card" style="margin-top:14px;">
        <h2 class="section-title">Recent Orders</h2>
        <table>
          <thead>
            <tr><th>Order ID</th><th>Customer</th><th>Total</th><th>Status</th><th>Date</th></tr>
          </thead>
          <tbody id="dashboardRecentOrdersBody">
            <tr><td>#A-1098</td><td>R. Santos</td><td>₱3,200</td><td><span class="chip paid">Paid</span></td><td>Apr 09, 2026</td></tr>
            <tr><td>#A-1097</td><td>M. Cruz</td><td>₱1,450</td><td><span class="chip shipped">Shipped</span></td><td>Apr 09, 2026</td></tr>
            <tr><td>#A-1096</td><td>J. Ramos</td><td>₱950</td><td><span class="chip pending">Pending</span></td><td>Apr 08, 2026</td></tr>
            <tr><td>#A-1095</td><td>A. Rivera</td><td>₱2,300</td><td><span class="chip delivered">Delivered</span></td><td>Apr 08, 2026</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <script src="admin.js?v=6"></script>
</body>
</html>
