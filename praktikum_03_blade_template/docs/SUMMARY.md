# Summary - Praktikum 03: Blade Template

## ✅ Status: SELESAI

---

## 📋 Yang Sudah Dikerjakan

### 1. Setup Project
- ✅ Copy project dari Praktikum 02
- ✅ Project siap digunakan

### 2. Controller
- ✅ Update `MahasiswaController.php`
- ✅ Ubah data dari single object ke array of arrays
- ✅ Tambah 5 data mahasiswa sesuai instruksi

### 3. View
- ✅ Update `index.blade.php` dengan tabel HTML
- ✅ Gunakan @foreach untuk looping
- ✅ Tabel tanpa CSS (sesuai instruksi)
- ✅ 5 kolom: NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI

---

## 🎯 Hasil yang Dicapai

### Tabel Data Mahasiswa

**Kolom 1: NO**
- Nomor urut 1-5
- Menggunakan `$index + 1`

**Kolom 2: MAHASISWA**
- Baris 1: NIM (20240001, 20240002, ...)
- Baris 2: Nama (Fajar Santoso, Lani Utami, ...)
- Baris 3: Jenis Kelamin (Perempuan, Laki-laki)

**Kolom 3: LAHIR**
- Format: "Tempat, Tanggal"
- Contoh: "Yogyakarta, 2003-08-02"

**Kolom 4: PROGRAM STUDI**
- Manajemen
- Ilmu Komunikasi
- Psikologi
- Akuntansi

**Kolom 5: AKSI**
- Link "Edit"
- Link "Hapus"

---

## 📚 Konsep Blade yang Dipelajari

### 1. @foreach Directive
```php
@foreach($mahasiswa as $index => $mhs)
    // Loop content
@endforeach
```

**Penjelasan:**
- `$mahasiswa` = array data dari controller
- `$index` = index array (0, 1, 2, 3, 4)
- `$mhs` = data mahasiswa pada index tersebut

### 2. {{ }} Syntax
```php
{{ $mhs['nim'] }}
{{ $mhs['nama'] }}
{{ $index + 1 }}
```

**Penjelasan:**
- Menampilkan data dengan HTML escaping otomatis
- Aman dari XSS attack
- Bisa melakukan operasi sederhana (seperti `$index + 1`)

### 3. Array Access
```php
$mhs['nim']           // 20240001
$mhs['nama']          // Fajar Santoso
$mhs['tempat_lahir']  // Yogyakarta
$mhs['tgl_lahir']     // 2003-08-02
$mhs['jenis_kelamin'] // Perempuan
$mhs['prodi']         // Manajemen
```

### 4. HTML Table Structure
```html
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Header</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data</td>
        </tr>
    </tbody>
</table>
```

---

## 🔍 Struktur File

```
praktikum_03_blade_template/
└── praktikum_laravel/
    ├── app/
    │   └── Http/
    │       └── Controllers/
    │           └── MahasiswaController.php  ← MODIFIED (5 data)
    └── resources/
        └── views/
            └── mahasiswa/
                └── index.blade.php          ← MODIFIED (tabel)
```

---

## 🚀 Cara Menjalankan

```bash
cd praktikum_03_blade_template/praktikum_laravel
php artisan serve
```

Buka browser: http://localhost:8000/mahasiswa

---

## 📝 Catatan Penting

1. **@foreach** adalah Blade directive untuk looping
2. **$index** dimulai dari 0, jadi perlu `$index + 1` untuk nomor urut
3. **{{ }}** otomatis melakukan HTML escaping
4. **Tabel tanpa CSS** sesuai instruksi praktikum
5. **Array multidimensional** untuk menyimpan multiple data mahasiswa

---

## ✨ Perbedaan dengan Praktikum 02

| Aspek | Praktikum 02 | Praktikum 03 |
|-------|--------------|--------------|
| Data Structure | Single object | Array of arrays |
| Jumlah Data | 1 mahasiswa | 5 mahasiswa |
| View Type | List vertikal | Tabel horizontal |
| Looping | Tidak ada | @foreach |
| Styling | CSS inline | Tanpa CSS |
| Kolom | 6 field | 5 kolom |
| Aksi | Tidak ada | Edit & Hapus |

---

## 🎓 Pembelajaran Selanjutnya

**Praktikum 04: Master Template**
- Implementasi template Bootstrap (Quixlab)
- Layout master dengan @extends dan @section
- Template inheritance
- Sidebar navigation

---

## 📊 Statistik

- **Jumlah Data:** 5 mahasiswa
- **Jumlah Kolom:** 5 (NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI)
- **Blade Directives:** @foreach, {{ }}
- **HTML Elements:** table, thead, tbody, tr, th, td

---

**Selesai:** 13 April 2026  
**Durasi:** ~20 menit  
**Tingkat Kesulitan:** ⭐⭐☆☆☆ (Mudah)
