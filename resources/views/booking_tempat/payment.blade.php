<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Kedai Kopi Premium</title>
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
        .payment-card {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
                <div class="card payment-card">
                    <div class="card-header coffee-bg text-white">
                        <h4 class="mb-0"><i class="fas fa-credit-card me-2"></i>Pembayaran Booking Tempat</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Pembayaran untuk mengkonfirmasi reservasi tempat Anda.
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Detail Booking:</h6>
                                <p><strong>Kode:</strong> {{ $booking->kode_booking }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_reservasi)->format('d F Y') }}</p>
                                <p><strong>Waktu:</strong> {{ $booking->waktu_reservasi }}</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h4 class="text-coffee">Rp 50.000</h4>
                                <small class="text-muted">DP (Down Payment)</small>
                            </div>
                        </div>

                        <!-- Tambahkan form pembayaran DANA di sini (sama seperti sebelumnya) -->
                        <div class="border rounded p-4 mb-4" style="border-color: #00a0e9 !important; background: linear-gradient(135deg, #00a0e9, #0088cc); color: white;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span style="font-size: 2rem; font-weight: bold;">
                                            <i class="fas fa-mobile-alt me-2"></i>DANA
                                        </span>
                                    </div>
                                    <h5>Scan QR Code untuk Bayar</h5>
                                    <p>Total: <strong>Rp 50.000</strong></p>
                                    
                                    <div class="bg-white p-3 rounded d-inline-block">
                                        <!-- QR Code Tiruan -->
                                        <div style="width: 200px; height: 200px; background: #f8f9fa; border: 2px dashed #00a0e9; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                            <div style="font-size: 3rem; color: #00a0e9;">📱</div>
                                            <div style="text-align: center; color: #333; font-size: 0.8rem; margin-top: 10px;">
                                                <strong>QR CODE DANA</strong><br>
                                                Scan dengan Aplikasi DANA
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Cara Pembayaran:</h6>
                                    <ol>
                                        <li>Buka aplikasi DANA di smartphone</li>
                                        <li>Pilih fitur "Scan QR"</li>
                                        <li>Arahkan kamera ke QR code</li>
                                        <li>Konfirmasi pembayaran Rp 50.000</li>
                                        <li>Tunggu notifikasi konfirmasi</li>
                                    </ol>
                                    
                                    <div class="alert alert-light mt-3">
                                        <small>
                                            <i class="fas fa-lightbulb me-1"></i>
                                            <strong>Tips:</strong> Pembayaran akan mengkonfirmasi reservasi Anda.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-success btn-lg" onclick="simulatePayment()">
                                <i class="fas fa-check me-2"></i>Simulasikan Pembayaran Berhasil
                            </button>
                            <a href="{{ route('booking_tempat.menu', $booking->id) }}" class="btn btn-outline-coffee">
                                <i class="fas fa-utensils me-2"></i>Pesan Menu Dulu
                            </a>
                            <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">
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
    <script>
        function simulatePayment() {
            alert('Pembayaran berhasil! Reservasi Anda telah dikonfirmasi.');
            window.location.href = "{{ route('booking.index') }}";
        }
    </script>
</body>
</html>