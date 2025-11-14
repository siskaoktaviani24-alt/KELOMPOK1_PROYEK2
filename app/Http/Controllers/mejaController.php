<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class MejaController extends Controller
{
    public function index()
    {
        // Ambil daftar meja yang tersedia (tidak sedang dipesan)
        $availableTables = $this->getAvailableTables();
        
        // Ambil meja yang sedang dipesan hari ini
        $occupiedTables = Booking::whereDate('created_at', today())
            ->pluck('nomor_meja')
            ->toArray();

        return view('meja.index', compact('availableTables', 'occupiedTables'));
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required'
        ]);

        $bookedTables = Booking::whereDate('created_at', $request->tanggal)
            ->pluck('nomor_meja')
            ->toArray();

        $availableTables = array_diff($this->getAllTables(), $bookedTables);

        return response()->json([
            'success' => true,
            'available_tables' => array_values($availableTables),
            'booked_tables' => $bookedTables
        ]);
    }

    private function getAvailableTables()
    {
        // Simulasi daftar meja yang tersedia di kafe
        // Dalam implementasi real, ini bisa dari model Meja
        return ['A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'VIP1', 'VIP2'];
    }

    private function getAllTables()
    {
        return ['A1', 'A2', 'A3', 'B1', 'B2', 'B3', 'C1', 'C2', 'VIP1', 'VIP2'];
    }

    public function getTableLayout()
    {
        $tables = [
            'area_a' => [
                'A1' => ['status' => 'available', 'capacity' => 2],
                'A2' => ['status' => 'available', 'capacity' => 2],
                'A3' => ['status' => 'available', 'capacity' => 4],
            ],
            'area_b' => [
                'B1' => ['status' => 'available', 'capacity' => 4],
                'B2' => ['status' => 'available', 'capacity' => 6],
                'B3' => ['status' => 'available', 'capacity' => 2],
            ],
            'area_c' => [
                'C1' => ['status' => 'available', 'capacity' => 2],
                'C2' => ['status' => 'available', 'capacity' => 2],
            ],
            'vip' => [
                'VIP1' => ['status' => 'available', 'capacity' => 8],
                'VIP2' => ['status' => 'available', 'capacity' => 6],
            ]
        ];

        // Update status berdasarkan booking hari ini
        $occupiedTables = Booking::whereDate('created_at', today())
            ->pluck('nomor_meja')
            ->toArray();

        foreach ($tables as $area => $areaTables) {
            foreach ($areaTables as $tableNumber => $tableInfo) {
                if (in_array($tableNumber, $occupiedTables)) {
                    $tables[$area][$tableNumber]['status'] = 'occupied';
                }
            }
        }

        return response()->json([
            'success' => true,
            'table_layout' => $tables
        ]);
    }
}