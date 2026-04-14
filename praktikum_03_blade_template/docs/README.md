# Praktikum 03: Blade Template

**Status:** ✅ Selesai

**Tujuan Pembelajaran:**
- Mahasiswa mampu menggunakan Blade template engine
- Menampilkan data dalam bentuk tabel HTML
- Menggunakan looping di Blade dengan @foreach
- Menampilkan minimal 5 data mahasiswa

---

## 📋 Instruksi Praktikum

> **Dari route /mahasiswa yang sudah dibuat sebelumnya:**
> - Buat view untuk menampilkan data mahasiswa dengan menggunakan Tabel HTML (tidak menggunakan CSS)
> - Data dalam bentuk tabel
> - Kolom Data mahasiswa meliputi: NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI
> - Isi tabel dengan minimal 5 data mahasiswa

---

## 🚀 Persiapan

Copy project dari Praktikum 02:

**Linux/Mac:**
```bash
cp -r praktikum_02_routing_controller/praktikum_laravel praktikum_03_blade_template/
```

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse praktikum_02_routing_controller/praktikum_laravel praktikum_03_blade_template/
```

---

## 📝 Langkah-Langkah Praktikum

### Step 1: Masuk ke Folder Project
```bash
cd praktikum_03_blade_template/praktikum_laravel
```

### Step 2: Update Controller dengan Data 5 Mahasiswa

Edit file `app/Http/Controllers/MahasiswaController.php`:

```php
public function index()
{
    // Data mahasiswa dummy (minimal 5 data)
    $mahasiswa = [
        [
            'nim' => '20240001',
            'nama' => 'Fajar Santoso',
            'tempat_lahir' => 'Yogyakarta',
            'tgl_lahir' => '2003-08-02',
            'jenis_kelamin' => 'Perempuan',
            'prodi' => 'Manajemen'
        ],
        [
            'nim' => '20240002',
            'nama' => 'Lani Utami',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '2003-03-11',
            'jenis_kelamin' => 'Laki-laki',
            'prodi' => 'Manajemen'
        ],
        [
            'nim' => '20240003',
            'nama' => 'Agus Wijaya',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '2001-01-28',
            'jenis_kelamin' => 'Laki-laki',
            'prodi' => 'Ilmu Komunikasi'
        ],
        [
            'nim' => '20240004',
            'nama' => 'Rian Utami',
            'tempat_lahir' => 'Jakarta',
            'tgl_lahir' => '2000-04-10',
            'jenis_kelamin' => 'Laki-laki',
            'prodi' => 'Psikologi'
        ],
        [
            'nim' => '20240005',
            'nama' => 'Budi Wulandari',
            'tempat_lahir' => 'Medan',
            'tgl_lahir' => '2002-11-21',
            'jenis_kelamin' => 'Laki-laki',
            'prodi' => 'Akuntansi'
        ]
    ];

    return view('mahasiswa.index', compact('mahasiswa'));
}
```

### Step 3: Update View dengan Tabel HTML

Edit file `resources/views/mahasiswa/index.blade.php`:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>DATA MAHASISWA</h1>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>NO</th>
                <th>MAHASISWA</th>
                <th>LAHIR</th>
                <th>PROGRAM STUDI</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    {{ $mhs['nim'] }}<br>
                    {{ $mhs['nama'] }}<br>
                    {{ $mhs['jenis_kelamin'] }}
                </td>
                <td>
                    {{ $mhs['tempat_lahir'] }}, {{ $mhs['tgl_lahir'] }}
                </td>
                <td>{{ $mhs['prodi'] }}</td>
                <td>
                    <a href="#">Edit</a>
                    <a href="#">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="/">← Kembali ke Home</a>
</body>
</html>
```

### Step 4: Jalankan Server

```bash
php artisan serve
```

### Step 5: Test di Browser

Buka: **http://localhost:8000/mahasiswa**

Anda akan melihat tabel dengan 5 data mahasiswa.

---

## ✅ Checklist Praktikum

- [ ] Project di-copy dari Praktikum 02
- [ ] Controller diupdate dengan array 5 mahasiswa
- [ ] View menggunakan tabel HTML (tanpa CSS)
- [ ] Tabel memiliki 5 kolom: NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI
- [ ] Menggunakan @foreach untuk looping data
- [ ] Minimal 5 data mahasiswa tampil
- [ ] Link Edit dan Hapus ada di kolom AKSI
- [ ] Tabel tampil dengan border

---

## 🎯 Penjelasan Blade Syntax

### 1. Looping dengan @foreach
```php
@foreach($mahasiswa as $index => $mhs)
    // Kode di sini akan diulang untuk setiap data mahasiswa
@endforeach
```

### 2. Menampilkan Data dengan {{ }}
```php
{{ $mhs['nim'] }}        // Output: 20240001
{{ $mhs['nama'] }}       // Output: Fajar Santoso
{{ $index + 1 }}         // Output: 1, 2, 3, ...
```

### 3. Array Index
```php
$index => $mhs
// $index = 0, 1, 2, 3, 4
// $mhs = data mahasiswa pada index tersebut
```

### 4. HTML Break Line
```php
{{ $mhs['nim'] }}<br>
{{ $mhs['nama'] }}<br>
{{ $mhs['jenis_kelamin'] }}
```

---

## 📊 Format Tabel

| NO | MAHASISWA | LAHIR | PROGRAM STUDI | AKSI |
|----|-----------|-------|---------------|------|
| 1 | 20240001<br>Fajar Santoso<br>Perempuan | Yogyakarta, 2003-08-02 | Manajemen | Edit Hapus |
| 2 | 20240002<br>Lani Utami<br>Laki-laki | Bandung, 2003-03-11 | Manajemen | Edit Hapus |
| 3 | 20240003<br>Agus Wijaya<br>Laki-laki | Bandung, 2001-01-28 | Ilmu Komunikasi | Edit Hapus |
| 4 | 20240004<br>Rian Utami<br>Laki-laki | Jakarta, 2000-04-10 | Psikologi | Edit Hapus |
| 5 | 20240005<br>Budi Wulandari<br>Laki-laki | Medan, 2002-11-21 | Akuntansi | Edit Hapus |

---

## 🎨 Blade Directives yang Digunakan

### @foreach
Digunakan untuk looping array data mahasiswa.

```php
@foreach($mahasiswa as $index => $mhs)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $mhs['nama'] }}</td>
    </tr>
@endforeach
```

### {{ }}
Digunakan untuk menampilkan data (dengan HTML escaping otomatis).

```php
{{ $mhs['nim'] }}
{{ $mhs['nama'] }}
```

---

## 📚 Materi yang Dipelajari

### 1. Blade Template Engine
- File dengan ekstensi `.blade.php`
- Lokasi: `resources/views/`
- Syntax khusus Blade: `@foreach`, `{{ }}`

### 2. Looping Data
- `@foreach` untuk iterasi array
- `$index` untuk nomor urut
- `$mhs` untuk data mahasiswa

### 3. Tabel HTML
- Tag `<table>`, `<thead>`, `<tbody>`, `<tr>`, `<th>`, `<td>`
- Attribute `border`, `cellpadding`, `cellspacing`
- Tanpa CSS (sesuai instruksi)

### 4. Array Multidimensional
- Array of arrays
- Access dengan `$mhs['key']`

---

## 🆘 Troubleshooting

### Error: "Undefined variable $mahasiswa"
**Solusi:** Pastikan controller mengirim data dengan `compact('mahasiswa')`

### Error: "Invalid argument supplied for foreach()"
**Solusi:** Pastikan `$mahasiswa` adalah array, bukan single object

### Tabel tidak tampil
**Solusi:** 
- Cek apakah route `/mahasiswa` sudah benar
- Cek apakah view file ada di `resources/views/mahasiswa/index.blade.php`

### Data tidak muncul
**Solusi:**
- Cek syntax Blade `{{ }}` sudah benar
- Cek key array: `$mhs['nim']`, `$mhs['nama']`, dll

---

## 🎉 Hasil Implementasi

File yang sudah dibuat/dimodifikasi:
- ✅ `app/Http/Controllers/MahasiswaController.php` - Update dengan 5 data mahasiswa
- ✅ `resources/views/mahasiswa/index.blade.php` - Tabel HTML dengan @foreach

---

## 📸 Screenshot Hasil

Setelah berhasil, Anda akan melihat:
- Judul "DATA MAHASISWA"
- Tabel dengan border
- 5 kolom: NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI
- 5 baris data mahasiswa
- Link Edit dan Hapus di setiap baris
- Link "Kembali ke Home"

---

## 📚 Referensi

- [Laravel Blade Documentation](https://laravel.com/docs/10.x/blade)
- [Blade Control Structures](https://laravel.com/docs/10.x/blade#control-structures)
- [Blade Loops](https://laravel.com/docs/10.x/blade#loops)

---

**Previous:** [Praktikum 02 - Routing & Controller](../praktikum_02_routing_controller/README.md)  
**Next:** [Praktikum 04 - Master Template](../praktikum_04_master_template/README.md)
