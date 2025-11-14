<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $menu = Menu::where('stok', '>', 0)->get();
        
        // Cek jika ada data booking dari session
        $isFromBookingSession = session()->has('booking_data');
        $bookingData = session()->get('booking_data', []);
        
        return view('booking.create', compact('menu', 'isFromBookingSession', 'bookingData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_meja' => 'required|string|max:50',
            'pesanan' => 'required|array|min:1',
            'pesanan.*.menu_id' => 'required|exists:menu,id',
            'pesanan.*.jumlah' => 'required|integer|min:1',
            'metode_bayar' => 'required|in:cash,dana',
        ]);

        DB::beginTransaction();
        
        try {
            // Hitung total harga
            $totalHarga = 0;
            $pesananDetails = [];
            
            foreach ($validated['pesanan'] as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                
                // Cek stok
                if ($menu->stok < $item['jumlah']) {
                    return back()->withErrors(['pesanan' => "Stok {$menu->nama_menu} tidak mencukupi"])->withInput();
                }
                
                $subtotal = $menu->harga * $item['jumlah'];
                $totalHarga += $subtotal;
                
                // Kurangi stok
                $menu->decrement('stok', $item['jumlah']);
                
                $pesananDetails[] = [
                    'menu_id' => $menu->id,
                    'nama_menu' => $menu->nama_menu,
                    'harga' => $menu->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ];
            }
            
            // Simpan booking
            $booking = Booking::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'nomor_meja' => $validated['nomor_meja'],
                'pesanan' => $pesananDetails,
                'total_harga' => $totalHarga,
                'metode_bayar' => $validated['metode_bayar'],
                'status' => 'pending',
            ]);
            
            DB::commit();
            
            // Hapus session booking jika ada
            session()->forget('booking_data');
            
            return redirect()->route('booking.index')->with('success', 'Booking berhasil dibuat!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('booking.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $menu = Menu::where('stok', '>', 0)->get();
        return view('booking.edit', compact('booking', 'menu'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        // Update logic here
        return redirect()->route('booking.index')->with('success', 'Booking berhasil diupdate!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Kembalikan stok menu
        foreach ($booking->pesanan as $pesanan) {
            $menu = Menu::find($pesanan['menu_id']);
            if ($menu) {
                $menu->increment('stok', $pesanan['jumlah']);
            }
        }
        
        $booking->delete();
        
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus!');
    }

    // Method untuk cart
    public function addToCart(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        
        $cart = session()->get('menu_cart', []);
        $cart[] = [
            'id' => $menu->id,
            'name' => $menu->nama_menu,
            'price' => $menu->harga,
            'quantity' => $request->quantity
        ];
        
        session()->put('menu_cart', $cart);
        
        return response()->json(['success' => true, 'cart_count' => count($cart)]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('menu_cart', []);
        $cart = array_filter($cart, function($item) use ($request) {
            return $item['id'] != $request->menu_id;
        });
        
        session()->put('menu_cart', array_values($cart));
        
        return response()->json(['success' => true, 'cart_count' => count($cart)]);
    }

    public function getCart()
    {
        $cart = session()->get('menu_cart', []);
        return response()->json($cart);
    }

    public function clearCart()
    {
        session()->forget('menu_cart');
        return response()->json(['success' => true]);
    }

    public function processDanaPayment(Request $request)
    {
        // Logic untuk proses pembayaran DANA
        return response()->json(['success' => true, 'message' => 'Pembayaran DANA diproses']);
    }
}