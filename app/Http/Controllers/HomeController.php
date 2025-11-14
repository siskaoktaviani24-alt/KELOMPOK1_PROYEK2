<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BookingTempat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil menu populer untuk ditampilkan di home
        $popularMenu = Menu::where('stok', '>', 0)
            ->orderBy('terjual', 'desc')
            ->limit(6)
            ->get();

        // Cek apakah ada session booking aktif
        $bookingInfo = null;
        if (session()->has('current_booking_data')) {
            $bookingInfo = session('current_booking_data');
        }

        return view('home', compact('popularMenu', 'bookingInfo'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function facilities()
    {
        return view('facilities');
    }
}