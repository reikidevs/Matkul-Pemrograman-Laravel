<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class ProgramStudi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program_studis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'fakultas',
        'jenjang',
    ];

    /**
     * Get the mahasiswa for the program studi.
     */
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    /**
     * Accessor untuk fakultas
     * Membuat nama fakultas menjadi title case (huruf pertama setiap kata kapital) saat diakses
     */
    protected function fakultas(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Str::title($value),
        );
    }
}
