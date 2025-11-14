<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua menu yang stok > 0
        $menus = Menu::where('stok', '>', 0)->get();
        
        // Cek apakah dari booking session
        $isFromBookingSession = session()->has('booking_data');
        $bookingData = session()->get('booking_data', []);
        
        // Debug data
        \Log::info('Menus count: ' . $menus->count());
        \Log::info('Categories: ' . $menus->pluck('kategori')->unique()->implode(', '));
        
        return view('menu.index', compact('menus', 'isFromBookingSession', 'bookingData'));
    }

    public function categories()
    {
        $categories = Menu::where('stok', '>', 0)
            ->get()
            ->groupBy('kategori');
    
        return view('menu.categories', compact('categories'));
    }

    public function search(Request $request)
    {
        $keyword = $request->q;
        $menus = Menu::where('nama_menu', 'like', "%{$keyword}%")
            ->orWhere('deskripsi', 'like', "%{$keyword}%")
            ->orWhere('kategori', 'like', "%{$keyword}%")
            ->get();

        return view('menu.search', compact('menus', 'keyword'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return view('menu.show', compact('menu'));
    }
}