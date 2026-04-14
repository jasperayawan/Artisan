(() => {
  const authRaw = localStorage.getItem('artisanAuthUser');
  if (!authRaw) return;

  let authUser = null;
  try {
    authUser = JSON.parse(authRaw);
  } catch (e) {
    authUser = null;
  }

  // Requested behavior: only switch header link for admin sessions.
  if (!authUser || String(authUser.role || '').toLowerCase() !== 'admin') return;

  const loginLinks = Array.from(document.querySelectorAll('a.login-link, a[href="login.php"]'));
  loginLinks.forEach((link) => {
    link.setAttribute('href', '#');
    link.setAttribute('aria-label', 'Logout');
    const label = link.querySelector('span');
    if (label) label.textContent = 'Logout';
    link.addEventListener('click', (event) => {
      event.preventDefault();
      localStorage.removeItem('artisanAuthUser');
      window.location.href = 'login.php';
    });
  });
})();
