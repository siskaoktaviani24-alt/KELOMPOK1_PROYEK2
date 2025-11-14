<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan - Kedai Kopi Premium</title>
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
        .status-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }
        .status-card:hover {
            transform: translateY(-5px);
        }
        .progress-bar-custom {
            height: 8px;
            border-radius: 4px;
        }
        .time-estimate {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .order-timeline {
            position: relative;
            padding-left: 30px;
        }
        .order-timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #8B4513;
            border: 2px solid white;
        }
        .timeline-item.active::before {
            background: #28a745;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
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

    
    <div class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Status Pesanan Anda</h1>
            <p class="lead">Lacak pesanan dan perkiraan waktu penyajian</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-clock me-2"></i>Pesanan Aktif</h2>
                    <a href="{{ route('booking.create') }}" class="btn btn-coffee">
                        <i class="fas fa-plus me-2"></i>Pesan Baru
                    </a>
                </div>
            </div>
        </div>

        @if($bookings->count() > 0)
            @foreach($bookings as $item)
            <div class="card status-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Pesanan #{{ $item->id }}</h5>
                        <small class="text-muted">Meja: {{ $item->nomor_meja }}</small>
                    </div>
                    <div class="text-end">
                        <span class="badge 
                            @if($item->status == 'selesai') bg-success
                            @elseif($item->status == 'dibatalkan') bg-danger
                            @else bg-warning @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                        <div class="time-estimate mt-1">
                            <i class="fas fa-clock me-1"></i>
                            @if($item->status == 'pending')
                                Estimasi: 15-20 menit
                            @elseif($item->status == 'selesai')
                                Selesai
                            @else
                                Dibatalkan
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Detail Pesanan:</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($item->pesanan as $pesanan)
                                        <tr>
                                            <td>{{ $pesanan['nama_menu'] }}</td>
                                            <td>{{ $pesanan['jumlah'] }}</td> 
                                            <td>Rp {{ number_format($pesanan['subtotal'], 0, ',', '.') }}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-dark">
                                            <td colspan="2" class="fw-bold">Total</td>
                                            <td class="fw-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h6>Status Penyajian:</h6>
                            <div class="order-timeline">
                                @php
                                    $steps = [
                                        'pending' => ['Menunggu Konfirmasi', 'active'],
                                        'diproses' => ['Sedang Disiapkan', $item->status == 'selesai' || $item->status == 'diproses' ? 'active' : ''],
                                        'selesai' => ['Siap Disajikan', $item->status == 'selesai' ? 'active' : '']
                                    ];
                                @endphp
                                
                                @foreach($steps as $step => $stepData)
                                <div class="timeline-item {{ $stepData[1] }}">
                                    <h6 class="mb-1">{{ $stepData[0] }}</h6>
                                    <p class="mb-0 text-muted small">
                                        @if($stepData[1] == 'active')
                                            <i class="fas fa-spinner fa-spin text-success me-1"></i>
                                            Sedang berlangsung
                                        @elseif($item->status == 'selesai' && $step == 'selesai')
                                            <i class="fas fa-check text-success me-1"></i>
                                            Selesai
                                        @else
                                            <i class="fas fa-clock me-1"></i>
                                            Menunggu
                                        @endif
                                    </p>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small>Progress</small>
                                    <small>
                                        @if($item->status == 'pending') 33%
                                        @elseif($item->status == 'diproses') 66%
                                        @elseif($item->status == 'selesai') 100%
                                        @else 0%
                                        @endif
                                    </small>
                                </div>
                                <div class="progress progress-bar-custom">
                                    <div class="progress-bar 
                                        @if($item->status == 'pending') bg-warning
                                        @elseif($item->status == 'diproses') bg-info
                                        @elseif($item->status == 'selesai') bg-success
                                        @else bg-danger @endif" 
                                        role="progressbar" 
                                        style="width: 
                                        @if($item->status == 'pending') 33%
                                        @elseif($item->status == 'diproses') 66%
                                        @elseif($item->status == 'selesai') 100%
                                        @else 0% @endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-user me-1"></i>
                                Atas nama: <strong>{{ $item->nama_pelanggan }}</strong>
                            </small>
                        </div>
                        <div class="col-md-6 text-end">
                            <small class="text-muted">
                                <i class="fas fa-credit-card me-1"></i>
                                Pembayaran: <span class="text-capitalize">{{ $item->metode_bayar }}</span>
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Dipesan: {{ $item->created_at->format('d M Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <i class="fas fa-coffee fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">Belum Ada Pesanan</h3>
                <p class="text-muted">Yuk pesan kopi dan makanan favorit Anda!</p>
                <a href="{{ route('booking.create') }}" class="btn btn-coffee btn-lg">
                    <i class="fas fa-utensils me-2"></i>Pesan Sekarang
                </a>
            </div>
        @endif

        <!-- Info Kedai -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                        <p class="mb-2">
                            <i class="fas fa-clock me-1"></i>
                            <strong>Estimasi Waktu Penyajian:</strong>
                        </p>
                        <div class="row">
                            <div class="col-md-4">
                                <small>☕ Kopi: 5-10 menit</small>
                            </div>
                            <div class="col-md-4">
                                <small>🥐 Makanan Ringan: 8-12 menit</small>
                            </div>
                            <div class="col-md-4">
                                <small>🥪 Makanan Berat: 12-18 menit</small>
                            </div>
                        </div>
                    </div>
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
        // Auto refresh setiap 30 detik untuk update status
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
</body>
</html>