<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TokoOnline - E-commerce Store</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body>
        
        <!-- Header -->
        <header>
            <div class="container">
                <div class="header-content">
                    <a href="#" class="logo" onclick="openSection('home')">TokoOnline</a>
                    <button class="mobile-toggle" id="mobileToggle">☰</button>
                    <nav id="mainNav">
                        <ul>
                            <li><a href="#" onclick="openSection('home')">Home</a></li>
                            <li><a href="/profile">Profil</a></li>
                            <li><a style="pointer-events: none">Welcome Back, {{ auth()->user()->name }}</a></li>
                        </ul>
                    </nav>
                    <div class="header-actions">
                        <form class="search-form">
                            <input type="text" class="search-input" placeholder="Cari produk...">
                            <button type="submit" class="search-btn">🔍</button>
                        </form>
                        <!-- Cart -->
                        <button class="cart-btn" id="cartBtn">
                            🛒 <span class="cart-count">0</span>
                        </button>
                        <button class="btn btn-primary" onclick="openSection('checkoutPage')">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Overlay untuk cart -->
        <div class="overlay" id="overlay"></div>

        <!-- Cart Sidebar -->
        <div class="cart-sidebar" id="cartSidebar">
            <h3>Keranjang Belanja</h3>
            <button class="close-cart" id="closeCart">X</button>
            <div id="emptyCartMessage" style="text-align: center; padding: 20px;">Keranjang kosong.</div>
            <div id="cartItemsList" class="cart-items"></div>
            <div class="cart-summary">
                <h4>Total: <span id="cartTotal">Rp 0</span></h4>
                <button class="btn btn-primary" id="checkoutBtn" onclick="openSection('checkoutPage')">Checkout</button>
            </div>
        </div>
    
        <!-- HOME SECTION -->
        <section class="page-section active-section" id="home">
            <div class="container">
                <section class="hero">
                    <div class="hero-content">
                        <h1>Temukan Produk Terbaik Hanya di Sini</h1>
                        <p>Diskon hingga 50% untuk produk pilihan minggu ini.</p>
                        <a href="#productsList" class="btn btn-primary">Mulai Belanja</a>
                    </div>
                </section>

        <section class="categories container page-section">
          <h2 class="section-title">Kategori Produk</h2>

          <div class="category-filters">
            <button class="category-filter active" data-category="all">Semua</button>

            @foreach ( $products->unique('category') as $product )
              @if ($product->category)
              <button class="category-filter" data-category="{{ $product->category->name }}">
                {{ $product->category->name }}
              </button>
              @endif
            @endforeach
          </div>
        </section>

            <!-- PRODUCT LIST -->
            <section class="container" id="productsList">
                <h2 class="section-title">Produk Terbaru</h2>

                <div class="products-grid">
                    @foreach ($products as $product)
                    <div class="product-card" data-category="{{ $product->category->name }}">
                        <img src="{{ asset('/storage/'. $product->image) }}" class="product-image">

                        <div class="product-info">
                            <h3 class="product-title">{{ $product->title }}</h3>
                            <p class="product-price">Rp. {{ number_format($product->price) }}</p>

                            <button class="add-to-cart"
                                data-id="{{ $product->id }}"
                                data-name="{{ $product->title }}"
                                data-price="{{ $product->price }}"
                                data-image="{{ asset('storage/' . $product->image) }}">
                                Tambah ke Keranjang
                            </button>

                            <button class="btn-detail"
                                onclick="showDetail(
                                    '{{ $product->title }}',
                                    '{{ $product->price }}',
                                    '{{ $product->description }}',
                                    '{{ asset('/storage/'. $product->image) }}'
                                )">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

        </section>



        <!--PRODUCT DETAIL PAGE-->
        <section class="page-section" id="productDetailPage" style="display:none;">
            <div class="container product-detail-container">

                <button class="back-btn" onclick="openSection('home')">← Kembali</button>

                <div class="product-detail">
                    <img id="detailImage" class="detail-image">

                    <div class="detail-info">
                        <h2 id="detailTitle"></h2>
                        <p id="detailPrice" class="detail-price"></p>
                        <article id="detailDescription"></article>

                        <button id="detailAddToCart" class="btn btn-primary">
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

            </div>
        </section>



        <!--CHECKOUT PAGE-->
        <section class="page-section" id="checkoutPage" style="display:none;">
            <div class="container">

                <div class="product-detail-container card-surface">

                    <h2>Checkout</h2>

                    <div id="checkoutItems"></div>

                    <div class="checkout-wrapper">

                        <div class="checkout-left">
                            <label>Nama</label>
                            <input id="checkoutName" type="text" placeholder="Nama penerima">

                            <label>Alamat</label>
                            <textarea id="checkoutAddress" placeholder="Alamat lengkap"></textarea>
                        </div>

                        <div class="checkout-right">
                            <div class="checkout-card">
                                <h3>Ringkasan</h3>
                                <p id="checkoutSummaryPrice" class="summary-total">Rp 0</p>
                                <button id="confirmCheckout" class="checkout-btn checkout-btn-primary">
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>



        <!--  FOOTER  -->
        <footer>
            <div class="container">

                <div class="footer-content">

                    <div class="footer-column">
                        <h3>Tentang Kami</h3>
                        <p>TokoOnline menyediakan berbagai kebutuhan terbaik untuk Anda.</p>
                    </div>

                    <div class="footer-column">
                        <h3>Belanja</h3>
                        <ul>
                            <li><a href="#">Produk Terbaru</a></li>
                            <li><a href="#">Promo</a></li>
                            <li><a href="#">Kategori</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h3>Bantuan</h3>
                        <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Pengembalian</a></li>
                            <li><a href="#">Pengiriman</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h3>Kontak</h3>
                        <ul>
                            <li>Email: support@tokoonline.com</li>
                            <li>Telp: 021-12345678</li>
                        </ul>
                    </div>

                </div>

                <div class="copyright">
                    <p>© 2025 TokoOnline</p>
                </div>

            </div>
        </footer>


        <!-- Scripts -->
        <script>
            // Inisialisasi checkout jika di halaman checkout
            if (window.location.hash === '#checkout' || document.getElementById('checkoutPage')) {
                document.addEventListener('DOMContentLoaded', function() {
                    openSection('checkoutPage');
                });
            }
        </script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/checkout.js"></script>

    </body>
</html>