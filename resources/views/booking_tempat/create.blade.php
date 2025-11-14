<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tempat - Kedai Kopi Premium</title>
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
            <h1 class="display-4 fw-bold">Reservasi Tempat</h1>
            <p class="lead">Pesan meja untuk tanggal dan waktu tertentu</p>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card booking-card">
                    <div class="card-header coffee-bg text-white">
                        <h4 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Form Reservasi Tempat</h4>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('booking_tempat.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan *</label>
                                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" 
                                           id="nama_pelanggan" name="nama_pelanggan" 
                                           value="{{ old('nama_pelanggan') }}" required>
                                    @error('nama_pelanggan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="no_telepon" class="form-label">No. Telepon *</label>
                                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" 
                                           id="no_telepon" name="no_telepon" 
                                           value="{{ old('no_telepon') }}" required>
                                    @error('no_telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi *</label>
                                    <input type="date" class="form-control @error('tanggal_reservasi') is-invalid @enderror" 
                                           id="tanggal_reservasi" name="tanggal_reservasi" 
                                           value="{{ old('tanggal_reservasi') }}" required>
                                    @error('tanggal_reservasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="waktu_reservasi" class="form-label">Waktu Reservasi *</label>
                                    <select class="form-select @error('waktu_reservasi') is-invalid @enderror" 
                                            id="waktu_reservasi" name="waktu_reservasi" required>
                                        <option value="">Pilih Waktu</option>
                                        <option value="08:00" {{ old('waktu_reservasi') == '08:00' ? 'selected' : '' }}>08:00</option>
                                        <option value="09:00" {{ old('waktu_reservasi') == '09:00' ? 'selected' : '' }}>09:00</option>
                                        <option value="10:00" {{ old('waktu_reservasi') == '10:00' ? 'selected' : '' }}>10:00</option>
                                        <option value="11:00" {{ old('waktu_reservasi') == '11:00' ? 'selected' : '' }}>11:00</option>
                                        <option value="12:00" {{ old('waktu_reservasi') == '12:00' ? 'selected' : '' }}>12:00</option>
                                        <option value="13:00" {{ old('waktu_reservasi') == '13:00' ? 'selected' : '' }}>13:00</option>
                                        <option value="14:00" {{ old('waktu_reservasi') == '14:00' ? 'selected' : '' }}>14:00</option>
                                        <option value="15:00" {{ old('waktu_reservasi') == '15:00' ? 'selected' : '' }}>15:00</option>
                                        <option value="16:00" {{ old('waktu_reservasi') == '16:00' ? 'selected' : '' }}>16:00</option>
                                        <option value="17:00" {{ old('waktu_reservasi') == '17:00' ? 'selected' : '' }}>17:00</option>
                                        <option value="18:00" {{ old('waktu_reservasi') == '18:00' ? 'selected' : '' }}>18:00</option>
                                        <option value="19:00" {{ old('waktu_reservasi') == '19:00' ? 'selected' : '' }}>19:00</option>
                                        <option value="20:00" {{ old('waktu_reservasi') == '20:00' ? 'selected' : '' }}>20:00</option>
                                    </select>
                                    @error('waktu_reservasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="jumlah_orang" class="form-label">Jumlah Orang *</label>
                                    <input type="number" class="form-control @error('jumlah_orang') is-invalid @enderror" 
                                           id="jumlah_orang" name="jumlah_orang" min="1" max="20"
                                           value="{{ old('jumlah_orang') }}" required>
                                    @error('jumlah_orang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-coffee btn-lg">
                                    <i class="fas fa-calendar-check me-2"></i>Buat Reservasi Tempat
                                </button>
                                <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-utensils me-2"></i>Pesan Menu Dulu
                                </a>
                            </div>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Booking form loaded, checking for cart...');
        
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
                        stokInfo.textContent = `Stok tidak cukup! Tersedia: ${stok}`;
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

        // Load cart dari localStorage jika ada
        function loadCartToForm() {
            try {
                const savedCart = localStorage.getItem('menu_cart');
                console.log('Loading cart from localStorage:', savedCart);
                
                if (savedCart) {
                    const cart = JSON.parse(savedCart);
                    console.log('Parsed cart data:', cart);
                    
                    if (cart.length > 0) {
                        // Clear existing items first (keep only one)
                        const existingItems = document.querySelectorAll('.pesanan-item');
                        for (let i = 1; i < existingItems.length; i++) {
                            existingItems[i].remove();
                        }
                        
                        // Reset index
                        pesananIndex = 0;
                        
                        // Load cart items to form
                        cart.forEach((item, index) => {
                            console.log('Loading item:', item);
                            
                            if (index > 0) {
                                // Tambah item baru untuk item kedua dan seterusnya
                                document.getElementById('tambah-pesanan').click();
                            }
                            
                            // Set nilai menu dan jumlah
                            const selects = document.querySelectorAll('.menu-select');
                            const jumlahInputs = document.querySelectorAll('.jumlah-input');
                            
                            if (selects[index] && jumlahInputs[index]) {
                                selects[index].value = item.id;
                                jumlahInputs[index].value = item.quantity;
                                
                                // Trigger update harga
                                setTimeout(() => {
                                    const event = new Event('change');
                                    selects[index].dispatchEvent(event);
                                }, 100);
                            }
                        });
                        
                        console.log('Cart loaded successfully to form');
                        
                        // Clear cart setelah dimuat ke form
                        setTimeout(() => {
                            localStorage.removeItem('menu_cart');
                            console.log('Cart cleared from localStorage');
                        }, 1000);
                    }
                }
            } catch (error) {
                console.error('Error loading cart to form:', error);
            }
        }

        // Panggil fungsi load cart
        loadCartToForm();
        
        // Initial update
        updateHarga();

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