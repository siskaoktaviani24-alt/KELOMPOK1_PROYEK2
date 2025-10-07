@extends('layouts.main')
@section('title', $title)
@section('content')
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedai Kopi - Pemesanan Online</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .menu-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            height: 100%;
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .menu-image {
            height: 200px;
            object-fit: cover;
        }
        .price {
            color: #d4af37;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        .order-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            position: sticky;
            top: 20px;
        }
        footer {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-coffee me-2"></i>Kedai Kopi Nusantara
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-light position-relative" type="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">3</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 300px;" aria-labelledby="cartDropdown">
                            <h6 class="dropdown-header">Keranjang Anda</h6>
                            <div class="cart-item">
                                <div class="d-flex justify-content-between">
                                    <span>Espresso</span>
                                    <span>Rp 25.000</span>
                                </div>
                                <small class="text-muted">Qty: 1</small>
                            </div>
                            <div class="cart-item">
                                <div class="d-flex justify-content-between">
                                    <span>Croissant</span>
                                    <span>Rp 18.000</span>
                                </div>
                                <small class="text-muted">Qty: 2</small>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <strong>Total:</strong>
                                <strong>Rp 61.000</strong>
                            </div>
                            <a href="#" class="btn btn-primary w-100">Checkout</a>
                        </div>
                    </div>
                    <a href="#" class="btn btn-outline-light">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold">Selamat Datang di Kedai Kopi Nusantara</h1>
            <p class="lead">Racikan kopi terbaik dengan cita rasa autentik Indonesia</p>
            <a href="#menu" class="btn btn-primary btn-lg mt-3">Lihat Menu <i class="fas fa-arrow-down ms-2"></i></a>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">Menu Kami</h2>
                    <p class="text-muted">Pilih dari berbagai varian kopi dan makanan pendamping</p>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <ul class="nav nav-pills justify-content-center" id="categoryFilter">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-category="all">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-category="kopi">Kopi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-category="non-kopi">Non-Kopi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-category="makanan">Makanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-category="snack">Snack</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="row" id="menuItems">
                <!-- Item 1 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="kopi">
                    <div class="card menu-card h-100">
                        <span class="badge bg-warning category-badge">Hot</span>
                        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" class="card-img-top menu-image" alt="Espresso">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Espresso</h5>
                            <p class="card-text flex-grow-1">Kopi murni dengan rasa kuat dan aroma yang khas.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 25.000</span>
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

                <!-- Item 2 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="kopi">
                    <div class="card menu-card h-100">
                        <span class="badge bg-info category-badge">Iced</span>
                        <img src="https://images.unsplash.com/photo-1461023058943-07fcbe16d735?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" class="card-img-top menu-image" alt="Iced Latte">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Iced Latte</h5>
                            <p class="card-text flex-grow-1">Perpaduan espresso dengan susu dan es batu.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 30.000</span>
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

                <!-- Item 3 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="non-kopi">
                    <div class="card menu-card h-100">
                        <img src="https://images.unsplash.com/photo-1597481499750-3e11b15e0c0f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top menu-image" alt="Matcha Latte">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Matcha Latte</h5>
                            <p class="card-text flex-grow-1">Minuman matcha dengan susu, cocok untuk pecinta green tea.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 28.000</span>
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

                <!-- Item 4 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="makanan">
                    <div class="card menu-card h-100">
                        <img src="https://images.unsplash.com/photo-1555507036-ab794f27d2e9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="card-img-top menu-image" alt="Croissant">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Croissant</h5>
                            <p class="card-text flex-grow-1">Pastri Prancis dengan tekstur berlapis dan rasa mentega.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 18.000</span>
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

                <!-- Item 5 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="kopi">
                    <div class="card menu-card h-100">
                        <span class="badge bg-warning category-badge">Hot</span>
                        <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=735&q=80" class="card-img-top menu-image" alt="Cappuccino">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Cappuccino</h5>
                            <p class="card-text flex-grow-1">Espresso dengan steamed milk dan foam yang lembut.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 28.000</span>
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

                <!-- Item 6 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="non-kopi">
                    <div class="card menu-card h-100">
                        <span class="badge bg-info category-badge">Iced</span>
                        <img src="https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=735&q=80" class="card-img-top menu-image" alt="Chocolate Frappe">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Chocolate Frappe</h5>
                            <p class="card-text flex-grow-1">Minuman cokelat dingin dengan whipped cream.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 32.000</span>
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

                <!-- Item 7 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="snack">
                    <div class="card menu-card h-100">
                        <img src="https://images.unsplash.com/photo-1558961363-fa8fdf82db35?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=765&q=80" class="card-img-top menu-image" alt="Chocolate Chip Cookie">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Chocolate Chip Cookie</h5>
                            <p class="card-text flex-grow-1">Cookie dengan potongan cokelat yang lumer di mulut.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 15.000</span>
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

                <!-- Item 8 -->
                <div class="col-lg-3 col-md-6 mb-4" data-category="makanan">
                    <div class="card menu-card h-100">
                        <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=781&q=80" class="card-img-top menu-image" alt="Sandwich">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Club Sandwich</h5>
                            <p class="card-text flex-grow-1">Sandwich isi ayam, bacon, selada, tomat, dan mayones.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="price">Rp 35.000</span>
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
            </div>
        </div>
    </section>

    <!-- Order Summary Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="mb-4">Cara Memesan</h3>
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-list fa-2x"></i>
                            </div>
                            <h5>Pilih Menu</h5>
                            <p class="text-muted">Pilih menu favorit Anda dari berbagai pilihan kami.</p>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-cart-plus fa-2x"></i>
                            </div>
                            <h5>Tambahkan ke Keranjang</h5>
                            <p class="text-muted">Tambahkan item ke keranjang dan atur jumlah pesanan.</p>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-cash-register fa-2x"></i>
                            </div>
                            <h5>Checkout</h5>
                            <p class="text-muted">Lakukan pembayaran dan konfirmasi pesanan.</p>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-coffee fa-2x"></i>
                            </div>
                            <h5>Tunggu & Nikmati</h5>
                            <p class="text-muted">Tunggu pesanan Anda dan nikmati di tempat atau bungkus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-summary">
                        <h4 class="mb-3">Ringkasan Pesanan</h4>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Espresso</span>
                                <span>Rp 25.000</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Croissant (2x)</span>
                                <span>Rp 36.000</span>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp 61.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Pajak (10%)</span>
                            <span>Rp 6.100</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 fw-bold">
                            <span>Total</span>
                            <span>Rp 67.100</span>
                        </div>
                        <button class="btn btn-primary w-100 mb-2">Checkout Sekarang</button>
                        <button class="btn btn-outline-secondary w-100">Kosongkan Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-coffee me-2"></i>Kedai Kopi Nusantara</h5>
                    <p class="mb-2">Menyajikan kopi terbaik dengan cita rasa Indonesia.</p>
                    <div class="d-flex">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Kontak Kami</h5>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Kopi No. 123, Jakarta</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
                    <p class="mb-1"><i class="fas fa-envelope me-2"></i> info@kedaikopinusantara.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Jam Operasional</h5>
                    <p class="mb-1">Senin - Jumat: 07.00 - 22.00</p>
                    <p class="mb-1">Sabtu - Minggu: 08.00 - 23.00</p>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <p class="mb-0">&copy; 2023 Kedai Kopi Nusantara. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Category Filter
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('#categoryFilter .nav-link');
            const menuItems = document.querySelectorAll('#menuItems .col-lg-3');
            
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Update active state
                    categoryLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    
                    const category = this.getAttribute('data-category');
                    
                    // Filter items
                    menuItems.forEach(item => {
                        if (category === 'all' || item.getAttribute('data-category') === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
            
            // Quantity controls
            const quantityControls = document.querySelectorAll('.quantity-controls');
            
            quantityControls.forEach(control => {
                const minusBtn = control.querySelector('.quantity-btn:first-child');
                const plusBtn = control.querySelector('.quantity-btn:last-child');
                const quantitySpan = control.querySelector('span');
                
                minusBtn.addEventListener('click', function() {
                    let quantity = parseInt(quantitySpan.textContent);
                    if (quantity > 1) {
                        quantitySpan.textContent = quantity - 1;
                    }
                });
                
                plusBtn.addEventListener('click', function() {
                    let quantity = parseInt(quantitySpan.textContent);
                    quantitySpan.textContent = quantity + 1;
                });
            });
            
            // Add to cart buttons
            const addToCartButtons = document.querySelectorAll('.btn-primary .fa-cart-plus').forEach(icon => {
                icon.closest('button').addEventListener('click', function() {
                    const card = this.closest('.card');
                    const itemName = card.querySelector('.card-title').textContent;
                    const itemPrice = card.querySelector('.price').textContent;
                    const quantity = card.querySelector('.quantity-controls span').textContent;
                    
                    alert(`Ditambahkan ke keranjang: ${itemName} (${quantity}x) - ${itemPrice}`);
                });
            });
        });
    </script>
</body>
</html>
@endsection