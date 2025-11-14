<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class bookingTempat extends Model
{
    protected $table = 'booking_tempat';
    
    protected $fillable = [
        'nama_pelanggan',
        'no_telepon',
        'tanggal_reservasi',
        'waktu_reservasi',
        'jumlah_orang',
        'status',
        'kode_booking'
    ];

    protected $casts = [
        'tanggal_reservasi' => 'date',
    ];

    // Scope untuk booking aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'pending')->orWhere('status', 'dikonfirmasi');
    }

    // Scope untuk booking hari ini
    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_reservasi', Carbon::today());
    }

    // Accessor untuk format tanggal
    public function getTanggalReservasiFormattedAttribute()
    {
        return Carbon::parse($this->tanggal_reservasi)->format('d F Y');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badgeClass = [
            'pending' => 'bg-warning',
            'dikonfirmasi' => 'bg-success',
            'dibatalkan' => 'bg-danger'
        ];

        return '<span class="badge ' . ($badgeClass[$this->status] ?? 'bg-secondary') . '">' . ucfirst($this->status) . '</span>';
    }
}