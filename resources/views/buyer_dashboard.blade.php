<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard Pembeli</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <style>
            .dashboard-container {
                width: 90%;
                max-width: 1200px;
                margin: 40px auto;
                background: white;
                padding: 30px;
                border-radius: 14px;
                box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            }
            
            .dashboard-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            
            .dashboard-header h1 {
                color: #4a6cf7;
            }
            
            .dashboard-content {
                margin-top: 30px;
            }
            
            .wishlist-section {
                margin-top: 40px;
            }
            
            .wishlist-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 20px;
                margin-top: 15px;
            }
            
            .wishlist-item {
                background: #f9f9ff;
                padding: 15px;
                border-radius: 10px;
                border: 1px solid #e0e4ff;
            }
        </style>
    </head>
    <body>

        <div class="dashboard-container">
            <div class="dashboard-header">
                <div>
                    <h1>Dashboard Pembeli</h1>
                    <p>Selamat datang, <span id="dashboardUserName">{{ auth()->user()->name }}</span>!</p>
                </div>
                <div>
                    <a href="/" class="btn btn-primary">Lanjut Belanja</a>
                    <a href="/profile" class="btn" style="margin-left: 10px;">Kembali ke Profil</a>
                </div>
            </div>
            
            <div id="buyerStats"></div>
            
            <div class="dashboard-content">
                <div id="buyerOrdersList">
                    <!-- Order history-->
                </div>
            </div>
            
            <div class="wishlist-section">
                <h2>Wishlist Saya</h2>
                <div id="wishlistItems" class="wishlist-grid">
                    <!-- Wishlist items-->
                </div>
            </div>
        </div>

        <script>
            // Load wishlist from localStorage
            document.addEventListener('DOMContentLoaded', function() {
                const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                const wishlistContainer = document.getElementById('wishlistItems');
                
                if (wishlist.length === 0) {
                    wishlistContainer.innerHTML = `
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: #f9f9ff; border-radius: 10px;">
                            <p style="color: #666; margin-bottom: 15px;">Wishlist masih kosong</p>
                            <a href="main.blade.php" class="btn btn-primary">Jelajahi Produk</a>
                        </div>
                    `;
                } else {
                    wishlist.forEach(item => {
                        const itemElement = document.createElement('div');
                        itemElement.className = 'wishlist-item';
                        itemElement.innerHTML = `
                            <img src="${item.image}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                            <h4 style="margin: 0 0 5px 0; font-size: 16px;">${item.name}</h4>
                            <p style="margin: 0; color: #4a6cf7; font-weight: 600;">Rp ${item.price.toLocaleString()}</p>
                            <div style="margin-top: 10px; display: flex; gap: 8px;">
                                <button onclick="addToWishlistCart('${item.id}')" class="btn" style="padding: 6px 12px; background: #4a6cf7; color: white; font-size: 13px; flex: 1;">+ Keranjang</button>
                                <button onclick="removeFromWishlist('${item.id}')" class="btn" style="padding: 6px 12px; background: #f0f0f0; color: #333; font-size: 13px;">×</button>
                            </div>
                        `;
                        wishlistContainer.appendChild(itemElement);
                    });
                }
            });
            
            // Helper functions for wishlist
            window.addToWishlistCart = function(itemId) {
                const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                const item = wishlist.find(w => w.id === itemId);
                
                if (item && window.addToCart) {
                    window.addToCart(item);
                    alert(`${item.name} ditambahkan ke keranjang!`);
                }
            };
            
            window.removeFromWishlist = function(itemId) {
                if (confirm('Hapus dari wishlist?')) {
                    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                    const updatedWishlist = wishlist.filter(w => w.id !== itemId);
                    localStorage.setItem('wishlist', JSON.stringify(updatedWishlist));
                    location.reload();
                }
            };
        </script>
    </body>

</html>