<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Settings | Artisan</title>
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
        <a href="admin-messages.php">Messages</a>
        <a href="admin-users.php">Users</a>
        <a class="active" href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Store Settings</h1>
          <p class="admin-meta">Configure storefront details and defaults</p>
        </div>
        <div class="topbar-right">
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="card" style="margin-bottom:14px;">
        <h2 class="section-title">Store Profile</h2>
        <div class="form-grid">
          <div class="form-field">
            <label>Store Name</label>
            <input type="text" value="Artisan Handcrafted">
          </div>
          <div class="form-field">
            <label>Support Email</label>
            <input type="email" value="support@artisan.ph">
          </div>
          <div class="form-field full">
            <label>Store Description</label>
            <textarea>Preserving heritage through every stitch and weave. Supporting local communities across the Philippines.</textarea>
          </div>
        </div>
      </section>

      <section class="card" style="margin-bottom:14px;">
        <h2 class="section-title">Shipping Defaults</h2>
        <div class="form-grid">
          <div class="form-field">
            <label>Standard Shipping Fee</label>
            <input type="number" value="150">
          </div>
          <div class="form-field">
            <label>Free Shipping Threshold</label>
            <input type="number" value="5000">
          </div>
          <div class="form-field">
            <label>Handling Days</label>
            <input type="text" value="1-2 days">
          </div>
          <div class="form-field">
            <label>Delivery Window</label>
            <input type="text" value="3-5 business days">
          </div>
        </div>
      </section>

      <section class="card">
        <h2 class="section-title">Promo Code Setup</h2>
        <div class="form-grid">
          <div class="form-field">
            <label>Code</label>
            <input type="text" value="ARTISAN10">
          </div>
          <div class="form-field">
            <label>Discount Type</label>
            <select>
              <option>Percentage</option>
              <option>Fixed amount</option>
            </select>
          </div>
          <div class="form-field">
            <label>Value</label>
            <input type="number" value="10">
          </div>
          <div class="form-field">
            <label>Minimum Order</label>
            <input type="number" value="1500">
          </div>
        </div>
        <p class="muted" style="margin-top:10px;">Design-only form. Save action is not connected yet.</p>
        <div style="margin-top:12px;">
          <button class="btn btn-primary">Save Settings</button>
        </div>
      </section>
    </main>
  </div>

  <script src="admin.js?v=6"></script>
</body>
</html>
