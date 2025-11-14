@extends('layouts.app')

@section('title', 'Detail Menu - Kedai Kopi Premium')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header coffee-bg text-white">
                    <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Menu</h4>
                </div>
                <div class="card-body">
                    @if($menu)
                    <div class="row">
                        <div class="col-md-6">
                            @if($menu->gambar)
                                <img src="{{ asset('storage/' . $menu->gambar) }}" class="img-fluid rounded" alt="{{ $menu->nama_menu }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" class="img-fluid rounded" alt="Default menu image">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h3>{{ $menu->nama_menu }}</h3>
                            <p class="text-muted">{{ $menu->deskripsi }}</p>
                            <h4 class="text-coffee">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h4>
                            
                            <div class="mb-3">
                                <span class="badge {{ $menu->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $menu->stok > 0 ? 'Stok Tersedia: ' . $menu->stok : 'Stok Habis' }}
                                </span>
                            </div>

                            @if($menu->stok > 0)
                                <button class="btn btn-coffee btn-lg add-to-cart" data-menu-id="{{ $menu->id }}">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Pesanan
                                </button>
                            @else
                                <button class="btn btn-secondary btn-lg" disabled>
                                    <i class="fas fa-times me-2"></i>Stok Habis
                                </button>
                            @endif

                            <a href="{{ route('menu.index') }}" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h4>Menu Tidak Ditemukan</h4>
                        <p>Menu yang Anda cari tidak tersedia.</p>
                        <a href="{{ route('menu.index') }}" class="btn btn-coffee">
                            <i class="fas fa-utensils me-2"></i>Kembali ke Menu
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add to cart functionality
        document.querySelector('.add-to-cart')?.addEventListener('click', function() {
            const menuId = this.getAttribute('data-menu-id');
            
            let cart = JSON.parse(localStorage.getItem('menu_cart') || '[]');
            
            const existingItem = cart.find(item => item.id == menuId);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                const menuName = '{{ $menu->nama_menu }}';
                const menuPrice = 'Rp {{ number_format($menu->harga, 0, ",", ".") }}';
                
                cart.push({
                    id: menuId,
                    name: menuName,
                    price: menuPrice,
                    quantity: 1
                });
            }
            
            localStorage.setItem('menu_cart', JSON.stringify(cart));
            alert('Menu berhasil ditambahkan ke keranjang!');
        });
    });
</script>
@endsection