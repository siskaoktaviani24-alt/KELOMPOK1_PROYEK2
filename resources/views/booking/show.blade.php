@extends('layouts.app')

@section('title', 'Detail Booking - Kedai Kopi Preium')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card booking-card">
                <div class="card-header coffee-bg text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Booking</h4>
                    <a href="{{ route('booking.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nama Pelanggan:</div>
                        <div class="col-sm-8">{{ $booking->nama_pelanggan }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nomor Meja:</div>
                        <div class="col-sm-8">{{ $booking->nomor_meja }}</div>
                    </div>
                    
                    <hr>
                    
                    <h5 class="mb-3">Detail Pesanan:</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking->pesanan as $pesanan)
                                <tr>
                                    <td>{{ $pesanan['nama_menu'] }}</td>
                                    <td>Rp {{ number_format($pesanan['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $pesanan['jumlah'] }}</td>
                                    <td>Rp {{ number_format($pesanan['subtotal'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total:</td>
                                    <td class="fw-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-sm-4 fw-bold">Metode Bayar:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-info text-capitalize">
                                {{ $booking->metode_bayar }}
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 fw-bold">Status:</div>
                        <div class="col-sm-8">
                            <span class="badge 
                                @if($booking->status == 'selesai') bg-success
                                @elseif($booking->status == 'dibatalkan') bg-danger
                                @else bg-warning @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 fw-bold">Dibuat pada:</div>
                        <div class="col-sm-8">{{ $booking->created_at->format('d F Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection