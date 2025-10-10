document.addEventListener('DOMContentLoaded', function () {
  // Elements
  const mobileToggle = document.getElementById('mobileToggle');
  const mainNav = document.getElementById('mainNav');
  const cartBtn = document.getElementById('cartBtn');
  const closeCart = document.getElementById('closeCart');
  const cartSidebar = document.getElementById('cartSidebar');
  const overlay = document.getElementById('overlay');
  const checkoutBtn = document.getElementById('checkoutBtn');
  const checkoutModal = document.getElementById('checkoutModal');
  const checkoutForm = document.getElementById('checkoutForm');
  const emptyCartMessage = document.getElementById('emptyCartMessage');
  const cartItems = document.getElementById('cartItems');
  const cartTotal = document.getElementById('cartTotal');
  const cartCount = document.querySelector('.cart-count');
  const categoryFilters = document.querySelectorAll('.category-filter');
  const productCards = document.querySelectorAll('.product-card');
  const addToCartButtons = document.querySelectorAll('.add-to-cart');
  const searchInput = document.querySelector('.search-input');
  const searchForm = document.querySelector('.search-form');

  // Cart data
  let cart = [];

  // Toggle mobile navigation
  mobileToggle.addEventListener('click', function () {
    mainNav.classList.toggle('active');
  });

  // Open cart
  cartBtn.addEventListener('click', function () {
    cartSidebar.classList.add('open');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  });

  // Close cart
  closeCart.addEventListener('click', closeCartSidebar);
  overlay.addEventListener('click', closeCartSidebar);

  function closeCartSidebar() {
    cartSidebar.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
  }

  // Open checkout modal
  checkoutBtn.addEventListener('click', function () {
    if (cart.length > 0) {
      checkoutModal.classList.add('open');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  });

  // Close checkout modal
  overlay.addEventListener('click', function () {
    if (checkoutModal.classList.contains('open')) {
      checkoutModal.classList.remove('open');
      overlay.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
  });

  // Handle checkout form submission
  checkoutForm.addEventListener('submit', function (e) {
    e.preventDefault();
    alert('Pesanan Anda telah berhasil dibuat! Terima kasih telah berbelanja.');
    cart = [];
    updateCart();
    checkoutModal.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
  });

  // Filter products by category
  categoryFilters.forEach(filter => {
    filter.addEventListener('click', function () {
      const category = this.getAttribute('data-category');

      // Update active filter
      categoryFilters.forEach(f => f.classList.remove('active'));
      this.classList.add('active');

      // Filter products
      productCards.forEach(card => {
        if (
          category === 'all' ||
          card.getAttribute('data-category') === category
        ) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // Search products
  searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const searchTerm = searchInput.value.toLowerCase();

    productCards.forEach(card => {
      const title = card
        .querySelector('.product-title')
        .textContent.toLowerCase();
      if (title.includes(searchTerm)) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  });

  // Add to cart functionality
  addToCartButtons.forEach(button => {
    button.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const name = this.getAttribute('data-name');
      const price = parseInt(this.getAttribute('data-price'));
      const image = this.getAttribute('data-image');

      // Check if product already in cart
      const existingItem = cart.find(item => item.id === id);

      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({
          id,
          name,
          price,
          image,
          quantity: 1,
        });
      }

      updateCart();

      // Show cart sidebar after adding item
      cartSidebar.classList.add('open');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  });

  // Update cart UI
  function updateCart() {
    // Update cart count
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = totalItems;

    // Clear cart items
    cartItems.innerHTML = '';

    if (cart.length === 0) {
      emptyCartMessage.style.display = 'block';
      checkoutBtn.disabled = true;
      checkoutBtn.style.opacity = '0.5';
      cartTotal.textContent = 'Rp 0';
    } else {
      emptyCartMessage.style.display = 'none';
      checkoutBtn.disabled = false;
      checkoutBtn.style.opacity = '1';

      // Calculate total
      let total = 0;

      // Add items to cart
      cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        const cartItemElement = document.createElement('div');
        cartItemElement.classList.add('cart-item');
        cartItemElement.innerHTML = `
                            <img src="${item.image}" alt="${
          item.name
        }" class="cart-item-image">
                            <div class="cart-item-details">
                                <h3 class="cart-item-title">${item.name}</h3>
                                <p class="cart-item-price">Rp ${formatCurrency(
                                  item.price
                                )}</p>
                                <div class="cart-item-actions">
                                    <button class="quantity-btn minus" data-id="${
                                      item.id
                                    }">-</button>
                                    <input type="number" class="quantity-input" value="${
                                      item.quantity
                                    }" min="1" data-id="${item.id}">
                                    <button class="quantity-btn plus" data-id="${
                                      item.id
                                    }">+</button>
                                    <button class="remove-item" data-id="${
                                      item.id
                                    }">Hapus</button>
                                </div>
                            </div>
                        `;

        cartItems.appendChild(cartItemElement);
      });

      // Format total currency
      cartTotal.textContent = `Rp ${formatCurrency(total)}`;

      // Add event listeners to quantity buttons
      document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
        btn.addEventListener('click', function () {
          const id = this.getAttribute('data-id');
          const item = cart.find(item => item.id === id);

          if (item.quantity > 1) {
            item.quantity -= 1;
            updateCart();
          }
        });
      });

      document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
        btn.addEventListener('click', function () {
          const id = this.getAttribute('data-id');
          const item = cart.find(item => item.id === id);

          item.quantity += 1;
          updateCart();
        });
      });

      document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function () {
          const id = this.getAttribute('data-id');
          const item = cart.find(item => item.id === id);
          const newQuantity = parseInt(this.value);

          if (newQuantity > 0) {
            item.quantity = newQuantity;
            updateCart();
          }
        });
      });

      document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function () {
          const id = this.getAttribute('data-id');
          cart = cart.filter(item => item.id !== id);
          updateCart();
        });
      });
    }
  }

  // Format currency
  function formatCurrency(amount) {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }
});