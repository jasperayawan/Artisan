<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Users | Artisan</title>
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
        <div class="topbar-right">
          <button class="btn btn-primary" id="openAddUserModal">Add New User</button>
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="card">
        <table>
          <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr>
          </thead>
          <tbody id="usersTableBody">
            <tr><td>System Admin</td><td>admin@artisan.local</td><td><span class="chip shipped">admin</span></td><td>—</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <div class="modal-overlay" id="addUserModal">
    <div class="modal-card">
      <div class="modal-header">
        <h2>Add New User</h2>
        <button class="btn btn-ghost" type="button" id="closeAddUserModal">Close</button>
      </div>
      <form id="addUserForm">
        <div class="form-grid">
          <div class="form-field">
            <label>First Name</label>
            <input type="text" id="newUserFirstName" required>
          </div>
          <div class="form-field">
            <label>Last Name</label>
            <input type="text" id="newUserLastName" required>
          </div>
          <div class="form-field">
            <label>Email</label>
            <input type="email" id="newUserEmail" required>
          </div>
          <div class="form-field">
            <label>Password</label>
            <input type="password" id="newUserPassword" minlength="8" required>
          </div>
          <div class="form-field">
            <label>Role</label>
            <select id="newUserRole" required>
              <option value="customer">customer</option>
              <option value="admin">admin</option>
            </select>
          </div>
        </div>
        <p class="muted" id="addUserFeedback" style="margin-top:10px;"></p>
        <div style="margin-top:12px; display:flex; gap:8px; justify-content:flex-end;">
          <button class="btn btn-ghost" type="button" id="cancelAddUser">Cancel</button>
          <button class="btn btn-primary" type="submit">Add User</button>
        </div>
      </form>
    </div>
  </div>

  <script src="admin.js?v=6"></script>
</body>
</html>
