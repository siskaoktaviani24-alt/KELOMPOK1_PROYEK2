<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Kedai Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #8B4513;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            margin: 2px 0;
        }
        .sidebar .nav-link:hover {
            background-color: #654321;
        }
        .sidebar .nav-link.active {
            background-color: #654321;
            font-weight: bold;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .bg-coffee { background-color: #8B4513 !important; }
        .btn-coffee {
            background-color: #8B4513;
            color: white;
            border: none;
        }
        .btn-coffee:hover {
            background-color: #654321;
            color: white;
        }
        .stat-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <i class="fas fa-coffee me-2"></i>
                            Admin Panel
                        </h4>
                        <p class="text-white-50 small">Kedai Kopi Premium</p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}" 
                               href="{{ route('admin.menu.index') }}">
                                <i class="fas fa-utensils me-2"></i>
                                Menu Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.meja.*') ? 'active' : '' }}" 
                               href="{{ route('admin.meja.index') }}">
                                <i class="fas fa-chair me-2"></i>
                                Meja Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.booking-tempat.*') ? 'active' : '' }}" 
                               href="{{ route('admin.booking-tempat.index') }}">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Booking Tempat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}" 
                               href="{{ route('admin.booking.index') }}">
                                <i class="fas fa-list me-2"></i>
                                Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}" 
                               href="{{ route('admin.reports') }}">
                                <i class="fas fa-chart-bar me-2"></i>
                                Laporan
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="/">
                                <i class="fas fa-home me-2"></i>
                                Kembali ke Website
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link text-start w-100" style="background: none; border: none;">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>