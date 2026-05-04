# Praktikum 06: Menampilkan Data dari Database

**Status:** ✅ Selesai  
**Tanggal Praktikum:** Senin, 4 Mei 2026

---

## 📋 Daftar Isi

1. [Tujuan Pembelajaran](#-tujuan-pembelajaran)
2. [Konsep Dasar](#-konsep-dasar)
3. [Persiapan](#-persiapan)
4. [Langkah-Langkah Praktikum](#-langkah-langkah-praktikum)
5. [Checklist Verifikasi](#-checklist-verifikasi)
6. [Troubleshooting](#-troubleshooting)

---

## 🎯 Tujuan Pembelajaran

Setelah menyelesaikan praktikum ini, mahasiswa diharapkan mampu:

1. Menampilkan data mahasiswa dari database dengan relasi
2. Menggunakan **Eloquent Accessor** untuk transformasi data otomatis
3. Mengubah format jenis kelamin (L → Laki-laki, P → Perempuan)
4. Mengubah format nama fakultas menjadi Title Case
5. Menampilkan data relasi (Program Studi) dengan benar

---

## 📚 Konsep Dasar

### Eloquent Accessor

**Accessor** adalah fitur Laravel yang memungkinkan kita mengubah format data saat diakses dari database, tanpa mengubah data asli di database.

**Keuntungan:**
- ✅ Data di database tetap dalam format asli
- ✅ Transformasi otomatis saat data diakses
- ✅ Kode lebih bersih dan reusable
- ✅ Tidak perlu transformasi manual di view

**Contoh Penggunaan:**

```php
// Tanpa Accessor (manual di view)
{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}

// Dengan Accessor (otomatis)
{{ $mahasiswa->jenis_kelamin }}  // Output: "Laki-laki" atau "Perempuan"
```

### Str::title()

Helper Laravel untuk mengubah string menjadi Title Case (huruf pertama setiap kata kapital).

```php
Str::title('fakultas teknologi informasi')
// Output: "Fakultas Teknologi Informasi"
```

---

## 🔧 Persiapan

### 1. Copy Project dari Praktikum 05

```bash
# Dari root repository
cp -r praktikum_05_migration_model_seeder/praktikum_laravel praktikum_06_menampilkan_data/
cd praktikum_06_menampilkan_data/praktikum_laravel
```

### 2. Pastikan Database Sudah Ada

Database `akademik` harus sudah dibuat dari praktikum sebelumnya.

### 3. Konfigurasi .env

Pastikan konfigurasi database sudah benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📝 Langkah-Langkah Praktikum

### Langkah 1: Update Migration `program_studis`

Kita perlu menambahkan kolom `fakultas` dan `jenjang` ke tabel `program_studis`.

Edit file `database/migrations/2024_04_14_000001_create_program_studis_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prodi', 10)->unique();
            $table->string('nama_prodi', 100);
            $table->string('fakultas', 200);
            $table->enum('jenjang', ['D3', 'S1', 'S2', 'S3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
```

**Penjelasan:**
- `$table->string('fakultas', 200)`: Kolom untuk nama fakultas
- `$table->enum('jenjang', ['D3', 'S1', 'S2', 'S3'])`: Kolom untuk jenjang pendidikan

---

### Langkah 2: Update Model `ProgramStudi`

Edit file `app/Models/ProgramStudi.php`:

```php
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
```

**Penjelasan:**
- `use Illuminate\Database\Eloquent\Casts\Attribute`: Import class Attribute
- `use Illuminate\Support\Str`: Import helper Str
- `protected function fakultas(): Attribute`: Accessor untuk kolom fakultas
- `Str::title($value)`: Mengubah string menjadi Title Case

**Cara Kerja Accessor:**
```php
// Data di database: "fakultas teknologi informasi"
// Saat diakses: $prodi->fakultas
// Output: "Fakultas Teknologi Informasi"
```

---

### Langkah 3: Update Model `Mahasiswa`

Edit file `app/Models/Mahasiswa.php`:

```php
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
```

**Penjelasan:**
- `use Illuminate\Database\Eloquent\Casts\Attribute`: Import class Attribute
- `public function prodi()`: Relasi ke ProgramStudi (nama method diubah dari `programStudi` ke `prodi`)
- `protected function jenisKelamin(): Attribute`: Accessor untuk jenis kelamin
- `fn(string $value) => ...`: Arrow function untuk transformasi

**Cara Kerja Accessor:**
```php
// Data di database: "L"
// Saat diakses: $mahasiswa->jenis_kelamin
// Output: "Laki-laki"

// Data di database: "P"
// Saat diakses: $mahasiswa->jenis_kelamin
// Output: "Perempuan"
```

---

### Langkah 4: Update Seeder `ProgramStudiSeeder`

Edit file `database/seeders/ProgramStudiSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudis = [
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'MNJ',
                'nama_prodi' => 'Manajemen',
                'fakultas' => 'fakultas ekonomi dan bisnis',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'AKT',
                'nama_prodi' => 'Akuntansi',
                'fakultas' => 'fakultas ekonomi dan bisnis',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'PSI',
                'nama_prodi' => 'Psikologi',
                'fakultas' => 'fakultas psikologi',
                'jenjang' => 'S1',
            ],
            [
                'kode_prodi' => 'IKOM',
                'nama_prodi' => 'Ilmu Komunikasi',
                'fakultas' => 'fakultas teknologi informasi dan komunikasi',
                'jenjang' => 'S1',
            ],
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create($prodi);
        }
    }
}
```

**Catatan:** Data fakultas disimpan dalam huruf kecil di database, tapi akan otomatis menjadi Title Case saat diakses berkat Accessor.

---

### Langkah 5: Update Controller `MahasiswaController`

Edit file `app/Http/Controllers/MahasiswaController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Memanggil view mahasiswa dan mengirim data mahasiswa ke view tersebut, view ada pada folder mahasiswa
        // $mahasiswa = Mahasiswa::all();
        $data['master'] = array('title' => 'Daftar Mahasiswa');
        $data['mahasiswa'] = Mahasiswa::with('prodi')->latest()->get();

        return view('mahasiswa.index', $data);
    }

    // ... method lainnya tetap sama
}
```

**Penjelasan:**
- `$data['master']`: Array untuk data master (title halaman)
- `Mahasiswa::with('prodi')`: Eager loading relasi prodi
- `->latest()`: Urutkan berdasarkan created_at descending (data terbaru dulu)
- `->get()`: Ambil semua data
- `return view('mahasiswa.index', $data)`: Kirim array $data ke view

---

### Langkah 6: Update View `mahasiswa/index.blade.php`

Edit file `resources/views/mahasiswa/index.blade.php`:

```blade
@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Mahasiswa</th>
                                <th>Lahir</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $shs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $shs['nim'] }}<br>
                                    {{ $shs['nama'] }}<br>
                                    {{ $shs['jenis_kelamin'] }}
                                </td>
                                <td>{{ $shs['tempat_lahir'] }}, {{ $shs['tanggal_lahir']->format('d-m-Y') }}</td>
                                <td>
                                    {{ $shs['prodi']['fakultas'] }}<br>
                                    {{ $shs['prodi']['nama_prodi'] }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-warning mr-2">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger mr-2">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

**Penjelasan:**
- `$loop->iteration`: Nomor urut otomatis dari Blade
- `$shs['jenis_kelamin']`: Otomatis "Laki-laki" atau "Perempuan" (Accessor)
- `$shs['prodi']['fakultas']`: Otomatis Title Case (Accessor)
- `$shs['prodi']['nama_prodi']`: Nama program studi dari relasi
- `$shs['tanggal_lahir']->format('d-m-Y')`: Format tanggal dd-mm-yyyy

---

### Langkah 7: Jalankan Migration dan Seeder

Karena ada perubahan struktur tabel, kita perlu reset database:

```bash
php artisan migrate:fresh --seed
```

**Output yang diharapkan:**
```
Dropped all tables successfully.
Migration table created successfully.
Migrating: 2024_04_14_000001_create_program_studis_table
Migrated:  2024_04_14_000001_create_program_studis_table
Migrating: 2024_04_14_000002_create_mahasiswas_table
Migrated:  2024_04_14_000002_create_mahasiswas_table
Seeding: Database\Seeders\ProgramStudiSeeder
Seeded:  Database\Seeders\ProgramStudiSeeder
Seeding: Database\Seeders\MahasiswaSeeder
Seeded:  Database\Seeders\MahasiswaSeeder
```

**Verifikasi di phpMyAdmin:**
- Tabel `program_studis` memiliki kolom `fakultas` dan `jenjang`
- Data fakultas tersimpan dalam huruf kecil

---

### Langkah 8: Testing

#### 8.1 Jalankan Server

```bash
php artisan serve
```

#### 8.2 Buka Browser

Akses: **http://localhost:8000/mahasiswa**

#### 8.3 Verifikasi Output

Pastikan halaman menampilkan:

✅ **Kolom Mahasiswa:**
- NIM
- Nama
- Jenis Kelamin: "Laki-laki" atau "Perempuan" (bukan L/P)

✅ **Kolom Lahir:**
- Format: "Tempat, dd-mm-yyyy"
- Contoh: "Semarang, 15-01-2005"

✅ **Kolom Program Studi:**
- Nama Fakultas dalam Title Case
- Contoh: "Fakultas Teknologi Informasi Dan Komunikasi"
- Nama Program Studi
- Contoh: "Sistem Informasi"

✅ **Kolom Aksi:**
- Tombol Edit (warning/kuning)
- Tombol Hapus (danger/merah)

---

## ✅ Checklist Verifikasi

### Migration & Database
- [ ] Migration `program_studis` sudah ditambahkan kolom `fakultas` dan `jenjang`
- [ ] Migration berhasil dijalankan
- [ ] Tabel `program_studis` memiliki 4 kolom tambahan (fakultas, jenjang)
- [ ] Data fakultas tersimpan dalam huruf kecil di database

### Model
- [ ] Model `ProgramStudi` sudah import `Attribute` dan `Str`
- [ ] Accessor `fakultas()` sudah ditambahkan di `ProgramStudi`
- [ ] Model `Mahasiswa` sudah import `Attribute`
- [ ] Accessor `jenisKelamin()` sudah ditambahkan di `Mahasiswa`
- [ ] Relasi `prodi()` sudah benar di `Mahasiswa`
- [ ] Property `$fillable` sudah diupdate

### Seeder
- [ ] `ProgramStudiSeeder` sudah ditambahkan data `fakultas` dan `jenjang`
- [ ] Seeder berhasil dijalankan
- [ ] Tabel `program_studis` berisi 6 data dengan fakultas dan jenjang

### Controller & View
- [ ] `MahasiswaController` menggunakan `with('prodi')` dan `latest()`
- [ ] View menggunakan array notation `$shs['jenis_kelamin']`
- [ ] View mengakses relasi dengan `$shs['prodi']['fakultas']`
- [ ] Halaman `/mahasiswa` menampilkan data dengan benar

### Output
- [ ] Jenis kelamin tampil sebagai "Laki-laki" atau "Perempuan"
- [ ] Nama fakultas tampil dalam Title Case
- [ ] Nama program studi tampil dengan benar
- [ ] Format tanggal: dd-mm-yyyy
- [ ] Tombol Edit dan Hapus tampil

---

## 🔍 Troubleshooting

### Error: "Call to undefined method Illuminate\Database\Eloquent\Casts\Attribute::make()"

**Penyebab:** Versi Laravel terlalu lama (< 9.0).

**Solusi:**
Gunakan syntax lama untuk Accessor:

```php
// Syntax lama (Laravel 8.x)
public function getJenisKelaminAttribute($value)
{
    return $value === 'L' ? 'Laki-laki' : 'Perempuan';
}

public function getFakultasAttribute($value)
{
    return Str::title($value);
}
```

---

### Error: "Trying to get property 'fakultas' of non-object"

**Penyebab:** Relasi tidak di-load atau nama relasi salah.

**Solusi:**
- Pastikan menggunakan `with('prodi')` di controller
- Pastikan nama method relasi di Model adalah `prodi()`
- Cek foreign key `prodi_id` valid

---

### Fakultas Tidak Menjadi Title Case

**Penyebab:** Accessor tidak berjalan atau import Str salah.

**Solusi:**
```php
// Pastikan import di atas class
use Illuminate\Support\Str;

// Pastikan accessor benar
protected function fakultas(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => Str::title($value),
    );
}
```

---

### Jenis Kelamin Masih Tampil L/P

**Penyebab:** Accessor tidak berjalan atau nama kolom salah.

**Solusi:**
- Pastikan nama method accessor: `jenisKelamin()` (camelCase)
- Pastikan nama kolom di database: `jenis_kelamin` (snake_case)
- Laravel otomatis konversi snake_case ke camelCase

---

### Error: "SQLSTATE[42S22]: Column not found: 'fakultas'"

**Penyebab:** Migration belum dijalankan atau kolom belum ditambahkan.

**Solusi:**
```bash
# Reset database dan jalankan ulang migration
php artisan migrate:fresh --seed
```

---

## 📖 Referensi

- [Laravel Eloquent Accessors](https://laravel.com/docs/10.x/eloquent-mutators#defining-an-accessor)
- [Laravel String Helpers](https://laravel.com/docs/10.x/helpers#strings)
- [Laravel Eloquent Relationships](https://laravel.com/docs/10.x/eloquent-relationships)

---

## 🎓 Eksplorasi Tambahan

1. **Tambah Accessor untuk NIM**
   - Format NIM dengan titik: G.131.24.0001

2. **Tambah Accessor untuk Nama**
   - Ubah nama menjadi Title Case

3. **Tambah Accessor untuk Tanggal Lahir**
   - Format Indonesia: "15 Januari 2005"

4. **Tambah Filter Berdasarkan Prodi**
   - Dropdown untuk filter mahasiswa per prodi

---

**Selamat! Anda telah menyelesaikan Praktikum 06: Menampilkan Data dari Database** 🎉

---

**Previous:** [Praktikum 05 - Migration, Model, Seeder](../../praktikum_05_migration_model_seeder/README.md)  
**Next:** Praktikum 07 - Relasi Database
