<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Products | Artisan</title>
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
        <a class="active" href="admin-products.php">Products</a>
        <a href="admin-orders.php">Orders</a>
        <a href="admin-messages.php">Messages</a>
        <a href="admin-users.php">Users</a>
        <a href="admin-settings.php">Settings</a>
      </nav>
    </aside>

    <main class="admin-main">
      <div class="admin-topbar">
        <div>
          <h1 class="admin-title">Product Management</h1>
          <p class="admin-meta">Catalog controls and inventory overview</p>
        </div>
        <div class="topbar-right">
          <button class="btn btn-primary" id="openAddProductModal">Add New Product</button>
          <button class="btn btn-ghost" type="button" id="adminLogoutBtn">Logout</button>
        </div>
      </div>

      <section class="card">
        <div class="toolbar">
          <div class="left">
            <input type="text" placeholder="Search products">
            <select>
              <option>All Categories</option>
              <option>Handcrafted Bags</option>
              <option>Traditional Fans</option>
              <option>Artisan Bracelets</option>
              <option>Native Sandals</option>
            </select>
          </div>
          <div class="right">
            <button class="btn btn-ghost">Export</button>
            <button class="btn btn-ghost">Bulk Edit</button>
          </div>
        </div>

        <table>
          <thead>
            <tr><th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr>
          </thead>
          <tbody id="productsTableBody">
            <tr><td>Native Handbag</td><td>Handcrafted Bags</td><td>₱1,200</td><td>12</td><td><span class="chip paid">Active</span></td><td>Edit | Delete</td></tr>
            <tr><td>Crimson Weave Fan</td><td>Traditional Fans</td><td>₱450</td><td>7</td><td><span class="chip pending">Low stock</span></td><td>Edit | Delete</td></tr>
            <tr><td>Patterned Bangle</td><td>Artisan Bracelets</td><td>₱250</td><td>5</td><td><span class="chip pending">Low stock</span></td><td>Edit | Delete</td></tr>
            <tr><td>Natural Fiber Slides</td><td>Native Sandals</td><td>₱950</td><td>15</td><td><span class="chip paid">Active</span></td><td>Edit | Delete</td></tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>

  <div class="modal-overlay" id="addProductModal">
    <div class="modal-card">
      <div class="modal-header">
        <h2>Add New Product</h2>
        <button class="btn btn-ghost" type="button" id="closeAddProductModal">Close</button>
      </div>
      <form id="addProductForm">
        <div class="form-grid">
          <div class="form-field">
            <label>Product Name</label>
            <input type="text" id="newProductName" required>
          </div>
          <div class="form-field">
            <label>Category</label>
            <select id="newProductCategory" required>
              <option value="Handcrafted Bags">Handcrafted Bags</option>
              <option value="Traditional Fans">Traditional Fans</option>
              <option value="Artisan Bracelets">Artisan Bracelets</option>
              <option value="Native Sandals">Native Sandals</option>
            </select>
          </div>
          <div class="form-field">
            <label>Price (PHP)</label>
            <input type="number" id="newProductPrice" min="1" required>
          </div>
          <div class="form-field">
            <label>Stock</label>
            <input type="number" id="newProductStock" min="0" required>
          </div>
          <div class="form-field full">
            <label>Product Image</label>
            <input type="file" id="newProductImage" accept="image/*">
            <img id="newProductImagePreview" alt="New product preview" style="display:none; width:72px; height:72px; object-fit:cover; border:1px solid #ece7df; border-radius:8px; margin-top:8px;">
          </div>
        </div>
        <p class="muted" id="addProductFeedback" style="margin-top:10px;"></p>
        <div style="margin-top:12px; display:flex; gap:8px; justify-content:flex-end;">
          <button class="btn btn-ghost" type="button" id="cancelAddProduct">Cancel</button>
          <button class="btn btn-primary" type="submit">Add Product</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay" id="editProductModal">
    <div class="modal-card">
      <div class="modal-header">
        <h2>Edit Product</h2>
        <button class="btn btn-ghost" type="button" id="closeEditProductModal">Close</button>
      </div>
      <form id="editProductForm">
        <input type="hidden" id="editProductId">
        <div class="form-grid">
          <div class="form-field">
            <label>Product Name</label>
            <input type="text" id="editProductName" required>
          </div>
          <div class="form-field">
            <label>Category</label>
            <select id="editProductCategory" required>
              <option value="Handcrafted Bags">Handcrafted Bags</option>
              <option value="Traditional Fans">Traditional Fans</option>
              <option value="Artisan Bracelets">Artisan Bracelets</option>
              <option value="Native Sandals">Native Sandals</option>
            </select>
          </div>
          <div class="form-field">
            <label>Price (PHP)</label>
            <input type="number" id="editProductPrice" min="1" required>
          </div>
          <div class="form-field">
            <label>Stock</label>
            <input type="number" id="editProductStock" min="0" required>
          </div>
          <div class="form-field full">
            <label>Product Image</label>
            <input type="file" id="editProductImage" accept="image/*">
            <img id="editProductImagePreview" alt="Edit product preview" style="display:none; width:72px; height:72px; object-fit:cover; border:1px solid #ece7df; border-radius:8px; margin-top:8px;">
            <input type="hidden" id="editProductImagePath">
          </div>
        </div>
        <p class="muted" id="editProductFeedback" style="margin-top:10px;"></p>
        <div style="margin-top:12px; display:flex; gap:8px; justify-content:flex-end;">
          <button class="btn btn-ghost" type="button" id="cancelEditProduct">Cancel</button>
          <button class="btn btn-primary" type="submit">Save Changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay" id="confirmActionModal">
    <div class="modal-card" style="max-width: 460px;">
      <div class="modal-header">
        <h2>Confirm Action</h2>
      </div>
      <p id="confirmActionMessage" class="muted" style="font-size:0.9rem; margin-bottom:14px;"></p>
      <div style="display:flex; gap:8px; justify-content:flex-end;">
        <button class="btn btn-ghost" type="button" id="confirmActionCancel">Cancel</button>
        <button class="btn btn-primary" type="button" id="confirmActionOk">Yes, continue</button>
      </div>
    </div>
  </div>

  <script src="admin.js?v=6"></script>
</body>
</html>
