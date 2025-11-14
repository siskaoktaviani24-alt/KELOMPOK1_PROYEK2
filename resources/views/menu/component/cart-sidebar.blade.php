<!-- Cart Button -->
<div class="position-fixed bottom-0 end-0 m-4">
    <button class="btn btn-coffee btn-lg rounded-pill shadow" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
        <i class="fas fa-shopping-cart me-2"></i>
        <span class="badge bg-danger" id="cart-count">0</span>
    </button>
</div>

<!-- Shopping Cart Sidebar -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title"><i class="fas fa-shopping-cart me-2"></i>Keranjang Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart-items">
            <p class="text-muted text-center">Keranjang kosong</p>
        </div>
        <div class="mt-auto">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong id="cart-total">Rp 0</strong>
            </div>
            <div class="d-grid gap-2">
                <a href="{{ route('booking_tempat.create') }}" class="btn btn-coffee">
                    <i class="fas fa-calendar-check me-2"></i>Booking Tempat & Pesan
                </a>
                <button class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>