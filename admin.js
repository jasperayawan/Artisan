document.addEventListener('DOMContentLoaded', () => {
  const authRaw = localStorage.getItem('artisanAuthUser');
  let authUser = null;
  try {
    authUser = authRaw ? JSON.parse(authRaw) : null;
  } catch (err) {
    authUser = null;
  }

  if (!authUser || String(authUser.role || '').toLowerCase() !== 'admin') {
    window.location.href = 'login.php';
    return;
  }

  const adminLogoutBtn = document.getElementById('adminLogoutBtn');
  if (adminLogoutBtn) {
    adminLogoutBtn.addEventListener('click', () => {
      localStorage.removeItem('artisanAuthUser');
      window.location.href = 'login.php';
    });
  }

  const dateNode = document.getElementById('todayDate');
  if (dateNode) {
    const now = new Date();
    dateNode.textContent = now.toLocaleDateString('en-PH', {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    });
  }

  const API_PRODUCTS = 'api/products.php';
  const API_ORDERS = 'api/orders.php';
  const API_CUSTOMERS = 'api/customers.php';
  const API_USERS = 'api/users.php';
  const API_UPLOAD_PRODUCT_IMAGE = 'api/upload-product-image.php';
  const API_SALES_TREND = 'api/sales-trend.php';
  const API_CONTACT_MESSAGES = 'api/contact-messages.php';
  const paginationState = {};

  const modal = document.getElementById('addProductModal');
  const openBtn = document.getElementById('openAddProductModal');
  const closeBtn = document.getElementById('closeAddProductModal');
  const cancelBtn = document.getElementById('cancelAddProduct');
  const form = document.getElementById('addProductForm');
  const tableBody = document.getElementById('productsTableBody');
  const ordersTableBody = document.getElementById('ordersTableBody');
  const customersTableBody = document.getElementById('customersTableBody');
  const dashboardRevenue = document.getElementById('dashboardRevenue');
  const dashboardOrders = document.getElementById('dashboardOrders');
  const dashboardAov = document.getElementById('dashboardAov');
  const dashboardCustomers = document.getElementById('dashboardCustomers');
  const dashboardLowStockBody = document.getElementById('dashboardLowStockBody');
  const dashboardRecentOrdersBody = document.getElementById('dashboardRecentOrdersBody');
  const dashboardSalesTrend = document.getElementById('dashboardSalesTrend');
  const dashboardContactMessagesBody = document.getElementById('dashboardContactMessagesBody');
  const dashboardNewMessages = document.getElementById('dashboardNewMessages');
  const messagesTableBody = document.getElementById('messagesTableBody');
  const messagesSearch = document.getElementById('messagesSearch');
  const usersTableBody = document.getElementById('usersTableBody');
  const addUserModal = document.getElementById('addUserModal');
  const openAddUserModal = document.getElementById('openAddUserModal');
  const closeAddUserModal = document.getElementById('closeAddUserModal');
  const cancelAddUser = document.getElementById('cancelAddUser');
  const addUserForm = document.getElementById('addUserForm');
  const addUserFeedback = document.getElementById('addUserFeedback');
  const addProductFeedback = document.getElementById('addProductFeedback');
  const newProductImage = document.getElementById('newProductImage');
  const newProductImagePreview = document.getElementById('newProductImagePreview');
  const editProductModal = document.getElementById('editProductModal');
  const editProductForm = document.getElementById('editProductForm');
  const closeEditProductModal = document.getElementById('closeEditProductModal');
  const cancelEditProduct = document.getElementById('cancelEditProduct');
  const editProductFeedback = document.getElementById('editProductFeedback');
  const editProductImage = document.getElementById('editProductImage');
  const editProductImagePreview = document.getElementById('editProductImagePreview');
  const editProductImagePath = document.getElementById('editProductImagePath');
  const confirmActionModal = document.getElementById('confirmActionModal');
  const confirmActionMessage = document.getElementById('confirmActionMessage');
  const confirmActionCancel = document.getElementById('confirmActionCancel');
  const confirmActionOk = document.getElementById('confirmActionOk');
  let pendingConfirmAction = null;
  let productsCache = [];
  let contactMessagesCache = [];

  const ensurePaginationContainer = (tableBody) => {
    if (!tableBody) return null;
    const table = tableBody.closest('table');
    if (!table || !table.parentElement) return null;
    const parent = table.parentElement;
    let container = parent.querySelector(`.table-pagination[data-for="${tableBody.id}"]`);
    if (!container) {
      container = document.createElement('div');
      container.className = 'table-pagination';
      container.setAttribute('data-for', tableBody.id || '');
      table.insertAdjacentElement('afterend', container);
    }
    return container;
  };

  const renderPagination = (tableBody, pageKey, rows, pageSize = 6) => {
    if (!tableBody) return;
    const totalRows = rows.length;
    const totalPages = Math.max(1, Math.ceil(totalRows / pageSize));
    if (!paginationState[pageKey]) paginationState[pageKey] = { page: 1 };
    const currentPage = Math.min(totalPages, Math.max(1, Number(paginationState[pageKey].page || 1)));
    paginationState[pageKey].page = currentPage;

    const start = (currentPage - 1) * pageSize;
    const end = start + pageSize;
    tableBody.innerHTML = rows.slice(start, end).join('');

    const container = ensurePaginationContainer(tableBody);
    if (!container) return;

    if (totalRows <= pageSize) {
      container.innerHTML = '';
      return;
    }

    container.innerHTML = `
      <button class="btn btn-ghost pagination-btn" type="button" data-key="${pageKey}" data-dir="prev" ${currentPage <= 1 ? 'disabled' : ''}>Prev</button>
      <span class="pagination-meta">Page ${currentPage} of ${totalPages}</span>
      <button class="btn btn-ghost pagination-btn" type="button" data-key="${pageKey}" data-dir="next" ${currentPage >= totalPages ? 'disabled' : ''}>Next</button>
    `;
  };

  const bindPaginationEvents = () => {
    document.addEventListener('click', (event) => {
      const target = event.target.closest('.pagination-btn');
      if (!target) return;
      const pageKey = target.getAttribute('data-key') || '';
      const dir = target.getAttribute('data-dir') || '';
      const state = paginationState[pageKey];
      if (!state) return;
      state.page = dir === 'next' ? Number(state.page || 1) + 1 : Number(state.page || 1) - 1;
      if (typeof state.render === 'function') state.render();
    });
  };

  const setupPaginatedTable = (pageKey, tableBody, rows, pageSize = 6) => {
    paginationState[pageKey] = paginationState[pageKey] || { page: 1 };
    paginationState[pageKey].rows = rows;
    paginationState[pageKey].pageSize = pageSize;
    paginationState[pageKey].tableBody = tableBody;
    paginationState[pageKey].render = () => {
      const state = paginationState[pageKey];
      renderPagination(state.tableBody, pageKey, state.rows || [], state.pageSize || pageSize);
    };
    paginationState[pageKey].render();
  };

  const initFallbackPagination = () => {
    const specs = [
      { key: 'products', body: tableBody, size: 6 },
      { key: 'orders', body: ordersTableBody, size: 6 },
      { key: 'customers', body: customersTableBody, size: 6 },
      { key: 'users', body: usersTableBody, size: 6 },
      { key: 'dashboardLowStock', body: dashboardLowStockBody, size: 4 },
      { key: 'dashboardRecentOrders', body: dashboardRecentOrdersBody, size: 4 }
    ];
    specs.forEach(({ key, body, size }) => {
      if (!body) return;
      const staticRows = Array.from(body.querySelectorAll('tr')).map((row) => row.outerHTML);
      if (!staticRows.length) return;
      setupPaginatedTable(key, body, staticRows, size);
    });
  };

  const statusForStock = (stock) => ({
    className: Number(stock) <= 7 ? 'pending' : 'paid',
    label: Number(stock) <= 7 ? 'Low stock' : 'Active'
  });

  const renderRow = (item) => {
    const status = statusForStock(item.stock);
    const safeImg = item.image_path || '';
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${safeImg ? `<img src="${safeImg}" alt="${item.name}" style="width:44px; height:44px; object-fit:cover; border-radius:8px; border:1px solid #ece7df;">` : '—'}</td>
      <td>${item.name}</td>
      <td>${item.category}</td>
      <td>₱${Number(item.price).toLocaleString('en-PH')}</td>
      <td>${item.stock}</td>
      <td><span class="chip ${status.className}">${status.label}</span></td>
      <td>
        <button class="btn btn-ghost product-edit-btn" data-id="${Number(item.id || 0)}" type="button">Edit</button>
        <button class="btn btn-ghost product-delete-btn" data-id="${Number(item.id || 0)}" data-name="${item.name}" type="button">Delete</button>
      </td>
    `;
    return row;
  };

  const loadProducts = async () => {
    if (!tableBody) return;
    try {
      const response = await fetch(API_PRODUCTS);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;
      productsCache = payload.data;
      const rows = payload.data.map((item) => renderRow(item).outerHTML);
      setupPaginatedTable('products', tableBody, rows, 6);
    } catch (err) {
      // Keep current static rows as graceful fallback.
    }
  };

  const statusClassForOrder = (status) => {
    const normalized = String(status || '').toLowerCase();
    if (normalized === 'paid') return 'paid';
    if (normalized === 'shipped') return 'shipped';
    if (normalized === 'delivered') return 'delivered';
    return 'pending';
  };

  const formatPeso = (value) => `₱${Number(value || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
  const escapeHtml = (value) => String(value || '')
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;')
    .replaceAll("'", '&#039;');

  const truncateText = (value, maxLen) => {
    const t = String(value || '').replace(/\s+/g, ' ').trim();
    if (t.length <= maxLen) return t;
    return `${t.slice(0, maxLen)}…`;
  };

  const statusClassForContact = (status) => {
    const s = String(status || '').toLowerCase();
    if (s === 'read') return 'paid';
    if (s === 'resolved') return 'delivered';
    return 'pending';
  };

  const formatContactStatusLabel = (status) => {
    const s = String(status || 'new');
    return s.charAt(0).toUpperCase() + s.slice(1);
  };

  const loadOrders = async () => {
    if (!ordersTableBody) return;
    try {
      const response = await fetch(API_ORDERS);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;
      const rows = payload.data.map((item) => {
        const date = new Date(item.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' });
        const customerName = item.customer_name || item.customer_email || 'Guest Customer';
        const currentStatus = String(item.status || 'Pending');
        return `
          <td>#${item.order_code}</td>
          <td>${customerName}</td>
          <td>${Number(item.item_count || 0)}</td>
          <td>${formatPeso(item.total)}</td>
          <td><span class="chip ${statusClassForOrder(item.status)}">${item.status}</span></td>
          <td>${date}</td>
          <td>
            <select class="order-status-select" data-id="${Number(item.id || 0)}">
              <option value="Pending" ${currentStatus === 'Pending' ? 'selected' : ''}>Pending</option>
              <option value="Paid" ${currentStatus === 'Paid' ? 'selected' : ''}>Paid</option>
              <option value="Shipped" ${currentStatus === 'Shipped' ? 'selected' : ''}>Shipped</option>
              <option value="Delivered" ${currentStatus === 'Delivered' ? 'selected' : ''}>Delivered</option>
              <option value="Cancelled" ${currentStatus === 'Cancelled' ? 'selected' : ''}>Cancelled</option>
            </select>
            <button class="btn btn-ghost order-status-update-btn" data-id="${Number(item.id || 0)}" type="button">Update</button>
          </td>
        `;
      }).map((cells) => `<tr>${cells}</tr>`);
      setupPaginatedTable('orders', ordersTableBody, rows, 6);
    } catch (err) {
      // Keep static rows as fallback.
    }
  };

  const updateOrderStatus = async (orderId, status) => {
    const response = await fetch(API_ORDERS, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: orderId,
        status
      })
    });
    const payload = await response.json();
    if (!response.ok || !payload.ok) {
      throw new Error(payload.message || 'Failed to update order status.');
    }
  };

  const loadCustomers = async () => {
    if (!customersTableBody) return;
    try {
      const response = await fetch(API_CUSTOMERS);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;
      const rows = payload.data.map((item) => {
        const date = item.last_order
          ? new Date(item.last_order).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' })
          : 'N/A';
        return `
          <td>${item.name || 'Guest Customer'}</td>
          <td>${item.email || 'N/A'}</td>
          <td>${Number(item.total_orders || 0)}</td>
          <td>${formatPeso(item.total_spent)}</td>
          <td>${date}</td>
        `;
      }).map((cells) => `<tr>${cells}</tr>`);
      setupPaginatedTable('customers', customersTableBody, rows, 6);
    } catch (err) {
      // Keep static rows as fallback.
    }
  };

  const roleChipClass = (role) => String(role).toLowerCase() === 'admin' ? 'shipped' : 'paid';

  const renderUserRow = (user) => {
    const row = document.createElement('tr');
    const fullName = `${user.first_name || ''} ${user.last_name || ''}`.trim() || 'N/A';
    const created = user.created_at
      ? new Date(user.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' })
      : 'N/A';
    row.innerHTML = `
      <td>${fullName}</td>
      <td>${user.email || 'N/A'}</td>
      <td><span class="chip ${roleChipClass(user.role)}">${user.role || 'customer'}</span></td>
      <td>${created}</td>
    `;
    return row;
  };

  const loadUsers = async () => {
    if (!usersTableBody) return;
    try {
      const response = await fetch(API_USERS);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;
      const rows = payload.data.map((user) => renderUserRow(user).outerHTML);
      setupPaginatedTable('users', usersTableBody, rows, 6);
    } catch (err) {
      // Keep static rows as fallback.
    }
  };

  const loadDashboardStats = async () => {
    if (!dashboardRevenue && !dashboardOrders && !dashboardAov && !dashboardCustomers) return;
    try {
      const [ordersRes, customersRes] = await Promise.all([
        fetch(API_ORDERS),
        fetch(API_CUSTOMERS)
      ]);
      if (!ordersRes.ok || !customersRes.ok) return;
      const [ordersPayload, customersPayload] = await Promise.all([
        ordersRes.json(),
        customersRes.json()
      ]);
      if (!ordersPayload.ok || !Array.isArray(ordersPayload.data)) return;
      if (!customersPayload.ok || !Array.isArray(customersPayload.data)) return;

      const orders = ordersPayload.data;
      const revenue = orders.reduce((sum, item) => sum + Number(item.total || 0), 0);
      const orderCount = orders.length;
      const aov = orderCount > 0 ? revenue / orderCount : 0;
      const customerCount = customersPayload.data.length;

      if (dashboardRevenue) dashboardRevenue.textContent = formatPeso(revenue);
      if (dashboardOrders) dashboardOrders.textContent = String(orderCount);
      if (dashboardAov) dashboardAov.textContent = formatPeso(aov);
      if (dashboardCustomers) dashboardCustomers.textContent = String(customerCount);
    } catch (err) {
      // Keep static defaults when APIs are unavailable.
    }
  };

  const loadDashboardContactMessages = async () => {
    if (!dashboardContactMessagesBody && !dashboardNewMessages) return;
    try {
      const response = await fetch(`${API_CONTACT_MESSAGES}?limit=100`);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;

      const all = payload.data;
      const newCount = all.filter((m) => String(m.status || '').toLowerCase() === 'new').length;
      if (dashboardNewMessages) dashboardNewMessages.textContent = String(newCount);

      if (!dashboardContactMessagesBody) return;
      const recent = all.slice(0, 5);
      if (!recent.length) {
        dashboardContactMessagesBody.innerHTML = '<tr><td colspan="6" style="color:#7a746f;">No messages yet.</td></tr>';
        return;
      }
      dashboardContactMessagesBody.innerHTML = recent.map((item) => {
        const date = new Date(item.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' });
        const subj = item.subject ? escapeHtml(item.subject) : '—';
        return `<tr>
          <td>${escapeHtml(item.name)}</td>
          <td>${escapeHtml(item.email)}</td>
          <td>${subj}</td>
          <td>${escapeHtml(truncateText(item.message, 72))}</td>
          <td><span class="chip ${statusClassForContact(item.status)}">${escapeHtml(formatContactStatusLabel(item.status))}</span></td>
          <td>${date}</td>
        </tr>`;
      }).join('');
    } catch (err) {
      if (dashboardContactMessagesBody) {
        dashboardContactMessagesBody.innerHTML = '<tr><td colspan="6" style="color:#c0392b;">Unable to load messages.</td></tr>';
      }
    }
  };

  const renderContactMessageRows = (items) => items.map((item) => {
    const date = new Date(item.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' });
    const subj = item.subject ? escapeHtml(item.subject) : '—';
    return `<tr>
      <td>${escapeHtml(item.name)}</td>
      <td>${escapeHtml(item.email)}</td>
      <td>${subj}</td>
      <td style="max-width:340px;white-space:normal;">${escapeHtml(truncateText(item.message, 220))}</td>
      <td><span class="chip ${statusClassForContact(item.status)}">${escapeHtml(formatContactStatusLabel(item.status))}</span></td>
      <td>${date}</td>
    </tr>`;
  });

  const applyContactMessagesFilter = () => {
    if (!messagesTableBody) return;
    const q = (messagesSearch?.value || '').trim().toLowerCase();
    let items = contactMessagesCache;
    if (q) {
      items = items.filter((item) => {
        const name = String(item.name || '').toLowerCase();
        const email = String(item.email || '').toLowerCase();
        const subj = String(item.subject || '').toLowerCase();
        const msg = String(item.message || '').toLowerCase();
        return name.includes(q) || email.includes(q) || subj.includes(q) || msg.includes(q);
      });
    }
    const rows = renderContactMessageRows(items);
    if (!rows.length) {
      messagesTableBody.innerHTML = '<tr><td colspan="6" style="color:#7a746f;">No messages match your search.</td></tr>';
      return;
    }
    setupPaginatedTable('contactMessages', messagesTableBody, rows, 8);
  };

  const loadContactMessages = async () => {
    if (!messagesTableBody) return;
    try {
      const response = await fetch(`${API_CONTACT_MESSAGES}?limit=300`);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;
      contactMessagesCache = payload.data;
      applyContactMessagesFilter();
    } catch (err) {
      messagesTableBody.innerHTML = '<tr><td colspan="6" style="color:#c0392b;">Unable to load messages.</td></tr>';
    }
  };

  if (messagesSearch) {
    messagesSearch.addEventListener('input', () => {
      if (paginationState.contactMessages) paginationState.contactMessages.page = 1;
      applyContactMessagesFilter();
    });
  }

  const loadDashboardSalesTrend = async () => {
    if (!dashboardSalesTrend) return;
    try {
      const response = await fetch(API_SALES_TREND);
      if (!response.ok) return;
      const payload = await response.json();
      if (!payload.ok || !Array.isArray(payload.data)) return;

      const items = payload.data.filter((row) => Number(row.units_sold || 0) > 0);
      if (!items.length) {
        dashboardSalesTrend.innerHTML = '<p class="sales-trend-empty">No product sales yet.</p>';
        return;
      }

      const maxUnits = Math.max(...items.map((item) => Number(item.units_sold || 0)), 1);
      dashboardSalesTrend.innerHTML = items.map((item) => {
        const units = Number(item.units_sold || 0);
        const width = Math.max(8, Math.round((units / maxUnits) * 100));
        return `
          <div class="sales-bar-row">
            <div class="sales-bar-head">
              <span class="sales-bar-name">${escapeHtml(item.product_name)}</span>
              <span class="sales-bar-meta">${units} sold • ${formatPeso(item.revenue || 0)}</span>
            </div>
            <div class="sales-bar-track">
              <div class="sales-bar-fill" style="width:${width}%"></div>
            </div>
          </div>
        `;
      }).join('');
    } catch (err) {
      dashboardSalesTrend.innerHTML = '<p class="sales-trend-empty">Unable to load sales trend right now.</p>';
    }
  };

  const loadDashboardTables = async () => {
    if (!dashboardLowStockBody && !dashboardRecentOrdersBody) return;
    try {
      const [productsRes, ordersRes] = await Promise.all([
        fetch(API_PRODUCTS),
        fetch(API_ORDERS)
      ]);
      if (!productsRes.ok || !ordersRes.ok) return;
      const [productsPayload, ordersPayload] = await Promise.all([
        productsRes.json(),
        ordersRes.json()
      ]);
      if (!productsPayload.ok || !Array.isArray(productsPayload.data) || !ordersPayload.ok || !Array.isArray(ordersPayload.data)) {
        return;
      }

      if (dashboardLowStockBody) {
        const lowStock = productsPayload.data
          .filter((item) => Number(item.stock || 0) <= 7)
          .sort((a, b) => Number(a.stock || 0) - Number(b.stock || 0))
          .slice(0, 5);
        if (lowStock.length) {
          const rows = lowStock.map((item) => (
            `<tr><td>${item.name}</td><td>${Number(item.stock || 0)} left</td></tr>`
          ));
          setupPaginatedTable('dashboardLowStock', dashboardLowStockBody, rows, 4);
        }
      }

      if (dashboardRecentOrdersBody) {
        const recent = ordersPayload.data.slice(0, 5);
        if (recent.length) {
          const rows = recent.map((item) => {
            const date = new Date(item.created_at).toLocaleDateString('en-PH', { year: 'numeric', month: 'short', day: 'numeric' });
            const customerName = item.customer_name || item.customer_email || 'Guest Customer';
            return `<tr>
              <td>#${item.order_code}</td>
              <td>${customerName}</td>
              <td>${formatPeso(item.total)}</td>
              <td><span class="chip ${statusClassForOrder(item.status)}">${item.status}</span></td>
              <td>${date}</td>
            </tr>`;
          });
          setupPaginatedTable('dashboardRecentOrders', dashboardRecentOrdersBody, rows, 4);
        }
      }
    } catch (err) {
      // Keep static fallback tables.
    }
  };

  const openConfirmModal = (message, action) => {
    if (!confirmActionModal || !confirmActionMessage || !confirmActionOk) return;
    pendingConfirmAction = action;
    confirmActionMessage.textContent = message;
    confirmActionModal.classList.add('open');
  };

  const uploadProductImage = async (file) => {
    if (!file) return null;
    const formData = new FormData();
    formData.append('image', file);
    const res = await fetch(API_UPLOAD_PRODUCT_IMAGE, {
      method: 'POST',
      body: formData
    });
    const payload = await res.json();
    if (!res.ok || !payload.ok || !payload.data?.image_path) {
      throw new Error(payload.message || 'Failed to upload image.');
    }
    return payload.data.image_path;
  };

  const bindImagePreview = (inputEl, previewEl) => {
    if (!inputEl || !previewEl) return;
    inputEl.addEventListener('change', () => {
      const file = inputEl.files && inputEl.files[0];
      if (!file) {
        previewEl.style.display = 'none';
        previewEl.removeAttribute('src');
        return;
      }
      const objectUrl = URL.createObjectURL(file);
      previewEl.src = objectUrl;
      previewEl.style.display = 'block';
    });
  };

  bindImagePreview(newProductImage, newProductImagePreview);
  bindImagePreview(editProductImage, editProductImagePreview);

  const closeConfirmModal = () => {
    if (!confirmActionModal) return;
    confirmActionModal.classList.remove('open');
    pendingConfirmAction = null;
  };

  if (confirmActionCancel) confirmActionCancel.addEventListener('click', closeConfirmModal);
  if (confirmActionModal) {
    confirmActionModal.addEventListener('click', (e) => {
      if (e.target === confirmActionModal) closeConfirmModal();
    });
  }
  if (confirmActionOk) {
    confirmActionOk.addEventListener('click', async () => {
      if (typeof pendingConfirmAction === 'function') {
        const fn = pendingConfirmAction;
        closeConfirmModal();
        await fn();
      }
    });
  }

  if (modal && openBtn && form && tableBody) {
    const closeModal = () => modal.classList.remove('open');
    const openModal = () => modal.classList.add('open');

    openBtn.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const nameInput = document.getElementById('newProductName');
      const categoryInput = document.getElementById('newProductCategory');
      const priceInput = document.getElementById('newProductPrice');
      const stockInput = document.getElementById('newProductStock');

      const name = (nameInput?.value || '').trim();
      const category = categoryInput?.value || 'Handcrafted Bags';
      const price = Number(priceInput?.value || 0);
      const stock = Number(stockInput?.value || 0);

      if (!name || price <= 0 || stock < 0) return;

      const payload = {
        name,
        category,
        price,
        stock,
        image_path: ''
      };
      openConfirmModal('Are you sure you want to save this new product?', async () => {
        if (addProductFeedback) {
          addProductFeedback.textContent = 'Saving product...';
          addProductFeedback.style.color = '#666';
        }
        try {
          const selectedImage = newProductImage && newProductImage.files ? newProductImage.files[0] : null;
          if (selectedImage) {
            payload.image_path = await uploadProductImage(selectedImage);
          }
          const res = await fetch(API_PRODUCTS, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
          });
          const data = await res.json();

          if (!res.ok || !data.ok || !data.data) {
            throw new Error(data.message || 'API create failed');
          }

          productsCache.unshift(data.data);
          await loadProducts();
          form.reset();
          if (newProductImagePreview) {
            newProductImagePreview.style.display = 'none';
            newProductImagePreview.removeAttribute('src');
          }
          closeModal();
          if (addProductFeedback) addProductFeedback.textContent = '';
        } catch (err) {
          if (addProductFeedback) {
            addProductFeedback.textContent = err.message || 'Unable to save product.';
            addProductFeedback.style.color = '#c0392b';
          }
        }
      });
    });
  }

  const closeEditModal = () => {
    if (!editProductModal) return;
    editProductModal.classList.remove('open');
    if (editProductFeedback) editProductFeedback.textContent = '';
  };

  if (closeEditProductModal) closeEditProductModal.addEventListener('click', closeEditModal);
  if (cancelEditProduct) cancelEditProduct.addEventListener('click', closeEditModal);
  if (editProductModal) {
    editProductModal.addEventListener('click', (e) => {
      if (e.target === editProductModal) closeEditModal();
    });
  }

  if (tableBody) {
    tableBody.addEventListener('click', (event) => {
      const target = event.target.closest('button');
      if (!target) return;

      if (target.classList.contains('product-edit-btn')) {
        const id = Number(target.getAttribute('data-id') || 0);
        const product = productsCache.find((item) => Number(item.id) === id);
        if (!product || !editProductModal) return;
        document.getElementById('editProductId').value = String(product.id);
        document.getElementById('editProductName').value = product.name || '';
        document.getElementById('editProductCategory').value = product.category || 'Handcrafted Bags';
        document.getElementById('editProductPrice').value = String(Number(product.price || 0));
        document.getElementById('editProductStock').value = String(Number(product.stock || 0));
        if (editProductImagePath) editProductImagePath.value = product.image_path || '';
        if (editProductImagePreview) {
          if (product.image_path) {
            editProductImagePreview.src = product.image_path;
            editProductImagePreview.style.display = 'block';
          } else {
            editProductImagePreview.style.display = 'none';
            editProductImagePreview.removeAttribute('src');
          }
        }
        if (editProductImage) editProductImage.value = '';
        editProductModal.classList.add('open');
      }

      if (target.classList.contains('product-delete-btn')) {
        const id = Number(target.getAttribute('data-id') || 0);
        const name = target.getAttribute('data-name') || 'this product';
        if (id <= 0) return;
        openConfirmModal(`Are you sure you want to delete "${name}"?`, async () => {
          try {
            const res = await fetch(`${API_PRODUCTS}?id=${id}`, { method: 'DELETE' });
            const payload = await res.json();
            if (!res.ok || !payload.ok) {
              throw new Error(payload.message || 'Failed to delete product.');
            }
            productsCache = productsCache.filter((item) => Number(item.id) !== id);
            await loadProducts();
          } catch (err) {
            alert(err.message || 'Unable to delete product.');
          }
        });
      }
    });
  }

  if (ordersTableBody) {
    ordersTableBody.addEventListener('click', async (event) => {
      const target = event.target.closest('button.order-status-update-btn');
      if (!target) return;

      const orderId = Number(target.getAttribute('data-id') || 0);
      const select = ordersTableBody.querySelector(`select.order-status-select[data-id="${orderId}"]`);
      const nextStatus = select ? String(select.value || '').trim() : '';
      if (orderId <= 0 || !nextStatus) return;

      const previousText = target.textContent;
      target.disabled = true;
      target.textContent = 'Saving...';

      try {
        await updateOrderStatus(orderId, nextStatus);
        await loadOrders();
      } catch (err) {
        alert(err.message || 'Unable to update order status.');
      } finally {
        target.disabled = false;
        target.textContent = previousText;
      }
    });
  }

  if (editProductForm) {
    editProductForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const payload = {
        id: Number(document.getElementById('editProductId').value || 0),
        name: document.getElementById('editProductName').value.trim(),
        category: document.getElementById('editProductCategory').value,
        price: Number(document.getElementById('editProductPrice').value || 0),
        stock: Number(document.getElementById('editProductStock').value || 0),
        image_path: editProductImagePath ? editProductImagePath.value : ''
      };
      if (!payload.id || !payload.name || payload.price <= 0 || payload.stock < 0) return;

      openConfirmModal('Are you sure you want to save these product changes?', async () => {
        if (editProductFeedback) {
          editProductFeedback.textContent = 'Saving changes...';
          editProductFeedback.style.color = '#666';
        }
        try {
          const selectedImage = editProductImage && editProductImage.files ? editProductImage.files[0] : null;
          if (selectedImage) {
            payload.image_path = await uploadProductImage(selectedImage);
          }
          const res = await fetch(API_PRODUCTS, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });
          const data = await res.json();
          if (!res.ok || !data.ok || !data.data) {
            throw new Error(data.message || 'Failed to update product.');
          }
          const idx = productsCache.findIndex((item) => Number(item.id) === Number(data.data.id));
          if (idx >= 0) productsCache[idx] = data.data;
          closeEditModal();
          await loadProducts();
        } catch (err) {
          if (editProductFeedback) {
            editProductFeedback.textContent = err.message || 'Unable to save changes.';
            editProductFeedback.style.color = '#c0392b';
          }
        }
      });
    });
  }

  if (addUserModal && openAddUserModal && addUserForm && usersTableBody) {
    const closeModal = () => {
      addUserModal.classList.remove('open');
      if (addUserFeedback) addUserFeedback.textContent = '';
    };
    const openModal = () => addUserModal.classList.add('open');
    openAddUserModal.addEventListener('click', openModal);
    if (closeAddUserModal) closeAddUserModal.addEventListener('click', closeModal);
    if (cancelAddUser) cancelAddUser.addEventListener('click', closeModal);
    addUserModal.addEventListener('click', (e) => {
      if (e.target === addUserModal) closeModal();
    });

    addUserForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const firstName = document.getElementById('newUserFirstName')?.value.trim() || '';
      const lastName = document.getElementById('newUserLastName')?.value.trim() || '';
      const email = document.getElementById('newUserEmail')?.value.trim() || '';
      const password = document.getElementById('newUserPassword')?.value || '';
      const role = document.getElementById('newUserRole')?.value || 'customer';

      if (addUserFeedback) {
        addUserFeedback.textContent = 'Creating user...';
        addUserFeedback.style.color = '#666';
      }

      try {
        const response = await fetch(API_USERS, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            first_name: firstName,
            last_name: lastName,
            email,
            password,
            role
          })
        });
        const payload = await response.json();
        if (!response.ok || !payload.ok || !payload.data) {
          throw new Error(payload.message || 'Failed to create user.');
        }

        await loadUsers();
        addUserForm.reset();
        closeModal();
      } catch (err) {
        if (addUserFeedback) {
          addUserFeedback.textContent = err.message || 'Unable to create user right now.';
          addUserFeedback.style.color = '#c0392b';
        }
      }
    });
  }

  loadProducts();
  loadOrders();
  loadCustomers();
  loadUsers();
  loadDashboardStats();
  loadDashboardSalesTrend();
  loadDashboardContactMessages();
  loadDashboardTables();
  loadContactMessages();
  bindPaginationEvents();
  initFallbackPagination();
});
