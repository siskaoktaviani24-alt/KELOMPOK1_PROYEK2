<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking Tempat - Kedai Kopi Premium</title>
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
        .booking-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .booking-card:hover {
            transform: translateY(-5px);
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
        .stats-card {
            border: none;
            border-radius: 10px;
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        .stats-card.pending { background: linear-gradient(135deg, #ffc107, #e0a800); }
        .stats-card.confirmed { background: linear-gradient(135deg, #28a745, #20c997); }
        .stats-card.cancelled { background: linear-gradient(135deg, #dc3545, #c82333); }
        .stats-card.total { background: linear-gradient(135deg, #007bff, #0056b3); }
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
            <h1 class="display-4 fw-bold">Daftar Booking Tempat</h1>
            <p class="lead">Kelola reservasi tempat kedai kopi</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card total">
                    <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                    <h4>{{ $bookingTempat->count() }}</h4>
                    <p class="mb-0">Total Booking</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card pending">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h4>{{ $bookingTempat->where('status', 'pending')->count() }}</h4>
                    <p class="mb-0">Pending</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card confirmed">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h4>{{ $bookingTempat->where('status', 'dikonfirmasi')->count() }}</h4>
                    <p class="mb-0">Dikonfirmasi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card cancelled">
                    <i class="fas fa-times-circle fa-2x mb-2"></i>
                    <h4>{{ $bookingTempat->where('status', 'dibatalkan')->count() }}</h4>
                    <p class="mb-0">Dibatalkan</p>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-calendar-alt me-2"></i>Semua Booking Tempat</h2>
                    <a href="{{ route('booking_tempat.create') }}" class="btn btn-coffee">
                        <i class="fas fa-plus me-2"></i>Booking Tempat Baru
                    </a>
                </div>
            </div>
        </div>

        @if($bookingTempat->count() > 0)
            <div class="row">
                @foreach($bookingTempat as $booking)
                <div class="col-md-6 col-lg-4">
                    <div class="card booking-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fas fa-tag me-1"></i>{{ $booking->kode_booking }}
                            </h6>
                            <span class="badge 
                                @if($booking->status == 'dikonfirmasi') bg-success
                                @elseif($booking->status == 'dibatalkan') bg-danger
                                @else bg-warning @endif status-badge">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong><i class="fas fa-user me-2"></i>{{ $booking->nama_pelanggan }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-phone me-1"></i>{{ $booking->no_telepon }}
                                </small>
                            </div>
                            
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Tanggal</small><br>
                                        <strong>{{ \Carbon\Carbon::parse($booking->tanggal_reservasi)->format('d M Y') }}</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Waktu</small><br>
                                        <strong>{{ $booking->waktu_reservasi }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Jumlah Orang</small><br>
                                <strong>{{ $booking->jumlah_orang }} orang</strong>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('booking_tempat.success', $booking->id) }}" class="btn btn-outline-coffee btn-sm">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                                
                                @if($booking->status == 'pending')
                                <div class="btn-group" role="group">
                                    <form action="{{ route('booking_tempat.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dikonfirmasi">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check me-1"></i>Konfirmasi
                                        </button>
                                    </form>
                                    <form action="{{ route('booking_tempat.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="dibatalkan">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>
                                <i class="fas fa-clock me-1"></i>
                                Dibuat: {{ $booking->created_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Booking Summary -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Ringkasan Booking</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Booking Hari Ini:</strong>
                                    {{ $bookingTempat->where('tanggal_reservasi', \Carbon\Carbon::today())->count() }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Rata-rata Jumlah Orang:</strong>
                                    {{ number_format($bookingTempat->avg('jumlah_orang'), 1) }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Total Kapasitas:</strong>
                                    {{ $bookingTempat->sum('jumlah_orang') }} orang
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Belum Ada Booking Tempat</h3>
                <p class="text-muted">Mulai dengan membuat booking tempat pertama Anda</p>
                <a href="{{ route('booking_tempat.create') }}" class="btn btn-coffee btn-lg">
                    <i class="fas fa-plus me-2"></i>Booking Tempat Baru
                </a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 Kedai Kopi Premium. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto refresh setiap 60 detik untuk update status
        setTimeout(function() {
            window.location.reload();
        }, 60000);

        // Confirmation for status changes
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const status = this.querySelector('input[name="status"]').value;
                    const action = status === 'dikonfirmasi' ? 'mengkonfirmasi' : 'membatalkan';
                    
                    if (!confirm(`Apakah Anda yakin ingin ${action} booking ini?`)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>