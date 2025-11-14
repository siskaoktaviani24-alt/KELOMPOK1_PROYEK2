<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\menu;
use App\Models\booking;
use App\Models\bookingTempat;
use App\Models\meja;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_menu' => menu::count(),
            'total_pesanan' => booking::count(),
            'total_reservasi' => bookingTempat::count(),
            'total_meja' => meja::count(),
            'pesanan_hari_ini' => booking::whereDate('created_at', today())->count(),
            'reservasi_hari_ini' => bookingTempat::whereDate('tanggal_reservasi', today())->count(),
            'pendapatan_hari_ini' => booking::whereDate('created_at', today())->sum('total_harga'),
            'pendapatan_bulan_ini' => booking::whereMonth('created_at', now()->month)->sum('total_harga')
        ];

        // Pemesanan terbaru
        $pemesananTerbaru = booking::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Reservasi mendatang
        $reservasiMendatang = bookingTempat::where('tanggal_reservasi', '>=', today())
            ->orderBy('tanggal_reservasi', 'asc')
            ->orderBy('waktu_reservasi', 'asc')
            ->limit(5)
            ->get();

        // Chart data - pendapatan 7 hari terakhir
        $pendapatanHarian = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $total = booking::whereDate('created_at', $date)->sum('total_harga');
            $pendapatanHarian[] = [
                'date' => $date->format('d M'),
                'total' => $total
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'pemesananTerbaru',
            'reservasiMendatang',
            'pendapatanHarian'
        ));
    }
}