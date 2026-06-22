<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'tipe',
        'luas',
        'harga_sewa',
        'fasilitas',
        'lantai',
        'status',
        'foto',
    ];

    protected $casts = [
        'luas' => 'decimal:2',
        'harga_sewa' => 'decimal:2',
    ];

    public function penghunians()
    {
        return $this->hasMany(Penghunian::class);
    }

    // Get penghunian aktif
    public function penghunianAktif()
    {
        return $this->hasOne(Penghunian::class)->where('status', 'active');
    }
}
