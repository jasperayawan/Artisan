<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Orders | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="admin-layout">
    <aside class="admin-sidebar">
      <a class="admin-brand" href="admin-dashboard.php">Artisan</a>
      <p class="admin-subtitle">Admin Panel</p>
      <nav class="admin-nav">
        <a href="admin-dashboard.php">Dashboard</a>
        <a href="admin-products.php">Products</a>
        <a class="active" href="admin-orders.php">Orders</a>
        <a href="admin-users.php">Users</a>
        <a href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Orders</h1>
          <p class="admin-meta">Monitor order status and fulfillment</p>
        </div>
        <div class="topbar-right">
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="card">
        <div class="toolbar">
          <div class="left">
            <input type="text" placeholder="Search order ID / customer">
            <select>
              <option>All Status</option>
              <option>Pending</option>
              <option>Paid</option>
              <option>Shipped</option>
              <option>Delivered</option>
            </select>
          </div>
          <div class="right">
            <button class="btn btn-ghost">Export CSV</button>
          </div>
        </div>

        <table>
          <thead>
            <tr><th>Order</th><th>Customer</th><th>Items</th><th>Total</th><th>Status</th><th>Date</th></tr>
          </thead>
          <tbody id="ordersTableBody">
            <tr><td>#A-1101</td><td>Lea Alvarez</td><td>2</td><td>₱1,700</td><td><span class="chip pending">Pending</span></td><td>Apr 09, 2026</td></tr>
            <tr><td>#A-1100</td><td>Paul Dizon</td><td>1</td><td>₱1,200</td><td><span class="chip paid">Paid</span></td><td>Apr 09, 2026</td></tr>
            <tr><td>#A-1099</td><td>Kaye Flores</td><td>3</td><td>₱2,580</td><td><span class="chip shipped">Shipped</span></td><td>Apr 08, 2026</td></tr>
            <tr><td>#A-1098</td><td>R. Santos</td><td>4</td><td>₱3,200</td><td><span class="chip delivered">Delivered</span></td><td>Apr 08, 2026</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <script src="admin.js"></script>
</body>
</html>
