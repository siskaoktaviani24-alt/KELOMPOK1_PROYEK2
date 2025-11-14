<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();
        return view('admin.meja.index', compact('mejas'));
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_meja' => 'required|string|max:10|unique:meja',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dipesan'
        ]);

        Meja::create($validated);

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil ditambahkan');
    }

    public function edit($id)
    {
        $meja = Meja::findOrFail($id);
        return view('admin.meja.edit', compact('meja'));
    }

    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);
        
        $validated = $request->validate([
            'no_meja' => 'required|string|max:10|unique:meja,no_meja,' . $id,
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,dipesan'
        ]);

        $meja->update($validated);

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil diupdate');
    }

    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();

        return redirect()->route('admin.meja.index')->with('success', 'Meja berhasil dihapus');
    }

    // 🚀 Fitur penting: toggle warna (biru/abu)
    public function toggle($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->is_booked = !$meja->is_booked;
        $meja->save();

        return back()->with('success', 'Status meja berhasil diubah');
    }
}
