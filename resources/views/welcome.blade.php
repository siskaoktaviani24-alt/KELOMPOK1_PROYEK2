<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Kopi Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
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
        .text-coffee {
            color: #8B4513 !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #8B4513;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-coffee me-2"></i>
                Kedai Kopi Premium
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang</h1>
            <p class="lead">Sistem Management Kedai Kopi Premium</p>
            <div class="mt-4">
                <!-- PERBAIKAN: Ganti route('login') menjadi url('/login') -->
                <a href="{{ url('/login') }}" class="btn btn-coffee btn-lg me-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Login Admin
                </a>
                <a href="{{ url('/menu') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-home me-2"></i>Lihat Website
                </a>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-coffee fa-3x text-coffee mb-3"></i>
                <h4>Kopi Berkualitas</h4>
                <p class="text-muted">Racikan kopi terbaik dengan bahan premium</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-utensils fa-3x text-coffee mb-3"></i>
                <h4>Menu Lengkap</h4>
                <p class="text-muted">Berbagai pilihan makanan dan minuman</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-calendar-alt fa-3x text-coffee mb-3"></i>
                <h4>Reservasi Mudah</h4>
                <p class="text-muted">Booking tempat dengan sistem online</p>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2024 Kedai Kopi Premium. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>