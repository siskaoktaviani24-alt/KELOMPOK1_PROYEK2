@extends('layouts.main')

@section('title', $title)

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center text-white py-5"
    style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
           url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1170&q=80');
           background-size: cover; background-position: center;">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang di Kedai Kopi Nusantara</h1>
        <p class="lead">Racikan kopi terbaik dengan cita rasa autentik Indonesia</p>
        <a href="#menu" class="btn btn-primary btn-lg mt-3">
            Lihat Menu <i class="fas fa-arrow-down ms-2"></i>
        </a>
    </div>
</section>

<!-- Menu Section -->
<section id="menu" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Menu Kami</h2>
            <p class="text-muted">Pilih dari berbagai varian kopi dan makanan pendamping</p>
        </div>

        <!-- Category Filter -->
        <ul class="nav nav-pills justify-content-center mb-4" id="categoryFilter">
            <li class="nav-item"><a class="nav-link active" href="#" data-category="all">Semua</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="kopi">Kopi</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="non-kopi">Non-Kopi</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="makanan">Makanan</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-category="snack">Snack</a></li>
        </ul>

        <!-- Menu Items -->
        <div class="row" id="menuItems">
            @php
                $menus = [
                    ['nama' => 'Espresso', 'harga' => 'Rp 25.000', 'kategori' => 'kopi', 'img' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=687&q=80', 'badge' => 'Hot'],
                    ['nama' => 'Iced Latte', 'harga' => 'Rp 30.000', 'kategori' => 'kopi', 'img' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=1169&q=80', 'badge' => 'Iced'],
                    ['nama' => 'Matcha Latte', 'harga' => 'Rp 28.000', 'kategori' => 'non-kopi', 'img' => 'https://images.unsplash.com/photo-1597481499750-3e11b15e0c0f?auto=format&fit=crop&w=1170&q=80'],
                    ['nama' => 'Croissant', 'harga' => 'Rp 18.000', 'kategori' => 'makanan', 'img' => 'https://images.unsplash.com/photo-1555507036-ab794f27d2e9?auto=format&fit=crop&w=1170&q=80'],
                    ['nama' => 'Cappuccino', 'harga' => 'Rp 28.000', 'kategori' => 'kopi', 'img' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&w=735&q=80', 'badge' => 'Hot'],
                    ['nama' => 'Chocolate Frappe', 'harga' => 'Rp 32.000', 'kategori' => 'non-kopi', 'img' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?auto=format&fit=crop&w=735&q=80', 'badge' => 'Iced'],
                    ['nama' => 'Chocolate Chip Cookie', 'harga' => 'Rp 15.000', 'kategori' => 'snack', 'img' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?auto=format&fit=crop&w=765&q=80'],
                    ['nama' => 'Club Sandwich', 'harga' => 'Rp 35.000', 'kategori' => 'makanan', 'img' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?auto=format&fit=crop&w=781&q=80']
                ];
            @endphp

            @foreach ($menus as $menu)
            <div class="col-lg-3 col-md-6 mb-4" data-category="{{ $menu['kategori'] }}">
                <div class="card menu-card h-100 border-0 shadow-sm">
                    @if (isset($menu['badge']))
                        <span class="badge bg-warning position-absolute top-0 end-0 m-2">{{ $menu['badge'] }}</span>
                    @endif
                    <img src="{{ $menu['img'] }}" class="card-img-top menu-image" alt="{{ $menu['nama'] }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $menu['nama'] }}</h5>
                        <p class="card-text flex-grow-1 text-muted">Nikmati cita rasa {{ strtolower($menu['nama']) }} terbaik kami.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="price fw-bold text-warning">{{ $menu['harga'] }}</span>
                            <div class="quantity-controls">
                                <button class="btn btn-sm btn-outline-secondary quantity-btn me-2">-</button>
                                <span class="mx-2">1</span>
                                <button class="btn btn-sm btn-outline-secondary quantity-btn ms-2">+</button>
                            </div>
                            <button class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Order Guide Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <h3 class="mb-5 fw-bold">Cara Memesan</h3>
            <div class="col-md-3 mb-4">
                <i class="fas fa-list fa-3x text-primary mb-3"></i>
                <h5>Pilih Menu</h5>
                <p class="text-muted">Pilih menu favorit dari berbagai pilihan kami.</p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fas fa-cart-plus fa-3x text-primary mb-3"></i>
                <h5>Tambahkan ke Keranjang</h5>
                <p class="text-muted">Atur jumlah pesanan sesuai keinginan Anda.</p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fas fa-cash-register fa-3x text-primary mb-3"></i>
                <h5>Checkout</h5>
                <p class="text-muted">Lakukan pembayaran dan konfirmasi pesanan.</p>
            </div>
            <div class="col-md-3 mb-4">
                <i class="fas fa-coffee fa-3x text-primary mb-3"></i>
                <h5>Tunggu & Nikmati</h5>
                <p class="text-muted">Pesanan Anda siap dinikmati!</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryLinks = document.querySelectorAll('#categoryFilter .nav-link');
    const menuItems = document.querySelectorAll('#menuItems .col-lg-3');

    categoryLinks.forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            categoryLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            const category = link.getAttribute('data-category');
            menuItems.forEach(item => {
                item.style.display = (category === 'all' || item.dataset.category === category) ? 'block' : 'none';
            });
        });
    });

    // Quantity controls
    document.querySelectorAll('.quantity-controls').forEach(control => {
        const minus = control.querySelector('.quantity-btn:first-child');
        const plus = control.querySelector('.quantity-btn:last-child');
        const quantity = control.querySelector('span');

        minus.addEventListener('click', () => {
            let q = parseInt(quantity.textContent);
            if (q > 1) quantity.textContent = q - 1;
        });

        plus.addEventListener('click', () => {
            let q = parseInt(quantity.textContent);
            quantity.textContent = q + 1;
        });
    });

    // Add to cart simulation
    document.querySelectorAll('.fa-cart-plus').forEach(icon => {
        icon.closest('button').addEventListener('click', () => {
            const card = icon.closest('.card');
            const name = card.querySelector('.card-title').textContent;
            const price = card.querySelector('.price').textContent;
            const qty = card.querySelector('.quantity-controls span').textContent;
            alert(`Ditambahkan ke keranjang: ${name} (${qty}x) - ${price}`);
        });
    });
});
</script>
@endpush
