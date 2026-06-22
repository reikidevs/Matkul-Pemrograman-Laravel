<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penghunian_id',
        'periode',
        'jumlah',
        'tanggal_jatuh_tempo',
        'denda',
        'status',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'denda' => 'decimal:2',
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function penghunian()
    {
        return $this->belongsTo(Penghunian::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function getTotalAttribute()
    {
        return $this->jumlah + $this->denda;
    }
}
