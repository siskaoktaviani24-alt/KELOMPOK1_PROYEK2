<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'nama_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Method untuk login
    public function login($credentials)
    {
        return auth()->guard('admin')->attempt($credentials);
    }

    // Method untuk kelola menu
    public function kelolaMenu()
    {
        return Menu::all();
    }

    // Method untuk lihat transaksi
    public function lihatTransaksi()
    {
        return Order::with('reservation')->get();
    }

    // Method untuk logout
    public function logout()
    {
        return auth()->guard('admin')->logout();
    }
}