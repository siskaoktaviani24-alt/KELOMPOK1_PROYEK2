@props(['menu'])

<div class="col-lg-4 col-md-6 mb-4 menu-item" data-category="{{ $menu->kategori }}">
    <div class="card menu-card">
        <div class="menu-image" style="background-image: url('{{ $menu->gambar ? asset('storage/' . $menu->gambar) : 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' }}');">
            <span class="badge category-badge 
                @if($menu->kategori == 'Kopi') bg-coffee
                @elseif($menu->kategori == 'Makanan') bg-success
                @else bg-info @endif">
                {{ $menu->kategori }}
            </span>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
            <p class="card-text text-muted">{{ $menu->deskripsi }}</p>
            
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="price-tag">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                <span class="stok-info badge 
                    @if($menu->stok > 10) bg-success
                    @elseif($menu->stok > 0) bg-warning
                    @else bg-danger @endif">
                    Stok: {{ $menu->stok }}
                </span>
            </div>
            
            <div class="d-grid gap-2">
                <a href="{{ route('menu.show', $menu->id) }}" class="btn btn-outline-coffee btn-sm">
                    <i class="fas fa-info-circle me-1"></i>Detail
                </a>
                <button class="btn btn-coffee btn-sm add-to-cart" 
                        data-menu-id="{{ $menu->id }}" 
                        data-menu-name="{{ $menu->nama_menu }}" 
                        data-menu-price="{{ $menu->harga }}" 
                        data-menu-stok="{{ $menu->stok }}"
                        @if($menu->stok == 0) disabled @endif>
                    <i class="fas fa-cart-plus me-1"></i>
                    @if($menu->stok == 0)
                        Stok Habis
                    @else
                        Tambah ke Pesanan
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>