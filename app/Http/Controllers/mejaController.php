<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::where('statusMeja', 'tersedia')->get();
        return view('meja.index', compact('mejas'));
    }

    public function show(Meja $meja)
    {
        $reservations = $meja->reservations()->with('order.orderItems.menu')->get();
        return view('meja.show', compact('meja', 'reservations'));
    }

    // Method untuk handle pemesanan dari meja
    public function processOrder(Request $request, Meja $meja)
    {
        // Implementasi proses pemesanan
    }
}