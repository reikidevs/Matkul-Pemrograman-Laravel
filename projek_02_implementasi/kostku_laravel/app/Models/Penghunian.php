<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghunian extends Model
{
    use HasFactory;

    protected $fillable = [
        'penghuni_id',
        'kamar_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'durasi_kontrak',
        'status',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
