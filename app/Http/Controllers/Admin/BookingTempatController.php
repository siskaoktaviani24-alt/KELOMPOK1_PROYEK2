<?php

namespace App\Http\Controllers\Admin; 

use App\Models\bookingTempat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingTempatController extends Controller
{
    public function index()
    {
        $bookingTempat = bookingTempat::all();
        return view('booking_tempat.index', compact('bookingTempat'));
    }

    public function create()
    {
        $menu = \App\Models\menu::where('stok', '>', 0)->get();
        
        return view('booking_tempat.create', [
            'isFromBookingSession' => false,
            'bookingData' => [],
            'menu' => $menu,
            'isFromCart' => false,
            'cartData' => []
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'tanggal_reservasi' => 'required|date|after:today',
            'waktu_reservasi' => 'required',
            'jumlah_orang' => 'required|integer|min:1|max:20'
        ]);

        // Generate kode booking unik
        $kodeBooking = 'KOPI-' . Str::upper(Str::random(6));

        $bookingTempat = bookingTempat::create([
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'no_telepon' => $validated['no_telepon'],
            'tanggal_reservasi' => $validated['tanggal_reservasi'],
            'waktu_reservasi' => $validated['waktu_reservasi'],
            'jumlah_orang' => $validated['jumlah_orang'],
            'kode_booking' => $kodeBooking
        ]);

        // Simpan booking_id di session untuk digunakan di menu
        session(['current_booking_id' => $bookingTempat->id]);

        return redirect()->route('booking_tempat.success', $bookingTempat->id)
            ->with('success', 'Booking tempat berhasil dibuat! Kode Booking: ' . $kodeBooking);
    }

    public function success($id)
    {
        $booking = bookingTempat::findOrFail($id);
        return view('booking_tempat.success', compact('booking'));
    }

    public function processPayment($id)
    {
        $booking = bookingTempat::findOrFail($id);
        return view('booking_tempat.payment', compact('booking'));
    }

    public function toMenu($id)
    {
        $booking = bookingTempat::findOrFail($id);
        $menu = \App\Models\menu::where('stok', '>', 0)->get();
        
        // Simpan booking_id di session
        session(['current_booking_id' => $id]);
        session(['current_booking_data' => [
            'id' => $booking->id,
            'kode_booking' => $booking->kode_booking,
            'nama_pelanggan' => $booking->nama_pelanggan,
            'tanggal_reservasi' => $booking->tanggal_reservasi,
            'waktu_reservasi' => $booking->waktu_reservasi,
            'jumlah_orang' => $booking->jumlah_orang
        ]]);
        
        // Redirect ke menu biasa dengan session data
        return redirect()->route('menu.index')
            ->with('booking_info', 'Anda sedang memesan menu untuk booking tempat. Data akan terisi otomatis.');
    }

    // Tambahkan method untuk update status booking tempat
    public function updateStatus(Request $request, $id)
    {
        $booking = bookingTempat::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,dibatalkan'
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diupdate!');
    }
}