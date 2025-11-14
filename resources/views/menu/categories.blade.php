<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Menu - Kedai Kopi Premium</title>
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
        .category-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .text-coffee {
            color: #8B4513;
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
            <h1 class="display-4 fw-bold">Kategori Menu</h1>
            <p class="lead">Temukan menu favorit Anda berdasarkan kategori</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-tags me-2"></i>Kategori Menu</h2>
                    <a href="{{ route('menu.index') }}" class="btn btn-outline-coffee">
                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Semua Menu
                    </a>
                </div>
            </div>
        </div>

        @if(count($categories) > 0)
            @foreach($categories as $kategori => $menus)
            <div class="card category-card mb-4">
                <div class="card-header coffee-bg text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-tag me-2"></i>{{ $kategori ?: 'Lainnya' }}
                        <span class="badge bg-light text-coffee ms-2">{{ $menus->count() }} menu</span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($menus as $menu)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <div class="card h-100">
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Default menu image" style="height: 150px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ $menu->nama_menu }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($menu->deskripsi, 50) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-coffee fw-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                        @if($menu->stok > 0)
                                            <span class="badge bg-success">Stok: {{ $menu->stok }}</span>
                                        @else
                                            <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Tidak Ada Kategori</h3>
                <p class="text-muted">Belum ada menu yang terkategori.</p>
                <a href="{{ route('menu.index') }}" class="btn btn-coffee">
                    <i class="fas fa-utensils me-2"></i>Lihat Semua Menu
                </a>
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
</body>
</html>