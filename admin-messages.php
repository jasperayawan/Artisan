<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Messages | Artisan</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css?v=6">
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
        <a href="admin-messages.php" class="active">Messages</a>
        <a href="admin-users.php">Users</a>
        <a href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Contact Messages</h1>
          <p class="admin-meta">Inquiries from the contact form</p>
        </div>
        <div class="topbar-right">
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="card">
        <div class="toolbar">
          <div class="left">
            <input type="text" id="messagesSearch" placeholder="Search name or email">
          </div>
        </div>
        <table>
          <thead>
            <tr>
              <th>From</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody id="messagesTableBody">
            <tr><td colspan="6" style="color:#7a746f;">Loading messages...</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <script src="admin.js?v=6"></script>
</body>
</html>
