<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Kedai Kopi Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
        }
        .coffee-bg {
            background-color: #8B4513;
        }
        .btn-coffee {
            background-color: #8B4513;
            color: white;
            border: none;
        }
        .btn-coffee:hover {
            background-color: #654321;
            color: white;
        }
        .menu-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .menu-card:hover {
            transform: translateY(-5px);
        }
        .menu-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 8px 8px 0 0;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .price-tag {
            font-size: 1.25rem;
            font-weight: bold;
            color: #8B4513;
        }
        .stok-info {
            font-size: 0.9rem;
        }
        .bg-coffee {
            background-color: #8B4513 !important;
        }
        .search-box {
            max-width: 500px;
            margin: 0 auto;
        }
        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            background: white;
            cursor: pointer;
        }
        .quantity-btn:hover {
            background: #f8f9fa;
        }
        .quantity-display {
            min-width: 40px;
            text-align: center;
            font-weight: bold;
        }
        .btn-outline-coffee {
            border-color: #8B4513;
            color: #8B4513;
        }
        .btn-outline-coffee:hover {
            background-color: #8B4513;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark coffee-bg">
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
            <p class="lead">Nikmati berbagai pilihan kopi dan makanan terbaik</p>
        </div>
    </div>

    <!-- Booking Info Banner -->
    @if(session('booking_info') || $hasBookingSession ?? false)
    <div class="container mt-4">
        <div class="alert alert-info alert-dismissible fade show">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-calendar-check me-2"></i>
                    @if(session('booking_info'))
                        {{ session('booking_info') }}
                    @elseif($hasBookingSession)
                        <strong>Booking Aktif:</strong> 
                        {{ $bookingData['kode_booking'] }} - 
                        {{ \Carbon\Carbon::parse($bookingData['tanggal_reservasi'])->format('d M Y') }} 
                        {{ $bookingData['waktu_reservasi'] }} -
                        {{ $bookingData['jumlah_orang'] }} orang
                    @endif
                </div>
                @if($hasBookingSession ?? false)
                <div>
                    <a href="{{ route('booking_tempat.payment', $bookingData['id']) }}" class="btn btn-sm btn-outline-info me-2">
                        <i class="fas fa-credit-card me-1"></i>Bayar DP
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-coffee text-white text-center">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-2x mb-2"></i>
                        <h5>Semua Menu</h5>
                        <p class="mb-0">{{ $menu->count() }} items tersedia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white text-center">
                    <div class="card-body">
                        <i class="fas fa-filter fa-2x mb-2"></i>
                        <h5>Kategori</h5>
                        <p class="mb-0">Filter by jenis</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white text-center">
                    <div class="card-body">
                        <i class="fas fa-search fa-2x mb-2"></i>
                        <h5>Cari Menu</h5>
                        <p class="mb-0">Temukan favorit Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Content -->
    <div class="container my-5">
        <!-- Search Box -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('menu.search') }}" method="GET" class="search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" placeholder="Cari menu..." value="{{ request('q') }}">
                                <button class="btn btn-coffee" type="submit">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Kategori -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-filter me-2"></i>Filter Kategori</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-coffee active" data-category="all">Semua</button>
                            <button type="button" class="btn btn-outline-coffee" data-category="Kopi">Kopi</button>
                            <button type="button" class="btn btn-outline-coffee" data-category="Makanan">Makanan</button>
                            <button type="button" class="btn btn-outline-coffee" data-category="Non-Kopi">Non-Kopi</button>
                        </div>
                        <div class="mt-2">
                            <small class="text-muted">
                                Menampilkan: 
                                <span id="current-category">Semua Menu</span> 
                                (<span id="item-count">{{ $menu->count() }}</span> items)
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Menu -->
        <div class="row" id="menu-container">
            @foreach($menu as $item)
            <div class="col-lg-4 col-md-6 mb-4 menu-item" data-category="{{ $item->kategori }}">
                <div class="card menu-card">
                    <div class="menu-image" style="background-image: url('{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}');">
                        <span class="badge category-badge 
                            @if($item->kategori == 'Kopi') bg-coffee
                            @elseif($item->kategori == 'Makanan') bg-success
                            @else bg-info @endif">
                            {{ $item->kategori }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_menu }}</h5>
                        <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="price-tag">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                            <span class="stok-info badge 
                                @if($item->stok > 10) bg-success
                                @elseif($item->stok > 0) bg-warning
                                @else bg-danger @endif">
                                Stok: {{ $item->stok }}
                            </span>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('menu.show', $item->id) }}" class="btn btn-outline-coffee btn-sm">
                                <i class="fas fa-info-circle me-1"></i>Detail
                            </a>
                            <button class="btn btn-coffee btn-sm add-to-cart" 
                                    data-menu-id="{{ $item->id }}" 
                                    data-menu-name="{{ $item->nama_menu }}" 
                                    data-menu-price="{{ $item->harga }}" 
                                    data-menu-stok="{{ $item->stok }}"
                                    @if($item->stok == 0) disabled @endif>
                                <i class="fas fa-cart-plus me-1"></i>
                                @if($item->stok == 0)
                                    Stok Habis
                                @else
                                    Tambah ke Pesanan
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($menu->count() == 0)
        <div class="text-center py-5">
            <i class="fas fa-coffee fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">Menu Tidak Tersedia</h4>
            <p class="text-muted">Silahkan coba lagi nanti</p>
        </div>
        @endif
    </div>

    <!-- Cart Button -->
    <div class="position-fixed bottom-0 end-0 m-4">
        <button class="btn btn-coffee btn-lg rounded-pill shadow" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
            <i class="fas fa-shopping-cart me-2"></i>
            <span class="badge bg-danger" id="cart-count">0</span>
        </button>
    </div>

    <!-- Shopping Cart Sidebar -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title"><i class="fas fa-shopping-cart me-2"></i>Keranjang Pesanan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div id="cart-items">
                <p class="text-muted text-center">Keranjang kosong</p>
            </div>
            <div class="mt-auto">
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total:</strong>
                    <strong id="cart-total">Rp 0</strong>
                </div>
                
                <!-- Info Session -->
                <div id="session-info" class="alert alert-info mb-3" style="display: none;">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        <span id="session-text">Anda memiliki booking aktif. Data akan terisi otomatis.</span>
                    </small>
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-coffee" onclick="checkout()" id="cart-action-btn" style="display: none;">
                        <i class="fas fa-shopping-bag me-2"></i>Checkout
                    </button>
                    <button class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
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
    <script>
        let cart = [];
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.disabled) return;
                
                const menuId = this.getAttribute('data-menu-id');
                const menuName = this.getAttribute('data-menu-name');
                const menuPrice = parseInt(this.getAttribute('data-menu-price'));
                const menuStok = parseInt(this.getAttribute('data-menu-stok'));
                
                console.log('Adding to cart:', { menuId, menuName, menuPrice, menuStok });
                
                // Check stok
                if (menuStok === 0) {
                    showToast('Stok habis!', 'warning');
                    return;
                }
                
                // Add to cart
                const existingItem = cart.find(item => item.id === menuId);
                if (existingItem) {
                    if (existingItem.quantity >= menuStok) {
                        showToast('Stok tidak mencukupi!', 'warning');
                        return;
                    }
                    existingItem.quantity++;
                } else {
                    cart.push({
                        id: menuId,
                        name: menuName,
                        price: menuPrice,
                        quantity: 1,
                        stok: menuStok
                    });
                }
                
                updateCart();
                showToast(menuName + ' ditambahkan ke keranjang!', 'success');
            });
        });

        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const cartCount = document.getElementById('cart-count');
            const actionBtn = document.getElementById('cart-action-btn');
            const sessionInfo = document.getElementById('session-info');
            
            console.log('Updating cart, items:', cart);
            
            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="text-muted text-center">Keranjang kosong</p>';
                cartTotal.textContent = 'Rp 0';
                cartCount.textContent = '0';
                if (actionBtn) actionBtn.style.display = 'none';
                if (sessionInfo) sessionInfo.style.display = 'none';
                
                // Clear localStorage when cart is empty
                localStorage.removeItem('menu_cart');
                return;
            }
            
            let total = 0;
            let itemsHTML = '';
            
            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;
                
                itemsHTML += `
                    <div class="card mb-2">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">${item.name}</h6>
                                    <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="cart-item-controls me-3">
                                        <button class="quantity-btn decrease-quantity" data-index="${index}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="quantity-display">${item.quantity}</span>
                                        <button class="quantity-btn increase-quantity" data-index="${index}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <span class="me-2 fw-bold">Rp ${subtotal.toLocaleString('id-ID')}</span>
                                    <button class="btn btn-sm btn-outline-danger remove-from-cart" data-index="${index}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            cartItems.innerHTML = itemsHTML;
            cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
            cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            if (actionBtn) {
                actionBtn.style.display = 'block';
                actionBtn.innerHTML = `<i class="fas fa-shopping-bag me-2"></i>Checkout (${cart.reduce((sum, item) => sum + item.quantity, 0)} items)`;
            }
            
            // Show session info if has booking session
            if (sessionInfo && {{ $hasBookingSession ? 'true' : 'false' }}) {
                sessionInfo.style.display = 'block';
            }
            
            // Add event listeners for quantity controls
            document.querySelectorAll('.increase-quantity').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    if (cart[index].quantity < cart[index].stok) {
                        cart[index].quantity++;
                        updateCart();
                        showToast(cart[index].name + ' ditambahkan', 'info');
                    } else {
                        showToast('Stok tidak mencukupi!', 'warning');
                    }
                });
            });
            
            document.querySelectorAll('.decrease-quantity').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    if (cart[index].quantity > 1) {
                        cart[index].quantity--;
                        updateCart();
                        showToast(cart[index].name + ' dikurangi', 'info');
                    } else {
                        const itemName = cart[index].name;
                        cart.splice(index, 1);
                        updateCart();
                        showToast(itemName + ' dihapus dari keranjang', 'warning');
                    }
                });
            });
            
            document.querySelectorAll('.remove-from-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    const itemName = cart[index].name;
                    cart.splice(index, 1);
                    updateCart();
                    showToast(itemName + ' dihapus dari keranjang', 'warning');
                });
            });

            // Save to localStorage after DOM updates
            setTimeout(() => {
                localStorage.setItem('menu_cart', JSON.stringify(cart));
                console.log('Cart saved to localStorage:', cart);
            }, 100);
        }

        // Checkout function - PERBAIKAN
        function checkout() {
            console.log('Checkout clicked, cart:', cart);
            
            if (cart.length === 0) {
                showToast('Keranjang kosong!', 'warning');
                return;
            }
            
            // Validasi stok sebelum checkout
            let valid = true;
            cart.forEach(item => {
                if (item.quantity > item.stok) {
                    showToast(`Stok ${item.name} tidak mencukupi!`, 'warning');
                    valid = false;
                }
            });
            
            if (!valid) return;
            
            // Simpan cart ke localStorage
            localStorage.setItem('menu_cart', JSON.stringify(cart));
            console.log('Cart saved to localStorage for checkout:', cart);
            
            // Redirect ke form booking
            window.location.href = "{{ route('booking.create') }}";
        }

        function showToast(message, type = 'info') {
            // Remove existing toasts
            document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());
            
            const toast = document.createElement('div');
            toast.className = `position-fixed top-0 end-0 m-3 alert alert-${type} alert-dismissible fade show custom-toast`;
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(toast);
            
            // Auto remove toast after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 3000);
        }

        // Filter kategori
        document.querySelectorAll('[data-category]').forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Update active button
                document.querySelectorAll('[data-category]').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Filter menu items
                let visibleCount = 0;
                document.querySelectorAll('.menu-item').forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Update counter
                document.getElementById('item-count').textContent = visibleCount;
                
                // Update category text
                const categoryText = category === 'all' ? 'Semua Menu' : 'Menu ' + category;
                document.getElementById('current-category').textContent = categoryText;
            });
        });

        // Initialize cart from localStorage
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing cart...');
            
            try {
                const savedCart = localStorage.getItem('menu_cart');
                console.log('Saved cart from localStorage:', savedCart);
                
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                    console.log('Parsed cart:', cart);
                    updateCart();
                }
            } catch (error) {
                console.error('Error loading cart from localStorage:', error);
                localStorage.removeItem('menu_cart');
                cart = [];
            }
        });
    </script>
</body>
</html>