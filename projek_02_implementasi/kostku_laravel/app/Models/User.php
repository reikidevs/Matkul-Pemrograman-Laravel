<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan profil role-specific
    public function penghuni()
    {
        return $this->hasOne(Penghuni::class);
    }

    public function pemilikKost()
    {
        return $this->hasOne(PemilikKost::class);
    }

    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class);
    }

    // Helper methods
    public function isPenghuni()
    {
        return $this->role === 'penghuni';
    }

    public function isPemilik()
    {
        return $this->role === 'pemilik';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
