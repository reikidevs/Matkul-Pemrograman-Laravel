# Praktikum 02: Routing & Controller

**Status:** ✅ Selesai

**Tujuan Pembelajaran:**
- Mahasiswa mampu membuat route di Laravel
- Memahami cara kerja controller
- Mengirim data dari controller ke view
- Membuat controller mahasiswa dengan data dummy

---

## 📋 Instruksi Praktikum

> **Buat Controller mahasiswa yang menampilkan data:**
> - nim
> - nama
> - tempat_lahir
> - tgl_lahir
> - jenis_kelamin
> - prodi

---

## 🚀 Persiapan

### 1. Copy Project dari Praktikum 01

**Linux/Mac:**
```bash
cp -r praktikum_01_install/praktikum_laravel praktikum_02_routing_controller/
```

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse praktikum_01_install/praktikum_laravel praktikum_02_routing_controller/
```

### 2. Masuk ke Folder Project
```bash
cd praktikum_02_routing_controller/praktikum_laravel
```

### 3. Install Dependencies (Jika Diperlukan)
```bash
composer install
```

### 4. Copy .env dan Generate Key
```bash
cp .env.example .env
php artisan key:generate
```

---

## 📝 Langkah-Langkah Praktikum

### Step 1: Membuat Controller

Buat controller dengan nama `MahasiswaController`:

```bash
php artisan make:controller MahasiswaController
```

File akan dibuat di: `app/Http/Controllers/MahasiswaController.php`

### Step 2: Tambahkan Method index()

Edit file `app/Http/Controllers/MahasiswaController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Data mahasiswa dummy
        $mahasiswa = [
            'nim' => 'G.131.24.0001',
            'nama' => 'KURNIAWAN',
            'tempat_lahir' => 'Semarang',
            'tgl_lahir' => '2005-01-15',
            'jenis_kelamin' => 'Laki-laki',
            'prodi' => 'Sistem Informasi'
        ];

        return view('mahasiswa.index', compact('mahasiswa'));
    }
}
```

### Step 3: Buat Route

Edit file `routes/web.php`:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
```

### Step 4: Buat View

Buat folder dan file view:
- Folder: `resources/views/mahasiswa/`
- File: `resources/views/mahasiswa/index.blade.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    
    <p><strong>NIM:</strong> {{ $mahasiswa['nim'] }}</p>
    <p><strong>Nama:</strong> {{ $mahasiswa['nama'] }}</p>
    <p><strong>Tempat Lahir:</strong> {{ $mahasiswa['tempat_lahir'] }}</p>
    <p><strong>Tanggal Lahir:</strong> {{ $mahasiswa['tgl_lahir'] }}</p>
    <p><strong>Jenis Kelamin:</strong> {{ $mahasiswa['jenis_kelamin'] }}</p>
    <p><strong>Program Studi:</strong> {{ $mahasiswa['prodi'] }}</p>
</body>
</html>
```

### Step 5: Jalankan Server

```bash
php artisan serve
```

### Step 6: Test di Browser

Buka: **http://localhost:8000/mahasiswa**

Anda akan melihat data mahasiswa yang ditampilkan.

---

## ✅ Checklist Praktikum

- [ ] Controller `MahasiswaController` berhasil dibuat
- [ ] Method `index()` berisi data mahasiswa dummy
- [ ] Route `/mahasiswa` terdaftar di `routes/web.php`
- [ ] View `mahasiswa/index.blade.php` berhasil dibuat
- [ ] Data mahasiswa tampil di browser
- [ ] Semua field data mahasiswa muncul (nim, nama, tempat_lahir, tgl_lahir, jenis_kelamin, prodi)

---

## 🎯 Eksplorasi Tambahan (Opsional)

### 1. Route dengan Parameter

Tambahkan route dengan parameter ID:

```php
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
```

Method di controller:

```php
public function show($id)
{
    return "Menampilkan mahasiswa dengan ID: " . $id;
}
```

Test: http://localhost:8000/mahasiswa/10

### 2. Route dengan Multiple Parameter

```php
Route::get('/mahasiswa/{nim}/{nama}', function($nim, $nama) {
    return "NIM: $nim, Nama: $nama";
});
```

Test: http://localhost:8000/mahasiswa/G.131.24.0001/KURNIAWAN

### 3. Lihat Semua Route

```bash
php artisan route:list
```

---

## 📚 Materi Terkait

- [Laravel Routing Documentation](https://laravel.com/docs/10.x/routing)
- [Laravel Controllers Documentation](https://laravel.com/docs/10.x/controllers)
- [Blade Templates Documentation](https://laravel.com/docs/10.x/blade)

---

## 📸 Screenshot Hasil

Setelah berhasil, Anda akan melihat halaman dengan:
- Judul "Data Mahasiswa"
- Data mahasiswa ditampilkan dengan format label-value
- Styling sederhana dengan background putih dan shadow
- Link kembali ke home

**URL yang bisa diakses:**
- http://localhost:8000/mahasiswa - Menampilkan data mahasiswa
- http://localhost:8000/mahasiswa/10 - Menampilkan "Menampilkan mahasiswa dengan ID: 10"
- http://localhost:8000/mahasiswa/G.131.24.0001/KURNIAWAN - Menampilkan "NIM: G.131.24.0001, Nama: KURNIAWAN"

---

## 🎉 Hasil Implementasi

File yang sudah dibuat:
- ✅ `app/Http/Controllers/MahasiswaController.php` - Controller dengan method index() dan show()
- ✅ `routes/web.php` - Route /mahasiswa dan /mahasiswa/{id}
- ✅ `resources/views/mahasiswa/index.blade.php` - View dengan styling

---

## 🆘 Troubleshooting

### Error: "Target class [MahasiswaController] does not exist"
```bash
composer dump-autoload
```

### Error: "View [mahasiswa.index] not found"
- Pastikan folder `resources/views/mahasiswa/` ada
- Pastikan file `index.blade.php` ada di folder tersebut

### Error: "Undefined array key 'nim'"
- Cek array `$mahasiswa` di controller
- Pastikan semua key ada

---

**Previous:** [Praktikum 01 - Install Laravel](../../praktikum_01_install/README.md)  
**Next:** [Praktikum 03 - Blade Template](../../praktikum_03_blade_template/README.md)
