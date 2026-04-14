# Summary - Praktikum 02: Routing & Controller

## ✅ Status: SELESAI

---

## 📋 Yang Sudah Dikerjakan

### 1. Setup Project
- ✅ Copy project dari Praktikum 01
- ✅ Project siap digunakan

### 2. Controller
- ✅ Membuat `MahasiswaController.php`
- ✅ Method `index()` dengan data mahasiswa dummy
- ✅ Method `show($id)` untuk menampilkan detail berdasarkan ID

### 3. Routing
- ✅ Route `/mahasiswa` → MahasiswaController@index
- ✅ Route `/mahasiswa/{id}` → MahasiswaController@show
- ✅ Route `/mahasiswa/{nim}/{nama}` → Closure function

### 4. View
- ✅ Membuat folder `resources/views/mahasiswa/`
- ✅ Membuat file `index.blade.php`
- ✅ Styling dengan CSS inline
- ✅ Menampilkan 6 field data mahasiswa

---

## 🎯 Hasil yang Dicapai

### Data Mahasiswa yang Ditampilkan:
- NIM: G.131.24.0001
- Nama: KURNIAWAN
- Tempat Lahir: Semarang
- Tanggal Lahir: 2005-01-15
- Jenis Kelamin: Laki-laki
- Program Studi: Sistem Informasi

### URL yang Berfungsi:
1. **http://localhost:8000/mahasiswa**
   - Menampilkan halaman data mahasiswa dengan styling
   
2. **http://localhost:8000/mahasiswa/10**
   - Output: "Menampilkan mahasiswa dengan ID: 10"
   
3. **http://localhost:8000/mahasiswa/G.131.24.0001/KURNIAWAN**
   - Output: "NIM: G.131.24.0001, Nama: KURNIAWAN"

---

## 📚 Konsep yang Dipelajari

### 1. Routing
- Cara mendefinisikan route di `routes/web.php`
- Route dengan parameter `{id}`
- Route dengan multiple parameter `{nim}/{nama}`
- Route dengan closure function
- Route dengan controller method

### 2. Controller
- Struktur controller di Laravel
- Namespace dan use statement
- Method dalam controller
- Passing data ke view dengan `compact()`
- Return view dari controller

### 3. View (Blade)
- Blade syntax `{{ }}`
- Array access di Blade
- HTML structure
- CSS inline styling
- Link navigation

### 4. MVC Flow
```
User Request → Route → Controller → View → Response
```

---

## 🔍 Struktur File

```
praktikum_02_routing_controller/
└── praktikum_laravel/
    ├── app/
    │   └── Http/
    │       └── Controllers/
    │           └── MahasiswaController.php  ← BARU
    ├── resources/
    │   └── views/
    │       └── mahasiswa/                   ← BARU
    │           └── index.blade.php          ← BARU
    └── routes/
        └── web.php                          ← MODIFIED
```

---

## 🚀 Cara Menjalankan

```bash
cd praktikum_02_routing_controller/praktikum_laravel
php artisan serve
```

Buka browser: http://localhost:8000/mahasiswa

---

## 📝 Catatan Penting

1. **Controller** adalah penghubung antara Route dan View
2. **Route** menentukan URL mana yang akan diproses
3. **View** menampilkan data yang dikirim dari Controller
4. **Blade** adalah template engine Laravel dengan syntax `{{ }}`
5. **compact()** adalah helper untuk passing data ke view

---

## ✨ Perbedaan dengan Praktikum 01

| Aspek | Praktikum 01 | Praktikum 02 |
|-------|--------------|--------------|
| Route | Hanya `/` | Tambah `/mahasiswa` |
| Controller | Tidak ada | Ada MahasiswaController |
| View | Hanya welcome.blade.php | Tambah mahasiswa/index.blade.php |
| Data | Tidak ada | Ada data mahasiswa dummy |
| Konsep | Setup Laravel | Routing & Controller |

---

## 🎓 Pembelajaran Selanjutnya

**Praktikum 03: Blade Template**
- Menampilkan data dalam bentuk tabel
- Looping dengan @foreach
- Menampilkan multiple data mahasiswa

---

**Selesai:** 13 April 2026  
**Durasi:** ~30 menit  
**Tingkat Kesulitan:** ⭐⭐☆☆☆ (Mudah)
