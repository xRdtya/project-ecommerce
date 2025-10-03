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
        <button class="category-filter" data-category="electronics">
          Elektronik
        </button>
        <button class="category-filter" data-category="fashion">Fashion</button>
        <button class="category-filter" data-category="home">
          Rumah Tangga
        </button>
        <button class="category-filter" data-category="sports">Olahraga</button>
      </div>
    </section>

    <!-- Products Grid -->
    <section class="container" id="products">
      <h2 class="section-title">Produk Terbaru</h2>
      <div class="products-grid" id="productsGrid">
        <!-- Product 1 -->
        @foreach ($products as $product)
        <div class="product-card" data-category="electronics">
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
        <!-- Product 2 -->
        <div class="product-card" data-category="electronics">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/4d1c80ec-ea78-4945-b1a6-fb0573b3f108.png"
            alt="Laptop premium dengan layar tipis dan keyboard backlit"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Laptop Ultra Slim</h3>
            <p class="product-price">Rp 8.999.000</p>
            <button
              class="add-to-cart"
              data-id="2"
              data-name="Laptop Ultra Slim"
              data-price="8999000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/09ddff72-688d-4a4a-a11f-fd2d3fc43eea.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="product-card" data-category="fashion">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8703e988-e767-49e4-a3e8-08fbdc1bb6c0.png"
            alt="Kaos casual dengan desain modern dan bahan katun nyaman"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Kaos Premium</h3>
            <p class="product-price">Rp 199.000</p>
            <button
              class="add-to-cart"
              data-id="3"
              data-name="Kaos Premium"
              data-price="199000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/af75c649-9e7b-45a8-9fdc-e786502f45c3.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="product-card" data-category="fashion">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/01912219-5681-4fad-8555-cb97672a4be3.png"
            alt="Sepatu sneakers dengan sol karet dan desain sporty"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Sneakers Sporty</h3>
            <p class="product-price">Rp 459.000</p>
            <button
              class="add-to-cart"
              data-id="4"
              data-name="Sneakers Sporty"
              data-price="459000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/c037fbcb-d54b-4675-b02f-f85825ed1629.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 5 -->
        <div class="product-card" data-category="home">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/8e45afcb-cb10-441a-9392-a856cdf80cdf.png"
            alt="Blender dapur dengan pisau stainless steel dan kapasitas besar"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Blender Multifungsi</h3>
            <p class="product-price">Rp 650.000</p>
            <button
              class="add-to-cart"
              data-id="5"
              data-name="Blender Multifungsi"
              data-price="650000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2dc1c311-f425-4eda-b340-0c771f040ed1.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 6 -->
        <div class="product-card" data-category="home">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2f68df1b-0970-4b2f-9548-621458c62fd2.png"
            alt="Penyedot debu dengan teknologi canggih dan desain ergonomis"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Penyedot Debu Robot</h3>
            <p class="product-price">Rp 1.799.000</p>
            <button
              class="add-to-cart"
              data-id="6"
              data-name="Penyedot Debu Robot"
              data-price="1799000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d22ab817-3345-41fe-a8d7-0cf6ac61eccf.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 7 -->
        <div class="product-card" data-category="sports">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/9a2c3c8e-0eeb-4f2f-b6b5-058076f7925e.png"
            alt="Dumbel dengan pelapis krom dan grip ergonomis"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Dumbel Set 20kg</h3>
            <p class="product-price">Rp 899.000</p>
            <button
              class="add-to-cart"
              data-id="7"
              data-name="Dumbel Set 20kg"
              data-price="899000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/ee1620e0-1a30-4d91-8a1a-dc0e9368be35.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>

        <!-- Product 8 -->
        <div class="product-card" data-category="sports">
          <img
            src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1432342e-14ef-48c4-bb92-34a1ea6fbe42.png"
            alt="Matras yoga dengan tekstur anti-slip dan bahan ramah lingkungan"
            class="product-image"
          />
          <div class="product-info">
            <h3 class="product-title">Matras Yoga Premium</h3>
            <p class="product-price">Rp 299.000</p>
            <button
              class="add-to-cart"
              data-id="8"
              data-name="Matras Yoga Premium"
              data-price="299000"
              data-image="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/7392c244-1217-4604-a719-f20a992f6db0.png"
            >
              Tambah ke Keranjang
            </button>
          </div>
        </div>
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
