<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mahasiswas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'prodi_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi dengan model ProgramStudi
     * Mengaitkan kolom program_studi di tabel mahasiswa dengan id di tabel program_studi.
     * belongsTo digunakan untuk mendefinisikan hubungan antara model Mahasiswa dan Program_studi.
     * Dalam hal ini, setiap mahasiswa memiliki satu program studi yang terkait.
     * Fungsi ini akan mengembalikan objek Program_studi yang terkait dengan mahasiswa tersebut
     * berdasarkan kolom program_studi di tabel mahasiswa yang merujuk ke kolom id di tabel program_studi.
     */
    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'prodi_id', 'id');
    }

    /**
     * Accessor untuk jenis kelamin
     * Mengubah L menjadi "Laki-laki" dan P menjadi "Perempuan"
     */
    protected function jenisKelamin(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => $value === 'L' ? 'Laki-laki' : 'Perempuan',
        );
    }
}
