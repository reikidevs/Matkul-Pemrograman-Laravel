<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'no_hp',
        'pekerjaan',
        'alamat_asal',
        'kontak_darurat',
        'foto_ktp',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penghunians()
    {
        return $this->hasMany(Penghunian::class);
    }

    public function komplains()
    {
        return $this->hasMany(Komplain::class);
    }

    // Get penghunian aktif
    public function penghunianAktif()
    {
        return $this->hasOne(Penghunian::class)->where('status', 'active');
    }
}
