@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-light vh-100 sidebar p-3">
            <h5 class="text-center">Menu</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Kelola Artikel</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Kelola User</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link text-danger border-0 bg-transparent p-0">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Konten utama -->
        <div class="col-md-9 col-lg-10 p-4">
            <h2>Selamat Datang, {{ $admin }} 👋</h2>
            <p>Ini halaman dashboard admin Laravel + Bootstrap.</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total Artikel</h5>
                            <p class="fs-3 text-primary fw-bold">{{ $artikel }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total User</h5>
                            <p class="fs-3 text-success fw-bold">{{ $user }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h5>Total Kategori</h5>
                            <p class="fs-3 text-warning fw-bold">{{ $kategori }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
