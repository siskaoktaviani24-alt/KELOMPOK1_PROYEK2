<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingTempat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller  // Diperbaiki dari Controlzler
{
    public function index()
    {
        $startDate = request('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $bookings = Booking::whereBetween('created_at', [$startDate, $endDate])->get();
        $bookingTempats = BookingTempat::whereBetween('tanggal_reservasi', [$startDate, $endDate])->get();

        $totalPendapatan = $bookings->sum('total_harga');
        $totalPesanan = $bookings->count();
        $totalReservasi = $bookingTempats->count();

        return view('admin.reports.index', compact(
            'bookings',
            'bookingTempats',
            'totalPendapatan',
            'totalPesanan',
            'totalReservasi',
            'startDate',
            'endDate'
        ));
    }

    public function export()
    {
        // Logic untuk export laporan
        return response()->json(['message' => 'Export feature to be implemented']);
    }
}