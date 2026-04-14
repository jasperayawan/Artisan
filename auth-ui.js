(() => {
  const authRaw = localStorage.getItem('artisanAuthUser');
  if (!authRaw) return;

  let authUser = null;
  try {
    authUser = JSON.parse(authRaw);
  } catch (e) {
    authUser = null;
  }

  if (!authUser) return;

  const role = String(authUser.role || '').toLowerCase();
  const isAdmin = role === 'admin';
  const isCustomer = role === 'customer' || role === '';

  const loginLinks = Array.from(document.querySelectorAll('a.login-link, a[href="login.php"]'));
  loginLinks.forEach((link) => {
    // Admin: treat header user link as logout (admin uses admin panel button too).
    // Customer: turn it into "My Account" and add a dedicated Logout link next to it.
    if (isAdmin) {
      link.setAttribute('href', '#');
      link.setAttribute('aria-label', 'Logout');
      const label = link.querySelector('span');
      if (label) label.textContent = 'Logout';
      link.addEventListener('click', (event) => {
        event.preventDefault();
        localStorage.removeItem('artisanAuthUser');
        window.location.href = 'login.php';
      });
      return;
    }

    if (!isCustomer) return;

    link.setAttribute('href', 'customer-dashboard.php');
    link.setAttribute('aria-label', 'My Account');
    const label = link.querySelector('span');
    if (label) label.textContent = 'My Account';

    const parent = link.parentElement;
    if (!parent) return;
    if (parent.querySelector('[data-artisan-logout="true"]')) return;

    const logoutLink = document.createElement('a');
    logoutLink.setAttribute('href', '#');
    logoutLink.setAttribute('data-artisan-logout', 'true');
    logoutLink.setAttribute('aria-label', 'Logout');
    logoutLink.style.textDecoration = 'none';
    logoutLink.style.color = 'inherit';
    logoutLink.style.display = 'flex';
    logoutLink.style.alignItems = 'center';
    logoutLink.style.gap = '5px';

    // Prefer icon if lucide is used on the page; keep text fallback.
    logoutLink.innerHTML = '<i data-lucide="log-out"></i><span>Logout</span>';
    logoutLink.addEventListener('click', (event) => {
      event.preventDefault();
      localStorage.removeItem('artisanAuthUser');
      window.location.href = 'index.php';
    });

    parent.appendChild(logoutLink);
  });

  // If lucide is present on the page, refresh icons for injected nodes.
  if (window.lucide && typeof window.lucide.createIcons === 'function') {
    window.lucide.createIcons();
  }
})();
