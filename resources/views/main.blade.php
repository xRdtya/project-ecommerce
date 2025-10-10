<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TokoOnline - E-commerce Store</title>
    <link rel="stylesheet" href="http://localhost:8000/assets/css/main.css" />
  </head>
  <body>
    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Header -->
    <header>
      <div class="container">
        <div class="header-content">
          <a href="#" class="logo">TokoOnline</a>

          <button class="mobile-toggle" id="mobileToggle">☰</button>

          <nav id="mainNav">
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Produk</a></li>
              <li><a href="#">Kategori</a></li>
              <li><a href="#">Tentang Kami</a></li>
              <li><a href="#">Kontak</a></li>
            </ul>
          </nav>

          <div class="header-actions">
            <form class="search-form">
              <input
                type="text"
                class="search-input"
                placeholder="Cari produk..."
              />
              <button type="submit" class="search-btn">🔍</button>
            </form>
            <button class="cart-btn" id="cartBtn">
              🛒 <span class="cart-count">0</span>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <h1>Selamat Datang di TokoOnline</h1>
          <p>
            Temukan berbagai produk berkualitas dengan harga terbaik hanya di
            toko kami. Belanja sekarang dan dapatkan penawaran spesial!
          </p>
          <a href="#products" class="btn btn-primary">Jelajahi Produk</a>
        </div>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="categories container">
      <h2 class="section-title">Kategori Produk</h2>
      <div class="category-filters">
        <button class="category-filter active" data-category="all">
          Semua
        </button>
        {{-- Looping Products Category --}}
        @foreach ( $products->unique('category') as $product)
        <button class="category-filter" data-category="{{ $product->category->name }}">
          {{ $product->category->name }}
        </button>
        @endforeach
      </div>
    </section>

    <!-- Products Grid -->
    <section class="container" id="products">
      <h2 class="section-title">Produk Terbaru</h2>
      <div class="products-grid" id="productsGrid">
        <!-- Looping Products -->
        @foreach ($products as $product)
        <div class="product-card" data-category="{{ $product->category->name }}">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/4b295106-dd4e-40f9-988e-56160a78666b.png"
            alt="Smartphone modern dengan layar besar dan desain tipis"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">{{ $product->title }}</h3>
            <p class="product-price">Rp. {{ number_format($product->price) }}</p>
            <button
              class="add-to-cart"
              data-id="{{ $product->id }}"
              data-name="{{ $product->title }}"
              data-price="{{ $product->price }}"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/e95e3a24-e5c8-439b-86c6-b4bd44dfce09.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
      <div class="cart-header">
        <h2>Keranjang Belanja</h2>
        <button class="close-cart" id="closeCart">✕</button>
      </div>
      <div class="cart-items" id="cartItems">
        <!-- Cart items will be added here dynamically -->
        <p class="empty-cart-message" id="emptyCartMessage">
          Keranjang belanja Anda kosong.
        </p>
      </div>
      <div class="cart-footer">
        <div class="cart-total">
          <span>Total:</span>
          <span id="cartTotal">Rp 0</span>
        </div>
        <button class="checkout-btn" id="checkoutBtn">
          Lanjut ke Pembayaran
        </button>
      </div>
    </div>

    <!-- Checkout Modal -->
    <div class="checkout-modal" id="checkoutModal">
      <div class="modal-header">
        <h2>Checkout</h2>
      </div>
      <form id="checkoutForm">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Nama Depan</label>
            <input type="text" class="form-input" required />
          </div>
          <div class="form-group">
            <label class="form-label">Nama Belakang</label>
            <input type="text" class="form-input" required />
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-input" required />
        </div>
        <div class="form-group">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-input" required />
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Kota</label>
            <input type="text" class="form-input" required />
          </div>
          <div class="form-group">
            <label class="form-label">Kode Pos</label>
            <input type="text" class="form-input" required />
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Metode Pembayaran</label>
          <select class="form-input" required>
            <option value="">Pilih metode pembayaran</option>
            <option value="credit">Kartu Kredit</option>
            <option value="debit">Kartu Debit</option>
            <option value="transfer">Transfer Bank</option>
          </select>
        </div>
        <button type="submit" class="submit-order">Buat Pesanan</button>
      </form>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="footer-content">
          <div class="footer-column">
            <h3>TokoOnline</h3>
            <p>
              Menyediakan berbagai produk berkualitas dengan harga terbaik untuk
              kebutuhan sehari-hari.
            </p>
            <div class="social-icons">
              <a href="#" class="social-icon">f</a>
              <a href="#" class="social-icon">t</a>
              <a href="#" class="social-icon">i</a>
              <a href="#" class="social-icon">y</a>
            </div>
          </div>
          <div class="footer-column">
            <h3>Belanja</h3>
            <ul>
              <li><a href="#">Produk Terbaru</a></li>
              <li><a href="#">Penawaran Spesial</a></li>
              <li><a href="#">Kategori</a></li>
              <li><a href="#">Panduan Ukuran</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Bantuan</h3>
            <ul>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">Pengembalian</a></li>
              <li><a href="#">Pengiriman</a></li>
              <li><a href="#">Lacak Pesanan</a></li>
            </ul>
          </div>
          <div class="footer-column">
            <h3>Kontak</h3>
            <ul>
              <li>Email: info@tokoonline.com</li>
              <li>Telepon: (021) 1234-5678</li>
              <li>Alamat: smpit</li>
            </ul>
          </div>
        </div>
        <div class="copyright">
          <p>(ini buat tanggal terbit e-commer nya perlu kah)TokoOnline</p>
        </div>
      </div>
    </footer>
    <script src="http://localhost:8000/assets/js/main.js"></script>
  </body>
</html>
