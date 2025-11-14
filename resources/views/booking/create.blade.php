<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Meja - Kedai Kopi Premium</title>
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
            transition: transform 0.3s ease;
        }
        .booking-card:hover {
            transform: translateY(-5px);
        }
        .text-coffee {
            color: #8B4513;
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
            <h1 class="display-4 fw-bold">Booking Menu</h1>
            <p class="lead">Pesan meja dan menu favorit Anda dengan mudah</p>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card booking-card">
                    <div class="card-header coffee-bg text-white">
                        <h4 class="mb-0"><i class="fas fa-utensils me-2"></i>Form Pemesanan</h4>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- TAMBAH INI: Info Booking Session -->
                        @if($isFromBookingSession ?? false)
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

                        <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan *</label>
                                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                           id="nama_pelanggan" name="nama_pelanggan" 
                                           value="{{ $isFromBookingSession ? $bookingData['nama_pelanggan'] : old('nama_pelanggan') }}" 
                                           {{ $isFromBookingSession ? 'readonly' : '' }} required>
                                    @error('nama_pelanggan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($isFromBookingSession)
                                    <small class="text-muted">Nama sudah terisi dari data booking tempat</small>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_meja" class="form-label">Nomor Meja/Kode Booking *</label>
                                    <input type="text" class="form-control @error('nomor_meja') is-invalid @enderror" 
                                           id="nomor_meja" name="nomor_meja" 
                                           value="{{ $isFromBookingSession ? $bookingData['kode_booking'] : old('nomor_meja') }}" 
                                           {{ $isFromBookingSession ? 'readonly' : '' }} required>
                                    @error('nomor_meja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($isFromBookingSession)
                                    <small class="text-muted">Kode booking sudah terisi otomatis</small>
                                    @endif
                                </div>
                            </div>

<!-- Pesanan Section -->
<div class="mb-4">
    <h5 class="mb-3"><i class="fas fa-list me-2"></i>Pilih Pesanan</h5>
    
    <div id="pesanan-container">
        <!-- Item pesanan pertama -->
        <div class="pesanan-item border p-3 mb-3 rounded">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Menu</label>
                    <select class="form-select menu-select" name="pesanan[0][menu_id]" required onchange="updateHarga()">
                        <option value="">Pilih Menu</option>
                        @foreach($menu as $item)
                            <option value="{{ $item->id }}" 
                                    data-harga="{{ $item->harga }}"
                                    data-stok="{{ $item->stok }}"
                                    data-nama="{{ $item->nama_menu }}">
                                {{ $item->nama_menu }} - Rp {{ number_format($item->harga, 0, ',', '.') }} (Stok: {{ $item->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control jumlah-input" 
                           name="pesanan[0][jumlah]" min="1" value="1" required oninput="updateHarga()">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-item" style="display: none;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <small class="text-muted stok-info">Stok tersedia: -</small>
                    <br>
                    <small class="text-muted subtotal-info">Subtotal: Rp 0</small>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-outline-coffee btn-sm" id="tambah-pesanan">
        <i class="fas fa-plus me-1"></i>Tambah Pesanan Lain
    </button>
</div>

                            <!-- Metode Bayar -->
                            <div class="mb-4">
                                <h5 class="mb-3"><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="radio" name="metode_bayar" 
                                                   id="cash" value="cash" checked>
                                            <label class="form-check-label" for="cash">
                                                <i class="fas fa-money-bill-wave me-2"></i>Cash (Bayar di Kasir)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="metode_bayar" 
                                                   id="dana" value="dana">
                                            <label class="form-check-label" for="dana">
                                                <i class="fas fa-mobile-alt me-2" style="color: #00a0e9;"></i>DANA (Bayar Sekarang)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Total Pembayaran</h6>
                                                <h4 class="text-coffee" id="total-harga">Rp 0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-coffee btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    @if($isFromBookingSession)
                                        Pesan Menu untuk Booking Tempat
                                    @else
                                        Proses Booking
                                    @endif
                                </button>
                                <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list me-2"></i>Lihat Semua Booking
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pembayaran DANA -->
<div class="modal fade" id="danaModal" tabindex="-1" aria-labelledby="danaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="danaModalLabel">
                    <i class="fas fa-mobile-alt me-2" style="color: #00a0e9;"></i>Pembayaran DANA
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6>Total Pembayaran</h6>
                                <h3 class="text-coffee" id="dana-total-harga">Rp 0</h3>
                                <div class="mt-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" 
                                         alt="DANA" style="height: 40px;" class="mb-2">
                                    <p class="small text-muted mb-1">Bayar dengan DANA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Instruksi Pembayaran:</h6>
                        <ol class="small">
                            <li>Buka aplikasi DANA di smartphone Anda</li>
                            <li>Pilih menu <strong>Bayar</strong></li>
                            <li>Scan QR code di samping</li>
                            <li>Konfirmasi pembayaran</li>
                            <li>Tunggu konfirmasi otomatis</li>
                        </ol>
                        
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle me-2"></i>
                            Pembayaran akan diverifikasi otomatis dalam 1-2 menit
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <div class="bg-light p-3 rounded d-inline-block">
                        <!-- QR Code Placeholder -->
                        <div id="qrcode-container" class="text-center">
                            <div class="bg-white p-2 rounded border d-inline-block">
                                <div id="dana-qrcode" style="width: 200px; height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border: 1px dashed #dee2e6;">
                                    <span class="text-muted">QR Code akan muncul setelah konfirmasi</span>
                                </div>
                            </div>
                        </div>
                        <p class="small text-muted mt-2">Scan QR code dengan aplikasi DANA</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-coffee" id="confirmDanaPayment">
                    <i class="fas fa-check me-2"></i>Konfirmasi Pembayaran
                </button>
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
    document.addEventListener('DOMContentLoaded', function() {
    let pesananIndex = 0;
    const pesananContainer = document.getElementById('pesanan-container');
    const totalHargaElement = document.getElementById('total-harga');
    const danaTotalHargaElement = document.getElementById('dana-total-harga');
    let totalHarga = 0;

    // Fungsi untuk update harga total
    function updateHarga() {
        totalHarga = 0;
        
        document.querySelectorAll('.pesanan-item').forEach((item, index) => {
            const select = item.querySelector('.menu-select');
            const jumlahInput = item.querySelector('.jumlah-input');
            const stokInfo = item.querySelector('.stok-info');
            const subtotalInfo = item.querySelector('.subtotal-info');
            
            if (select.value && jumlahInput.value) {
                const harga = parseInt(select.selectedOptions[0].getAttribute('data-harga'));
                const stok = parseInt(select.selectedOptions[0].getAttribute('data-stok'));
                const jumlah = parseInt(jumlahInput.value);
                const subtotal = harga * jumlah;
                
                totalHarga += subtotal;
                
                // Update info stok dan subtotal
                stokInfo.textContent = `Stok tersedia: ${stok}`;
                subtotalInfo.textContent = `Subtotal: Rp ${subtotal.toLocaleString('id-ID')}`;
                
                // Validasi stok
                if (jumlah > stok) {
                    jumlahInput.classList.add('is-invalid');
                    stokInfo.classList.add('text-danger');
                } else {
                    jumlahInput.classList.remove('is-invalid');
                    stokInfo.classList.remove('text-danger');
                }
            } else {
                stokInfo.textContent = `Stok tersedia: -`;
                subtotalInfo.textContent = `Subtotal: Rp 0`;
            }
        });
        
        totalHargaElement.textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
        danaTotalHargaElement.textContent = `Rp ${totalHarga.toLocaleString('id-ID')}`;
    }

    // Tambah pesanan baru
    document.getElementById('tambah-pesanan').addEventListener('click', function() {
        pesananIndex++;
        const newItem = document.createElement('div');
        newItem.className = 'pesanan-item border p-3 mb-3 rounded';
        newItem.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Menu</label>
                    <select class="form-select menu-select" name="pesanan[${pesananIndex}][menu_id]" required onchange="updateHarga()">
                        <option value="">Pilih Menu</option>
                        @foreach($menu as $item)
                            <option value="{{ $item->id }}" 
                                    data-harga="{{ $item->harga }}"
                                    data-stok="{{ $item->stok }}"
                                    data-nama="{{ $item->nama_menu }}">
                                {{ $item->nama_menu }} - Rp {{ number_format($item->harga, 0, ',', '.') }} (Stok: {{ $item->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control jumlah-input" 
                           name="pesanan[${pesananIndex}][jumlah]" min="1" value="1" required oninput="updateHarga()">
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-item">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <small class="text-muted stok-info">Stok tersedia: -</small>
                    <br>
                    <small class="text-muted subtotal-info">Subtotal: Rp 0</small>
                </div>
            </div>
        `;
        
        pesananContainer.appendChild(newItem);
        
        // Tampilkan tombol hapus untuk semua item
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.style.display = 'block';
        });
        
        updateHarga();
    });

    // Hapus pesanan
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
            const btn = e.target.classList.contains('remove-item') ? e.target : e.target.closest('.remove-item');
            const item = btn.closest('.pesanan-item');
            
            // Jangan hapus jika hanya ada 1 item
            if (document.querySelectorAll('.pesanan-item').length > 1) {
                item.remove();
                updateHarga();
            } else {
                alert('Minimal harus ada 1 pesanan!');
            }
        }
    });

    // Handle form submission untuk DANA
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        const metodeBayar = document.querySelector('input[name="metode_bayar"]:checked').value;
        
        if (metodeBayar === 'dana') {
            e.preventDefault();
            
            // Validasi form sebelum menampilkan modal DANA
            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }
            
            // Tampilkan modal DANA
            const danaModal = new bootstrap.Modal(document.getElementById('danaModal'));
            danaModal.show();
        }
    });

    // Konfirmasi pembayaran DANA
    document.getElementById('confirmDanaPayment').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        
        // Simulasi proses pembayaran
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        btn.disabled = true;
        
        // Simulasi delay pembayaran
        setTimeout(function() {
            // Generate QR code placeholder
            const qrContainer = document.getElementById('dana-qrcode');
            qrContainer.innerHTML = `
                <div class="text-center">
                    <div class="bg-white p-3">
                        <div style="width: 150px; height: 150px; background: #000; margin: 0 auto;"></div>
                        <small class="text-muted mt-2">Simulasi QR Code DANA</small>
                    </div>
                </div>
            `;
            
            // Simulasi pembayaran berhasil setelah 3 detik
            setTimeout(function() {
                // Submit form asli setelah pembayaran "berhasil"
                document.getElementById('bookingForm').submit();
            }, 3000);
            
        }, 1000);
    });

    // Load cart dari localStorage jika ada
    const savedCart = localStorage.getItem('menu_cart');
    if (savedCart) {
        const cart = JSON.parse(savedCart);
        console.log('Cart loaded from localStorage:', cart);
        
        // Isi form dengan data dari cart
        cart.forEach((item, index) => {
            if (index > 0) {
                // Tambah item baru untuk item kedua dan seterusnya
                document.getElementById('tambah-pesanan').click();
            }
            
            // Set nilai menu dan jumlah
            const select = document.querySelectorAll('.menu-select')[index];
            const jumlahInput = document.querySelectorAll('.jumlah-input')[index];
            
            if (select) {
                select.value = item.id;
                jumlahInput.value = item.quantity;
                
                // Trigger update harga
                const event = new Event('change');
                select.dispatchEvent(event);
            }
        });
        
        // Clear cart setelah dimuat ke form
        localStorage.removeItem('menu_cart');
        console.log('Cart cleared from localStorage after loading to form');
    }
    
    // Initial update
    updateHarga();

    // Handle perubahan metode bayar
    document.querySelectorAll('input[name="metode_bayar"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const submitBtn = document.querySelector('button[type="submit"]');
            if (this.value === 'dana') {
                submitBtn.innerHTML = '<i class="fas fa-mobile-alt me-2"></i>Bayar dengan DANA';
            } else {
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>' + 
                    (@if($isFromBookingSession) 'Pesan Menu untuk Booking Tempat' @else 'Proses Booking' @endif);
            }
        });
    });
});
</script>
</body>
</html>