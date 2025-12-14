document.addEventListener('DOMContentLoaded', function () {
    
    // ===============================================
    // MOBILE MENU & UI ELEMENTS
    // ===============================================
    const mobileToggle = document.getElementById('mobileToggle');
    const mainNav = document.getElementById('mainNav');
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
            mainNav.classList.toggle('active');
        });
    }
    
    const cartSidebar = document.getElementById('cartSidebar');
    const cartBtn = document.getElementById('cartBtn');
    const closeCart = document.getElementById('closeCart');
    const overlay = document.getElementById('overlay');
    const cartItemsList = document.getElementById('cartItemsList');
    const cartTotalElement = document.getElementById('cartTotal');
    const cartCount = document.querySelector('.cart-count');
    const emptyCartMessage = document.getElementById('emptyCartMessage');
    const detailAddToCartBtn = document.getElementById("detailAddToCart");
    const checkoutBtn = document.getElementById("checkoutBtn");
    const searchForm = document.querySelector(".search-form");
    const searchInput = document.querySelector(".search-input");
    const categoryFilters = document.querySelectorAll(".category-filter");

    let currentDetailProduct = {};

    // ===============================================
    // PERSISTENSI KERANJANG (LOCAL STORAGE)
    // ===============================================
    
    function loadCart() {
        try {
            const storedCart = localStorage.getItem('shoppingCart');
            return storedCart ? JSON.parse(storedCart) : [];
        } catch (e) {
            console.error("Gagal memuat keranjang dari LocalStorage:", e);
            return [];
        }
    }

    function saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
    }

    let cart = loadCart();

    // Update cart count function
    function updateCartCountAndSave() {
        if (cartCount) {
            cartCount.textContent = cart.reduce((total, item) => total + item.qty, 0);
        }
        saveCart();
    }
    
    
    // Add to cart with toast notification
    function addToCart(itemData) {
        const existingItemIndex = cart.findIndex(item => item.id == itemData.id);

        if (existingItemIndex > -1) {
            cart[existingItemIndex].qty += 1;
            showToast(`${itemData.name} ditambahkan lagi (+1)`);
        } else {
            cart.push({...itemData, qty: 1});
            showToast(`${itemData.name} ditambahkan ke keranjang`);
        }
        
        updateCartCountAndSave();
        
        // Update display jika cart sidebar terbuka
        if (cartSidebar && cartSidebar.classList.contains('open')) {
            updateCartDisplay();
        }
    }
    
    
    // Complete cart display function
    function updateCartDisplay() {
        updateCartCountAndSave();
        
        if (cartItemsList) {
            cartItemsList.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                if (emptyCartMessage) emptyCartMessage.style.display = 'block';
                if (cartTotalElement) cartTotalElement.textContent = 'Rp 0';
            } else {
                if (emptyCartMessage) emptyCartMessage.style.display = 'none';

                cart.forEach(item => {
                    const itemTotal = item.price * item.qty;
                    total += itemTotal;

                    const cartItem = document.createElement('div');
                    cartItem.className = 'cart-item';
                    cartItem.innerHTML = `
                        <img src="${item.image}" alt="${item.name}">
                        <div class="item-info">
                            <h4>${item.name}</h4>
                            <p>Rp ${item.price.toLocaleString()} x ${item.qty}</p>
                            <p>Subtotal: Rp ${itemTotal.toLocaleString()}</p>
                        </div>
                        <button class="remove-item" data-id="${item.id}">Hapus</button>
                    `;
                    cartItemsList.appendChild(cartItem);
                });
                
                if (cartTotalElement) cartTotalElement.textContent = `Rp ${total.toLocaleString()}`;
            }
        }
        
        attachCartListeners();
    }
    

    function attachCartListeners() {
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const itemName = cart.find(item => item.id == id)?.name || "Item";
                cart = cart.filter(item => item.id != id);
                updateCartDisplay();
                showToast(`${itemName} dihapus dari keranjang`);
            });
        });
    }

    // Toast notification system
    function showToast(message) {
        // Hapus toast lama jika ada
        const oldToast = document.querySelector('.toast');
        if (oldToast) oldToast.remove();
        
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Styling toast
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #4a6cf7;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            z-index: 9999;
            font-weight: 500;
            animation: fadeInUp 0.3s, fadeOutDown 0.3s 2.7s;
        `;
        
        // Animasi keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from { opacity: 0; transform: translate(-50%, 20px); }
                to { opacity: 1; transform: translate(-50%, 0); }
            }
            @keyframes fadeOutDown {
                from { opacity: 1; transform: translate(-50%, 0); }
                to { opacity: 0; transform: translate(-50%, 20px); }
            }
        `;
        document.head.appendChild(style);
        
        setTimeout(() => {
            toast.remove();
            style.remove();
        }, 3000);
    }
    

    // ===============================================
    // EVENT LISTENERS UTAMA
    // ===============================================
    
    if (cartBtn) cartBtn.addEventListener('click', function () {
        if (cartSidebar) {
            cartSidebar.classList.add('open');
            updateCartDisplay();
        }
        if (overlay) overlay.classList.add('active');
    });

    if (closeCart) closeCart.addEventListener('click', function () {
        if (cartSidebar) cartSidebar.classList.remove('open');
        if (overlay) overlay.classList.remove('active');
    });

    if (overlay) overlay.addEventListener('click', function () {
        if (cartSidebar) cartSidebar.classList.remove('open');
        overlay.classList.remove('active');
    });

    // Checkout button handler
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function () {
            if (cart.length === 0) {
                alert("Keranjang masih kosong!");
                return;
            }
            openSection('checkoutPage');
            if (cartSidebar) cartSidebar.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
        });
    }
    

    // Delegated event listener for add to cart buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart')) {
            const btn = e.target;
            const item = {
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: Number(btn.dataset.price),
                image: btn.dataset.image
            };
            addToCart(item);
        }
    });
    

    // Search functionality
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim().toLowerCase();
            
            if (!query) {
                // Reset tampilan jika search kosong
                document.querySelectorAll('.product-card').forEach(card => {
                    card.style.display = 'block';
                });
                return;
            }
            
            // Filter produk berdasarkan judul
            document.querySelectorAll('.product-card').forEach(card => {
                const title = card.querySelector('.product-title').textContent.toLowerCase();
                if (title.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            showToast(`Menampilkan hasil untuk: "${query}"`);
        });
        
        // Reset saat input dikosongkan
        searchInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                document.querySelectorAll('.product-card').forEach(card => {
                    card.style.display = 'block';
                });
            }
        });
    }
    

    // Category filter functionality
    // CATEGORY FILTER (hanya di section)
    if (categoryFilters.length > 0) {
        categoryFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Update active state
                categoryFilters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                
                // Filter produk
                document.querySelectorAll('.product-card').forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                if (category !== 'all') {
                    showToast(`Menampilkan kategori: ${this.textContent}`);
                }
            });
        });
    }
    

    // ===============================================
    // PAGE NAVIGATION & PRODUCT DETAIL
    // ===============================================
    
    function openSection(sectionId) {
        document.querySelectorAll(".page-section").forEach(sec => {
            sec.style.display = "none";
        });
        const targetSection = document.getElementById(sectionId);
        if (targetSection) {
            targetSection.style.display = "block";
        }
        
        // Jika ke halaman checkout, update tampilan
        if (sectionId === 'checkoutPage') {
            if (typeof renderCheckoutItems === 'function') {
                renderCheckoutItems();
            }
        }
        
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
    window.openSection = openSection;

    window.showDetail = function (title, price, desc, image, id) {
        openSection("productDetailPage");

        currentDetailProduct = {
            id: id || title.replace(/\s/g, '_'),
            name: title,
            price: Number(price),
            image: image
        };

        document.getElementById("detailTitle").textContent = title;
        document.getElementById("detailPrice").textContent = "Rp " + Number(price).toLocaleString();
        document.getElementById("detailDescription").textContent = desc;
        document.getElementById("detailImage").src = image;
    };
    
    if (detailAddToCartBtn) {
        detailAddToCartBtn.addEventListener("click", () => {
            if (currentDetailProduct && currentDetailProduct.name) {
                addToCart(currentDetailProduct);
            } else {
                alert("Terjadi kesalahan: Detail produk tidak ditemukan.");
            }
        });
    }

    // ===============================================
    // INISIALISASI AKHIR
    // ===============================================
    updateCartCountAndSave();
    
    // Export cart untuk checkout.js
    window.cartData = cart;
    window.getCartData = () => cart;
    window.updateCartDisplay = updateCartDisplay;
});
