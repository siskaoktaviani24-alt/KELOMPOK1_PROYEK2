<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b312b;">
    <div class="container">
        <!-- Logo dan Nama -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" class="me-2">
            <span>
                <span class="fst-italic" style="color:#2d130e;">KOPI</span>
                <span class="fw-bold text-uppercase text-white" style="text-decoration: underline; text-decoration-color: #fff;">Premium</span>
            </span>
        </a>

        <!-- Tombol toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu navigasi -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 {{ Request::is('/') ? 'text-decoration-underline' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 {{ Request::is('menu') ? 'text-decoration-underline' : '' }}" href="{{ url('/menu') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 {{ Request::is('reservasi') ? 'text-decoration-underline' : '' }}" href="{{ url('/reservasi') }}">Reservasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 {{ Request::is('tentang-kami') ? 'text-decoration-underline' : '' }}" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold px-3 {{ Request::is('kontak') ? 'text-decoration-underline' : '' }}" href="{{ url('/kontak') }}">Kontak</a>
                </li>

                <!-- Ikon keranjang -->
                <li class="nav-item ms-3 position-relative">
                    <a href="{{ url('/keranjang') }}" class="text-decoration-none">
                        <i class="bi bi-cart-fill fs-4 text-warning"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            0
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
