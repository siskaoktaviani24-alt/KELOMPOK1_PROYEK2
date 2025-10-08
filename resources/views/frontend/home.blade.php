@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang di Kedai Kopi Kita</h1>
        <p class="lead">Tempat terbaik untuk menikmati kopi berkualitas dan suasana yang nyaman</p>
        <a href="{{ route('reservation.index') }}" class="btn btn-primary btn-lg mt-3">
            <i class="fas fa-calendar-check"></i> Reservasi Sekarang
        </a>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-hover text-center h-100">
                <div class="card-body">
                    <i class="fas fa-coffee fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Kopi Berkualitas</h5>
                    <p class="card-text">Dibuat dari biji kopi pilihan dengan teknik penyeduhan terbaik</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-hover text-center h-100">
                <div class="card-body">
                    <i class="fas fa-utensils fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Menu Variatif</h5>
                    <p class="card-text">Berbagai pilihan menu makanan dan minuman untuk dinikmati</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-hover text-center h-100">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Tempat Nyaman</h5>
                    <p class="card-text">Suasana yang cozy dan nyaman untuk bekerja atau bersantai</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection