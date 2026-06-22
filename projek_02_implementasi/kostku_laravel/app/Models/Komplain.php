<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $fillable = [
        'penghuni_id',
        'kategori',
        'judul',
        'deskripsi',
        'foto',
        'prioritas',
        'status',
        'assigned_to',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
