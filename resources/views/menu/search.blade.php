<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Menu - Kedai Kopi Premium</title>
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
        .menu-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .menu-card:hover {
            transform: translateY(-5px);
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
                <a class="nav-link" href="{{ route('menu.index') }}">
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
            <h1 class="display-4 fw-bold">Hasil Pencarian</h1>
            <p class="lead">Menu yang sesuai dengan kata kunci Anda</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-search me-2"></i>Hasil Pencarian</h2>
                    <a href="{{ route('menu.index') }}" class="btn btn-outline-coffee">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Semua Menu
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('menu.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Cari menu..." value="{{ $keyword }}">
                        <button class="btn btn-coffee" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($menus->count() > 0)
            <div class="alert alert-info">
                Ditemukan <strong>{{ $menus->count() }}</strong> menu untuk kata kunci "<strong>{{ $keyword }}</strong>"
            </div>

            <div class="row">
                @foreach($menus as $menu)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card menu-card">
                        <div class="position-relative">
                            @if($menu->gambar)
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Default menu image" style="height: 200px; object-fit: cover;">
                            @endif
                            <span class="badge {{ $menu->stok > 0 ? 'bg-success' : 'bg-danger' }}" style="position: absolute; top: 10px; right: 10px;">
                                {{ $menu->stok > 0 ? 'Stok: ' . $menu->stok : 'Habis' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($menu->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-coffee mb-0">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h6>
                                @if($menu->stok > 0)
                                    <button class="btn btn-coffee btn-sm add-to-cart" data-menu-id="{{ $menu->id }}">
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
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Tidak Ditemukan</h3>
                <p class="text-muted">Tidak ada menu yang sesuai dengan kata kunci "<strong>{{ $keyword }}</strong>"</p>
                <div class="mt-3">
                    <a href="{{ route('menu.index') }}" class="btn btn-coffee me-2">
                        <i class="fas fa-utensils me-2"></i>Lihat Semua Menu
                    </a>
                    <a href="{{ route('menu.categories') }}" class="btn btn-outline-coffee">
                        <i class="fas fa-tags me-2"></i>Lihat Berdasarkan Kategori
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 Kedai Kopi Premium. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.getAttribute('data-menu-id');
                    
                    let cart = JSON.parse(localStorage.getItem('menu_cart') || '[]');
                    
                    const existingItem = cart.find(item => item.id == menuId);
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        const menuCard = this.closest('.card');
                        const menuName = menuCard.querySelector('.card-title').textContent;
                        const menuPrice = menuCard.querySelector('.text-coffee').textContent;
                        
                        cart.push({
                            id: menuId,
                            name: menuName,
                            price: menuPrice,
                            quantity: 1
                        });
                    }
                    
                    localStorage.setItem('menu_cart', JSON.stringify(cart));
                    alert('Menu berhasil ditambahkan ke keranjang!');
                });
            });
        });
    </script>
</body>
</html>