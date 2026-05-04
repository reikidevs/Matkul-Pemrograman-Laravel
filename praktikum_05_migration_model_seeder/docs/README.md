# Praktikum 05: Migration, Model, Seeder

**Status:** ✅ Selesai  
**Tanggal Praktikum:** Senin, 27 April 2026  
**Kelompok:** Pagi A1 (11.00) & A2 (12.30)

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

1. Memahami konsep **Migration** untuk mengelola struktur database
2. Membuat dan menggunakan **Model (Eloquent ORM)** untuk interaksi dengan database
3. Menggunakan **Seeder** untuk mengisi data awal/dummy
4. Memahami relasi **One-to-Many** antar tabel
5. Mengintegrasikan database dengan aplikasi Laravel

---

## 📚 Konsep Dasar

### Arsitektur Database Laravel

Laravel menggunakan 3 komponen utama untuk pengelolaan database:

| Komponen | Fungsi Utama |
|----------|--------------|
| **Migration** | Membuat dan mengubah struktur database (tabel, kolom, relasi) |
| **Model (Eloquent ORM)** | Representasi tabel menjadi objek PHP (mengakses tabel) |
| **Seeder** | Mengisi data awal (dummy/master data) |

### Migration

**Migration** adalah fitur Laravel untuk mengontrol database dengan version control.

**Kelebihan:**
- ✅ **Kolaborasi Tim**: Semua orang memiliki struktur database yang sama
- ✅ **Version Control**: Melacak perubahan struktur database
- ✅ **Rollback**: Membatalkan perubahan dengan cepat

**Perintah Dasar:**
```bash
# Membuat migration
php artisan make:migration nama_migrate

# Menjalankan migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Reset dan jalankan ulang semua migration
php artisan migrate:refresh

# Hapus semua tabel dan jalankan migration + seeder
php artisan migrate:fresh --seed
```

### Model (Eloquent ORM)

**Model** adalah representasi tabel database dalam bentuk Class PHP.

**Konvensi Penamaan:**
- **Model**: Tunggal (Singular), PascalCase → `Mahasiswa`, `ProgramStudi`
- **Tabel**: Jamak (Plural), snake_case → `mahasiswas`, `program_studis`
- **Primary Key**: Secara default `id`

**Perintah Membuat Model:**
```bash
php artisan make:model NamaModel
```

### Seeder

**Seeder** digunakan untuk mengisi database dengan data awal atau dummy data.

**Perintah Dasar:**
```bash
# Membuat seeder
php artisan make:seeder NamaSeeder

# Menjalankan seeder tertentu
php artisan db:seed --class=NamaSeeder

# Menjalankan semua seeder
php artisan db:seed
```

### Integrasi Sekaligus

Membuat Model + Migration + Factory + Seeder sekaligus:
```bash
php artisan make:model NamaModel -mfs
```

---

## 🔧 Persiapan

### 1. Copy Project dari Praktikum 04

```bash
# Dari root repository
cp -r praktikum_04_master_template/praktikum_laravel praktikum_05_migration_model_seeder/
cd praktikum_05_migration_model_seeder/praktikum_laravel
```

### 2. Buat Database

Buka **phpMyAdmin** atau **MySQL Command Line** dan buat database baru:

```sql
CREATE DATABASE akademik;
```

### 3. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL Anda.

### 4. Install Dependencies (jika belum)

```bash
composer install
```

---

## 📝 Langkah-Langkah Praktikum

### Langkah 1: Buat Migration untuk Tabel `program_studis`

#### 1.1 Generate Migration

```bash
php artisan make:migration create_program_studis_table
```

File akan dibuat di: `database/migrations/YYYY_MM_DD_HHMMSS_create_program_studis_table.php`

#### 1.2 Edit Migration

Buka file migration yang baru dibuat dan edit method `up()`:

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
            $table->string('nama_prodi');
            $table->string('fakultas');
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
- `$table->id()`: Primary key auto increment
- `$table->string('nama_prodi')`: Kolom nama program studi (VARCHAR)
- `$table->string('fakultas')`: Kolom nama fakultas
- `$table->enum('jenjang', [...])`: Kolom jenjang dengan pilihan D3, S1, S2, S3
- `$table->timestamps()`: Kolom created_at dan updated_at otomatis

---

### Langkah 2: Buat Migration untuk Tabel `mahasiswas`

#### 2.1 Generate Migration

```bash
php artisan make:migration create_mahasiswas_table
```

#### 2.2 Edit Migration

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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15)->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('program_studi')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
```

**Penjelasan:**
- `$table->string('nim', 15)->unique()`: NIM maksimal 15 karakter, harus unik
- `$table->date('tgl_lahir')`: Kolom tanggal lahir (DATE)
- `$table->enum('jenis_kelamin', ['L', 'P'])`: Laki-laki atau Perempuan
- `$table->integer('program_studi')->unsigned()`: Foreign key ke tabel program_studis

---

### Langkah 3: Jalankan Migration

```bash
php artisan migrate
```

**Output yang diharapkan:**
```
Migration table created successfully.
Migrating: 2024_04_27_000001_create_program_studis_table
Migrated:  2024_04_27_000001_create_program_studis_table
Migrating: 2024_04_27_000002_create_mahasiswas_table
Migrated:  2024_04_27_000002_create_mahasiswas_table
```

**Verifikasi:**
- Buka phpMyAdmin
- Pilih database `akademik`
- Pastikan tabel `program_studis` dan `mahasiswas` sudah ada

---

### Langkah 4: Buat Model `ProgramStudi`

#### 4.1 Generate Model

```bash
php artisan make:model ProgramStudi
```

File akan dibuat di: `app/Models/ProgramStudi.php`

#### 4.2 Edit Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi)
    protected $table = 'program_studis';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'nama_prodi',
        'fakultas',
        'jenjang',
    ];

    /**
     * Relasi One-to-Many dengan Mahasiswa
     * Satu program studi memiliki banyak mahasiswa
     */
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'program_studi');
    }
}
```

---

### Langkah 5: Buat Model `Mahasiswa`

#### 5.1 Generate Model

```bash
php artisan make:model Mahasiswa
```

#### 5.2 Edit Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'mahasiswas';

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'nim',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'program_studi',
    ];

    // Cast tipe data
    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    /**
     * Relasi Many-to-One dengan ProgramStudi
     * Banyak mahasiswa belong to satu program studi
     */
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi');
    }
}
```

---

### Langkah 6: Buat Seeder untuk `ProgramStudi`

#### 6.1 Generate Seeder

```bash
php artisan make:seeder ProgramStudiSeeder
```

File akan dibuat di: `database/seeders/ProgramStudiSeeder.php`

#### 6.2 Edit Seeder

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
                'nama_prodi' => 'Sistem Informasi',
                'fakultas' => 'Fakultas Teknologi Informasi dan Komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'nama_prodi' => 'Teknik Informatika',
                'fakultas' => 'Fakultas Teknologi Informasi dan Komunikasi',
                'jenjang' => 'S1',
            ],
            [
                'nama_prodi' => 'Manajemen',
                'fakultas' => 'Fakultas Ekonomi dan Bisnis',
                'jenjang' => 'S1',
            ],
            [
                'nama_prodi' => 'Akuntansi',
                'fakultas' => 'Fakultas Ekonomi dan Bisnis',
                'jenjang' => 'S1',
            ],
            [
                'nama_prodi' => 'Psikologi',
                'fakultas' => 'Fakultas Psikologi',
                'jenjang' => 'S1',
            ],
            [
                'nama_prodi' => 'Ilmu Komunikasi',
                'fakultas' => 'Fakultas Teknologi Informasi dan Komunikasi',
                'jenjang' => 'S1',
            ],
        ];

        foreach ($programStudis as $prodi) {
            ProgramStudi::create($prodi);
        }
    }
}
```

---

### Langkah 7: Buat Seeder untuk `Mahasiswa`

#### 7.1 Generate Seeder

```bash
php artisan make:seeder MahasiswaSeeder
```

#### 7.2 Edit Seeder

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = [
            [
                'nim' => 'G.131.24.0001',
                'nama' => 'Ahmad Rizki',
                'tempat_lahir' => 'Semarang',
                'tgl_lahir' => '2005-01-15',
                'jenis_kelamin' => 'L',
                'program_studi' => 1, // Sistem Informasi
            ],
            [
                'nim' => 'G.131.24.0002',
                'nama' => 'Siti Nurhaliza',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2005-03-22',
                'jenis_kelamin' => 'P',
                'program_studi' => 1, // Sistem Informasi
            ],
            [
                'nim' => 'G.131.24.0003',
                'nama' => 'Budi Santoso',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '2004-11-10',
                'jenis_kelamin' => 'L',
                'program_studi' => 2, // Teknik Informatika
            ],
            [
                'nim' => 'G.131.24.0004',
                'nama' => 'Dewi Lestari',
                'tempat_lahir' => 'Surabaya',
                'tgl_lahir' => '2005-05-18',
                'jenis_kelamin' => 'P',
                'program_studi' => 3, // Manajemen
            ],
            [
                'nim' => 'G.131.24.0005',
                'nama' => 'Eko Prasetyo',
                'tempat_lahir' => 'Yogyakarta',
                'tgl_lahir' => '2004-08-25',
                'jenis_kelamin' => 'L',
                'program_studi' => 2, // Teknik Informatika
            ],
            [
                'nim' => 'G.131.24.0006',
                'nama' => 'Fitri Handayani',
                'tempat_lahir' => 'Malang',
                'tgl_lahir' => '2005-02-14',
                'jenis_kelamin' => 'P',
                'program_studi' => 4, // Akuntansi
            ],
            [
                'nim' => 'G.131.24.0007',
                'nama' => 'Gilang Ramadhan',
                'tempat_lahir' => 'Solo',
                'tgl_lahir' => '2004-12-05',
                'jenis_kelamin' => 'L',
                'program_studi' => 5, // Psikologi
            ],
            [
                'nim' => 'G.131.24.0008',
                'nama' => 'Hana Pertiwi',
                'tempat_lahir' => 'Semarang',
                'tgl_lahir' => '2005-07-30',
                'jenis_kelamin' => 'P',
                'program_studi' => 6, // Ilmu Komunikasi
            ],
            [
                'nim' => 'G.131.24.0009',
                'nama' => 'Indra Gunawan',
                'tempat_lahir' => 'Bekasi',
                'tgl_lahir' => '2004-09-12',
                'jenis_kelamin' => 'L',
                'program_studi' => 1, // Sistem Informasi
            ],
            [
                'nim' => 'G.131.24.0010',
                'nama' => 'Julia Safitri',
                'tempat_lahir' => 'Tangerang',
                'tgl_lahir' => '2005-04-20',
                'jenis_kelamin' => 'P',
                'program_studi' => 3, // Manajemen
            ],
        ];

        foreach ($mahasiswas as $mhs) {
            Mahasiswa::create($mhs);
        }
    }
}
```

---

### Langkah 8: Daftarkan Seeder di `DatabaseSeeder`

Edit file `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder secara berurutan
        $this->call([
            ProgramStudiSeeder::class,
            MahasiswaSeeder::class,
        ]);
    }
}
```

**Catatan:** Urutan penting! `ProgramStudiSeeder` harus dijalankan dulu karena `Mahasiswa` memiliki foreign key ke `ProgramStudi`.

---

### Langkah 9: Jalankan Seeder

```bash
php artisan db:seed
```

**Atau jalankan migration + seeder sekaligus:**

```bash
php artisan migrate:fresh --seed
```

**Output yang diharapkan:**
```
Dropped all tables successfully.
Migration table created successfully.
Migrating: 2024_04_27_000001_create_program_studis_table
Migrated:  2024_04_27_000001_create_program_studis_table
Migrating: 2024_04_27_000002_create_mahasiswas_table
Migrated:  2024_04_27_000002_create_mahasiswas_table
Seeding: Database\Seeders\ProgramStudiSeeder
Seeded:  Database\Seeders\ProgramStudiSeeder
Seeding: Database\Seeders\MahasiswaSeeder
Seeded:  Database\Seeders\MahasiswaSeeder
```

**Verifikasi di phpMyAdmin:**
- Tabel `program_studis` berisi 6 data
- Tabel `mahasiswas` berisi 10 data

---

### Langkah 10: Update Controller untuk Menggunakan Database

Edit file `app/Http/Controllers/MahasiswaController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data mahasiswa dengan relasi program studi (eager loading)
        $mahasiswa = Mahasiswa::with('programStudi')->get();

        // Kirim data ke view
        return view('mahasiswa.index', compact('mahasiswa'));
    }
}
```

**Penjelasan:**
- `Mahasiswa::with('programStudi')`: Eager loading untuk menghindari N+1 query problem
- `->get()`: Mengambil semua data
- `compact('mahasiswa')`: Mengirim variabel $mahasiswa ke view

---

### Langkah 11: Update View untuk Menampilkan Data dari Database

Edit file `resources/views/mahasiswa/index.blade.php`:

```blade
@extends('layouts.master')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Data Mahasiswa</h2>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>NO</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>TEMPAT LAHIR</th>
                <th>TANGGAL LAHIR</th>
                <th>JENIS KELAMIN</th>
                <th>PROGRAM STUDI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->tempat_lahir }}</td>
                <td>{{ $mhs->tgl_lahir->format('d-m-Y') }}</td>
                <td>{{ $mhs->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td>{{ $mhs->programStudi->nama_prodi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
```

**Perubahan dari praktikum sebelumnya:**
- `$mhs['nim']` → `$mhs->nim` (dari array ke object)
- `$mhs['prodi']` → `$mhs->programStudi->nama_prodi` (menggunakan relasi)
- `$mhs->tgl_lahir->format('d-m-Y')` (format tanggal otomatis dari Carbon)

---

### Langkah 12: Testing

#### 12.1 Jalankan Server

```bash
php artisan serve
```

#### 12.2 Buka Browser

Akses: **http://localhost:8000/mahasiswa**

#### 12.3 Verifikasi Output

Pastikan halaman menampilkan:
- ✅ Tabel dengan 10 data mahasiswa
- ✅ Kolom NIM, Nama, Tempat Lahir, Tanggal Lahir, Jenis Kelamin, Program Studi
- ✅ Data program studi muncul dengan benar (bukan ID, tapi nama prodi)
- ✅ Format tanggal: dd-mm-yyyy (contoh: 15-01-2005)
- ✅ Jenis kelamin: "Laki-laki" atau "Perempuan" (bukan L/P)

---

## ✅ Checklist Verifikasi

Pastikan semua langkah berikut sudah dilakukan:

### Database
- [ ] Database `akademik` sudah dibuat
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] Migration `create_program_studis_table` sudah dibuat
- [ ] Migration `create_mahasiswas_table` sudah dibuat
- [ ] Migration berhasil dijalankan (`php artisan migrate`)
- [ ] Tabel `program_studis` muncul di database
- [ ] Tabel `mahasiswas` muncul di database

### Model
- [ ] Model `ProgramStudi` sudah dibuat di `app/Models/`
- [ ] Model `Mahasiswa` sudah dibuat di `app/Models/`
- [ ] Relasi `hasMany` sudah ditambahkan di `ProgramStudi`
- [ ] Relasi `belongsTo` sudah ditambahkan di `Mahasiswa`
- [ ] Property `$fillable` sudah diisi dengan benar

### Seeder
- [ ] Seeder `ProgramStudiSeeder` sudah dibuat
- [ ] Seeder `MahasiswaSeeder` sudah dibuat
- [ ] Kedua seeder sudah didaftarkan di `DatabaseSeeder`
- [ ] Seeder berhasil dijalankan (`php artisan db:seed`)
- [ ] Tabel `program_studis` berisi 6 data
- [ ] Tabel `mahasiswas` berisi 10 data

### Controller & View
- [ ] `MahasiswaController` sudah diupdate menggunakan `Mahasiswa::with('programStudi')->get()`
- [ ] View `mahasiswa/index.blade.php` sudah diupdate menggunakan object notation
- [ ] Halaman `/mahasiswa` menampilkan data dengan benar
- [ ] Nama program studi muncul (bukan ID)
- [ ] Format tanggal sudah benar (dd-mm-yyyy)

---

## 🔍 Troubleshooting

### Error: "SQLSTATE[HY000] [1049] Unknown database 'akademik'"

**Penyebab:** Database belum dibuat.

**Solusi:**
```sql
CREATE DATABASE akademik;
```

---

### Error: "SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'"

**Penyebab:** Username atau password MySQL salah.

**Solusi:**
- Cek username dan password MySQL Anda
- Edit file `.env`:
  ```env
  DB_USERNAME=root
  DB_PASSWORD=password_anda
  ```

---

### Error: "Class 'App\Models\Mahasiswa' not found"

**Penyebab:** Model belum dibuat atau namespace salah.

**Solusi:**
```bash
php artisan make:model Mahasiswa
```

Pastikan namespace di controller:
```php
use App\Models\Mahasiswa;
```

---

### Error: "Call to undefined relationship [programStudi]"

**Penyebab:** Relasi belum didefinisikan di Model.

**Solusi:**
Tambahkan method `programStudi()` di `app/Models/Mahasiswa.php`:
```php
public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'program_studi');
}
```

---

### Data Tidak Muncul di Halaman

**Penyebab:** Seeder belum dijalankan atau data kosong.

**Solusi:**
```bash
# Cek data di database
php artisan tinker
>>> \App\Models\Mahasiswa::count()
>>> \App\Models\ProgramStudi::count()

# Jika kosong, jalankan seeder
php artisan db:seed
```

---

### Error: "Trying to get property 'nama_prodi' of non-object"

**Penyebab:** Foreign key tidak valid atau relasi tidak di-load.

**Solusi:**
- Pastikan menggunakan `with('programStudi')` di controller
- Cek foreign key `program_studi` di tabel mahasiswas valid

---

### Migration Sudah Jalan, Tapi Ingin Ubah Struktur

**Solusi:**
```bash
# Rollback migration terakhir
php artisan migrate:rollback

# Edit file migration
# Lalu jalankan lagi
php artisan migrate
```

**Atau reset semua:**
```bash
php artisan migrate:fresh --seed
```

⚠️ **Peringatan:** `migrate:fresh` akan **menghapus semua data** di database!

---

## 📖 Referensi

- [Laravel Migration Documentation](https://laravel.com/docs/10.x/migrations)
- [Laravel Eloquent ORM](https://laravel.com/docs/10.x/eloquent)
- [Laravel Database Seeding](https://laravel.com/docs/10.x/seeding)
- [Laravel Eloquent Relationships](https://laravel.com/docs/10.x/eloquent-relationships)

---

## 🎓 Eksplorasi Tambahan

Setelah menyelesaikan praktikum dasar, coba eksplorasi fitur berikut:

1. **Tambah Data Mahasiswa Baru**
   - Buat seeder tambahan dengan data Anda sendiri
   - Jalankan seeder spesifik: `php artisan db:seed --class=MahasiswaSeeder`

2. **Query Database dengan Tinker**
   ```bash
   php artisan tinker
   >>> $mahasiswa = \App\Models\Mahasiswa::find(1)
   >>> $mahasiswa->nama
   >>> $mahasiswa->programStudi->nama_prodi
   ```

3. **Filter Data Berdasarkan Program Studi**
   ```php
   $mahasiswaSI = Mahasiswa::where('program_studi', 1)->get();
   ```

4. **Hitung Jumlah Mahasiswa per Prodi**
   ```php
   $prodi = ProgramStudi::withCount('mahasiswas')->get();
   ```

---

**Selamat! Anda telah menyelesaikan Praktikum 05: Migration, Model, Seeder** 🎉

---

**Previous:** [Praktikum 04 - Master Template](../../praktikum_04_master_template/README.md)  
**Next:** Praktikum 06 - Menampilkan Data dari Database
