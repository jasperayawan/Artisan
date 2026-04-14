// ===== CART STATE =====
let cartItems = [];
const CART_STORAGE_KEY = 'artisanCart';
const WISHLIST_STORAGE_KEY = 'artisanWishlist';
let wishlistMemoryFallback = [];

function getWishlistItems() {
    try {
        const saved = localStorage.getItem(WISHLIST_STORAGE_KEY);
        return saved ? JSON.parse(saved) : [];
    } catch (e) {
        return [...wishlistMemoryFallback];
    }
}

function setWishlistItems(items) {
    try {
        localStorage.setItem(WISHLIST_STORAGE_KEY, JSON.stringify(items));
    } catch (e) {
        // Fallback for environments where storage is blocked.
        wishlistMemoryFallback = [...items];
    }
}

function isInWishlist(name) {
    return getWishlistItems().some(item => item.name === name);
}

function toggleWishlist(name, price, imgSrc) {
    const items = getWishlistItems();
    const index = items.findIndex(item => item.name === name);
    let added = false;

    if (index >= 0) {
        items.splice(index, 1);
    } else {
        items.push({ name, price, img: imgSrc });
        added = true;
    }

    setWishlistItems(items);
    return added;
}

function getTotal() {
    return cartItems.reduce((sum, item) => sum + item.price * item.qty, 0);
}

function loadCartItems() {
    try {
        const saved = localStorage.getItem(CART_STORAGE_KEY);
        if (!saved) return [];
        const parsed = JSON.parse(saved);
        if (!Array.isArray(parsed)) return [];
        return parsed
            .map(item => ({
                name: String(item.name || '').trim(),
                price: Number(item.price || 0),
                img: String(item.img || '').trim(),
                qty: Math.max(1, Number(item.qty || 1))
            }))
            .filter(item => item.name && item.price > 0);
    } catch (e) {
        return [];
    }
}

function saveCartItems() {
    try {
        localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cartItems));
    } catch (e) {
        // Ignore write errors when storage is unavailable.
    }
}

function getCartItems() {
    return cartItems.map(item => ({ ...item }));
}

function setCartItems(nextItems) {
    if (!Array.isArray(nextItems)) return;
    cartItems = nextItems
        .map(item => ({
            name: String(item.name || '').trim(),
            price: Number(item.price || 0),
            img: String(item.img || '').trim(),
            qty: Math.max(1, Number(item.qty || 1))
        }))
        .filter(item => item.name && item.price > 0);
    updateCartUI();
}

function formatPrice(amount) {
    return '₱' + amount.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function updateCartUI() {
    // Update count badges
    const count = cartItems.reduce((sum, item) => sum + item.qty, 0);
    document.querySelectorAll('.cart-count').forEach(el => { el.textContent = count; });

    const body = document.querySelector('.cart-sidebar-body');
    const totalEl = document.querySelector('.cart-total span:last-child');
    if (!body) return;

    if (cartItems.length === 0) {
        body.innerHTML = `
            <div class="cart-empty">
                <i data-lucide="shopping-bag"></i>
                <p>Your cart is empty</p>
            </div>`;
        if (totalEl) totalEl.textContent = '₱0.00';
    } else {
        body.innerHTML = cartItems.map((item, i) => `
            <div class="cart-item">
                <img src="${item.img}" alt="${item.name}">
                <div class="cart-item-info">
                    <p>${item.name}</p>
                    <div class="cart-item-qty">Qty: ${item.qty}</div>
                    <span>${formatPrice(item.price * item.qty)}</span>
                </div>
                <button class="cart-item-remove" onclick="removeCartItem(${i})" aria-label="Remove">
                    <i data-lucide="x"></i>
                </button>
            </div>`).join('');
        if (totalEl) totalEl.textContent = formatPrice(getTotal());
    }
    saveCartItems();
    lucide.createIcons();
}

function addToCart(name, price, imgSrc) {
    const existing = cartItems.find(i => i.name === name);
    if (existing) {
        existing.qty++;
    } else {
        cartItems.push({ name, price, img: imgSrc, qty: 1 });
    }
    updateCartUI();
    openCart();
}

function removeCartItem(index) {
    cartItems.splice(index, 1);
    updateCartUI();
}

// ===== CART SIDEBAR =====
function openCart() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    if (sidebar) sidebar.classList.add('open');
    if (overlay) overlay.classList.add('open');
}

function closeCart() {
    const sidebar = document.getElementById('cartSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    if (sidebar) sidebar.classList.remove('open');
    if (overlay) overlay.classList.remove('open');
}

// ===== SEARCH MODAL =====
function openSearch() {
    const modal = document.getElementById('searchModal');
    if (modal) {
        modal.classList.add('open');
        const input = document.getElementById('searchInput');
        if (input) setTimeout(() => input.focus(), 50);
    }
}

function closeSearch() {
    const modal = document.getElementById('searchModal');
    if (modal) modal.classList.remove('open');
}

// ===== INIT =====
function initComponents() {
    cartItems = loadCartItems();
    // Cart icon triggers
    document.querySelectorAll('.cart-icon').forEach(el => {
        el.addEventListener('click', e => { e.preventDefault(); openCart(); });
    });

    // Cart close
    const cartClose = document.getElementById('cartClose');
    if (cartClose) cartClose.addEventListener('click', closeCart);

    const overlay = document.getElementById('sidebarOverlay');
    if (overlay) overlay.addEventListener('click', closeCart);

    // Search triggers
    document.querySelectorAll('.search-trigger').forEach(el => {
        el.addEventListener('click', e => { e.preventDefault(); openSearch(); });
    });

    // Search close
    const searchClose = document.getElementById('searchClose');
    if (searchClose) searchClose.addEventListener('click', closeSearch);

    // ESC key
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeCart(); closeSearch(); }
    });

    lucide.createIcons();
    updateCartUI();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initComponents);
} else {
    initComponents();
}
