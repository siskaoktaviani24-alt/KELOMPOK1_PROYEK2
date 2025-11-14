<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Kedai Kopi Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #654321;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
        }

        .coffee-bg {
            background-color: var(--primary-color);
        }

        .btn-coffee {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-coffee:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .text-coffee {
            color: var(--primary-color);
        }

        /* Menu Card Styles */
        .menu-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .menu-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .badge-stok {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }

        /* Cart Sidebar Styles */
        .cart-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            transition: right 0.3s ease;
            z-index: 1050;
            display: flex;
            flex-direction: column;
        }

        .cart-sidebar.open {
            right: 0;
        }

        .cart-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .cart-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .cart-footer {
            padding: 20px;
            border-top: 1px solid #dee2e6;
            background: var(--light-color);
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            display: none;
        }

        .overlay.show {
            display: block;
        }

        /* Floating Cart Button */
        .floating-cart {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(139, 69, 19, 0.3);
            cursor: pointer;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .floating-cart:hover {
            transform: scale(1.1);
            background: var(--secondary-color);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Category Filter */
        .category-filter {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .category-btn {
            border: none;
            background: none;
            padding: 8px 15px;
            margin: 5px;
            border-radius: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .category-btn:hover:not(.active) {
            background: var(--light-color);
        }

        /* Quick Info Cards */
        .info-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary-color);
        }

        /* Toast Notification */
        .custom-toast {
            z-index: 9999;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-sidebar {
                width: 100%;
                right: -100%;
            }
            
            .floating-cart {
                bottom: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark coffee-bg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-coffee me-2"></i>
                Kedai Kopi Premium
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('booking_tempat.index') }}">
                    <i class="fas fa-calendar-alt me-1"></i>Booking Tempat
                </a>
                <a class="nav-link active" href="{{ route('menu.index') }}">
                    <i class="fas fa-utensils me-1"></i>Menu
                </a>
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <i class="fas fa-list me-1"></i>Status Pesanan
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Menu Kami</h1>
            <p class="lead">Pilih menu favorit Anda dan nikmati pengalaman berbelanja yang mudah</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <!-- Info Booking Session -->
        @if($isFromBookingSession)
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Informasi Booking Tempat:</strong><br>
            Anda sedang memesan menu untuk booking: 
            <strong>{{ $bookingData['kode_booking'] }}</strong><br>
            Tanggal: {{ \Carbon\Carbon::parse($bookingData['tanggal_reservasi'])->format('d F Y') }} | 
            Waktu: {{ $bookingData['waktu_reservasi'] }} | 
            Jumlah Orang: {{ $bookingData['jumlah_orang'] }}
        </div>
        @endif

        @if(session('booking_info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('booking_info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Header dengan Filter dan Keranjang -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-utensils me-2"></i>Daftar Menu</h2>
                    <button class="btn btn-coffee" onclick="openCart()">
                        <i class="fas fa-shopping-cart me-1"></i>
                        Keranjang (<span id="cart-count">0</span>)
                    </button>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('menu.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari menu..." value="{{ request('q') }}">
                        <button class="btn btn-coffee" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="category-filter">
                    <div class="d-flex flex-wrap">
                        <button class="category-btn active" data-category="all">Semua</button>
                        @php
                            $categories = $menus->pluck('kategori')->unique()->filter();
                        @endphp
                        @foreach($categories as $category)
                            <button class="category-btn" data-category="{{ $category }}">{{ $category }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Grid -->
        <div class="row" id="menu-grid">
            @foreach($menus as $menu)
<div class="col-lg-4 col-md-6 mb-4 menu-item" data-category="{{ $menu->kategori ?? 'uncategorized' }}">
    <div class="card menu-card">
        <div class="position-relative">
            @if($menu->gambar)
                <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top menu-image" alt="{{ $menu->nama_menu }}">
            @else
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top menu-image" alt="Default menu image">
            @endif
            <span class="badge badge-stok {{ $menu->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                {{ $menu->stok > 0 ? 'Stok: ' . $menu->stok : 'Habis' }}
            </span>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
            <p class="card-text text-muted small">{{ Str::limit($menu->deskripsi, 100) }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-coffee mb-0">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h6>
                @if($menu->stok > 0)
                    <button class="btn btn-coffee btn-sm add-to-cart" 
                            data-menu-id="{{ $menu->id }}"
                            data-menu-name="{{ $menu->nama_menu }}"
                            data-menu-price="{{ $menu->harga }}"
                            data-menu-image="{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}">
                        <i class="fas fa-cart-plus me-1"></i>Tambah
                    </button>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>
                        <i class="fas fa-times me-1"></i>Habis
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
        </div>

        @if($menus->count() == 0)
            <div class="text-center py-5">
                <i class="fas fa-utensils fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Menu Tidak Tersedia</h3>
                <p class="text-muted">Maaf, saat ini tidak ada menu yang tersedia.</p>
                <a href="{{ route('menu.categories') }}" class="btn btn-coffee">
                    <i class="fas fa-tags me-2"></i>Lihat Kategori Lain
                </a>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <i class="fas fa-shipping-fast fa-2x text-coffee mb-2"></i>
                                <h6>Gratis Ongkir</h6>
                                <small class="text-muted">Min. pembelian Rp 50.000</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <i class="fas fa-clock fa-2x text-coffee mb-2"></i>
                                <h6>Siap dalam 15 Menit</h6>
                                <small class="text-muted">Untuk pesanan takeaway</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <i class="fas fa-credit-card fa-2x text-coffee mb-2"></i>
                                <h6>Berbagai Pembayaran</h6>
                                <small class="text-muted">Cash, DANA, dan lainnya</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h5>
            <button class="btn btn-sm btn-light" onclick="closeCart()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-body" id="cartBody">
            <!-- Cart items will be loaded here -->
            <div class="text-center text-muted py-5" id="emptyCart">
                <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                <p>Keranjang belanja Anda kosong</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="cartTotal">Rp 0</strong>
            </div>
            <button class="btn btn-coffee w-100 mb-2" onclick="checkout()" id="checkoutBtn" disabled>
                <i class="fas fa-credit-card me-2"></i>Checkout
            </button>
            <button class="btn btn-outline-secondary w-100" onclick="clearCart()">
                <i class="fas fa-trash me-2"></i>Kosongkan Keranjang
            </button>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeCart()"></div>

    <!-- Floating Cart Button -->
    <div class="floating-cart" onclick="openCart()">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-badge" id="floatingCartCount">0</span>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-2">
                <i class="fas fa-map-marker-alt me-2"></i>Jl. Kopi Mantap No. 123, Jakarta
                <i class="fas fa-phone ms-3 me-2"></i>(021) 1234-5678
            </p>
            <p class="mb-0">&copy; 2024 Kedai Kopi Premium. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Cart functionality - PERBAIKAN LENGKAP
    let cart = [];

    // Improved cart initialization
    function initializeCart() {
        try {
            const savedCart = localStorage.getItem('menu_cart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                console.log('Cart loaded from localStorage:', cart);
            } else {
                cart = [];
            }
        } catch (error) {
            console.error('Error loading cart:', error);
            cart = [];
            localStorage.removeItem('menu_cart');
        }
        updateCartDisplay();
    }

    function updateCartDisplay() {
        const cartBody = document.getElementById('cartBody');
        const cartTotal = document.getElementById('cartTotal');
        const cartCount = document.getElementById('cart-count');
        const floatingCartCount = document.getElementById('floatingCartCount');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // Hitung total items
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        
        if (cart.length === 0) {
            cartBody.innerHTML = '<div class="text-center text-muted py-5" id="emptyCart"><i class="fas fa-shopping-cart fa-3x mb-3"></i><p>Keranjang belanja Anda kosong</p></div>';
            checkoutBtn.disabled = true;
        } else {
            let total = 0;
            let cartHTML = '';

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                cartHTML += `
                    <div class="cart-item">
                        <img src="${item.image}" class="cart-item-image" alt="${item.name}" 
                             onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'">
                        <div class="cart-item-details">
                            <h6 class="mb-1">${item.name}</h6>
                            <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small>
                        </div>
                        <div class="cart-item-controls">
                            <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" readonly>
                            <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                            <button class="btn btn-sm btn-outline-danger ms-2" onclick="removeFromCart(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            cartBody.innerHTML = cartHTML;
            checkoutBtn.disabled = false;
        }

        cartTotal.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        cartCount.textContent = totalItems;
        floatingCartCount.textContent = totalItems;
        
        // Simpan ke localStorage setiap kali update
        localStorage.setItem('menu_cart', JSON.stringify(cart));
    }

    // Fungsi addToCart yang lebih robust
    function addToCart(menuId, menuName, menuPrice, menuImage) {
        console.log('Adding to cart:', { menuId, menuName, menuPrice, menuImage });
        
        // Validasi input
        if (!menuId || !menuName || !menuPrice) {
            console.error('Data menu tidak valid:', {menuId, menuName, menuPrice});
            showToast('Error: Data menu tidak valid', 'error');
            return;
        }

        const existingItem = cart.find(item => item.id == menuId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({
                id: menuId,
                name: menuName,
                price: parseInt(menuPrice),
                image: menuImage,
                quantity: 1
            });
        }
        
        updateCartDisplay();
        showToast(`${menuName} berhasil ditambahkan ke keranjang!`, 'success');
        
        // Auto buka cart sidebar
        openCart();
    }

    function updateQuantity(index, change) {
        if (cart[index]) {
            cart[index].quantity += change;
            
            if (cart[index].quantity < 1) {
                cart[index].quantity = 1;
            }
            
            updateCartDisplay();
        }
    }

    function removeFromCart(index) {
        if (cart[index]) {
            const itemName = cart[index].name;
            cart.splice(index, 1);
            updateCartDisplay();
            showToast(`${itemName} dihapus dari keranjang!`, 'warning');
        }
    }

    function clearCart() {
        if (confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
            cart = [];
            updateCartDisplay();
            showToast('Keranjang berhasil dikosongkan!', 'info');
        }
    }

    function openCart() {
        document.getElementById('cartSidebar').classList.add('open');
        document.getElementById('overlay').classList.add('show');
    }

    function closeCart() {
        document.getElementById('cartSidebar').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }

    function checkout() {
        if (cart.length === 0) {
            showToast('Keranjang kosong!', 'warning');
            return;
        }
        
        // Redirect to booking form with cart data
        window.location.href = "{{ route('booking.create') }}";
    }

    function showToast(message, type = 'success') {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.custom-toast');
        existingToasts.forEach(toast => toast.remove());
        
        const bgColor = type === 'error' ? 'bg-danger' : 
                       type === 'warning' ? 'bg-warning' : 
                       type === 'info' ? 'bg-info' : 'bg-success';
        
        const icon = type === 'error' ? 'exclamation-triangle' : 
                    type === 'warning' ? 'exclamation-circle' : 
                    type === 'info' ? 'info-circle' : 'check-circle';
        
        const toast = document.createElement('div');
        toast.className = `position-fixed bottom-0 end-0 p-3 ${bgColor} text-white rounded m-3 custom-toast`;
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${icon} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close btn-close-white ms-3" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 3000);
    }

    // Category filter - PERBAIKAN LENGKAP
    function initializeCategoryFilter() {
        console.log('Initializing category filter...');
        
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                console.log('Category selected:', category);
                
                // Update active button
                document.querySelectorAll('.category-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                
                // Filter menu items
                let visibleCount = 0;
                document.querySelectorAll('.menu-item').forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    console.log('Item category:', itemCategory, 'Filter:', category);
                    
                    if (category === 'all' || itemCategory === category) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                console.log('Visible items:', visibleCount);
            });
        });
    }

    // Initialize add to cart buttons - PERBAIKAN
    function initializeAddToCartButtons() {
        console.log('Initializing add to cart buttons...');
        
        document.querySelectorAll('.add-to-cart').forEach(button => {
            // Hapus event listener lama jika ada
            button.replaceWith(button.cloneNode(true));
        });
        
        // Tambah event listener baru
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const menuId = this.getAttribute('data-menu-id');
                const menuName = this.getAttribute('data-menu-name');
                const menuPrice = this.getAttribute('data-menu-price');
                const menuImage = this.getAttribute('data-menu-image');
                
                console.log('Add to cart clicked:', { menuId, menuName, menuPrice, menuImage });
                
                addToCart(menuId, menuName, menuPrice, menuImage);
            });
        });
        
        console.log('Total add to cart buttons:', document.querySelectorAll('.add-to-cart').length);
    }

    // Debug function
    function debugCart() {
        console.log('Current Cart:', cart);
        console.log('LocalStorage:', localStorage.getItem('menu_cart'));
        console.log('Total Items:', cart.reduce((sum, item) => sum + item.quantity, 0));
        console.log('Add to cart buttons:', document.querySelectorAll('.add-to-cart').length);
    }

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        
        initializeCart();
        initializeCategoryFilter();
        initializeAddToCartButtons();
        
        // Test: log semua menu items dan kategori
        console.log('Menu items:', document.querySelectorAll('.menu-item').length);
        document.querySelectorAll('.menu-item').forEach(item => {
            console.log('Item:', item.querySelector('.card-title')?.textContent, 
                       'Category:', item.getAttribute('data-category'));
        });
        
        // Auto open cart if from booking session
        @if($isFromBookingSession)
        setTimeout(() => {
            if (cart.length === 0) {
                openCart();
            }
        }, 1000);
        @endif
        
        // Debug info
        setTimeout(debugCart, 1000);
    });

    // Juga inisialisasi ulang saat halaman selesai load sepenuhnya
    window.addEventListener('load', function() {
        console.log('Window fully loaded');
        initializeAddToCartButtons();
    });
</script>
</body>
</html>