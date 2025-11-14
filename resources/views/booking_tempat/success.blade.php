<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil - Kedai Kopi Premium

    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
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
        .success-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-left: 5px solid #28a745;
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
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card success-card">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        
                        <h2 class="text-success mb-3">Booking Berhasil!</h2>
                        <p class="lead mb-4">Reservasi tempat Anda telah berhasil dibuat</p>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5>Detail Reservasi</h5>
                                <div class="row text-start">
                                    <div class="col-md-6">
                                        <p><strong>Kode Booking:</strong><br>
                                        <span class="badge bg-primary fs-6">{{ $booking->kode_booking }}</span></p>
                                        <p><strong>Nama:</strong><br>{{ $booking->nama_pelanggan }}</p>
                                        <p><strong>Telepon:</strong><br>{{ $booking->no_telepon }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Tanggal:</strong><br>{{ \Carbon\Carbon::parse($booking->tanggal_reservasi)->format('d F Y') }}</p>
                                        <p><strong>Waktu:</strong><br>{{ $booking->waktu_reservasi }}</p>
                                        <p><strong>Jumlah Orang:</strong><br>{{ $booking->jumlah_orang }} orang</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi:</strong> Simpan kode booking untuk keperluan verifikasi. 
                            Anda akan menerima konfirmasi via WhatsApp.
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('booking_tempat.payment', $booking->id) }}" class="btn btn-success btn-lg me-md-2">
                                <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                            </a>
                            <a href="{{ route('booking_tempat.menu', $booking->id) }}" class="btn btn-coffee btn-lg">
                                <i class="fas fa-utensils me-2"></i>Pesan Menu
                            </a>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p>&copy; 2024 Kedai Kopi Premium. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>