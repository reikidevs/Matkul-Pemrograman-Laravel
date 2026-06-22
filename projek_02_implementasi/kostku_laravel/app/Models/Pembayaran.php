<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_pembayaran',
        'rekening_tujuan',
        'bukti_transfer',
        'status',
        'approved_by',
        'approved_at',
        'catatan',
    ];

    protected $casts = [
        'jumlah_bayar' => 'decimal:2',
        'tanggal_bayar' => 'date',
        'approved_at' => 'datetime',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
