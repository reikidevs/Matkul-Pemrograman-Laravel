# Changelog - Praktikum 02

## Perubahan dari Praktikum 01

### File Baru
1. **app/Http/Controllers/MahasiswaController.php**
   - Method `index()` - Menampilkan data mahasiswa
   - Method `show($id)` - Menampilkan mahasiswa berdasarkan ID

2. **resources/views/mahasiswa/index.blade.php**
   - View untuk menampilkan data mahasiswa
   - Styling dengan CSS inline
   - Menampilkan 6 field data mahasiswa

### File yang Dimodifikasi
1. **routes/web.php**
   - Tambah route `/mahasiswa` → MahasiswaController@index
   - Tambah route `/mahasiswa/{id}` → MahasiswaController@show
   - Tambah route `/mahasiswa/{nim}/{nama}` → Closure function

### Fitur yang Ditambahkan
- ✅ Routing dasar
- ✅ Route dengan parameter (single & multiple)
- ✅ Controller dengan data dummy
- ✅ View dengan Blade syntax
- ✅ Passing data dari controller ke view

### Konsep yang Dipelajari
1. **Routing**
   - Route::get() method
   - Route parameter
   - Route dengan closure
   - Route dengan controller

2. **Controller**
   - Membuat controller
   - Method dalam controller
   - Return view dengan data
   - Compact() helper

3. **View (Blade)**
   - Blade syntax {{ }}
   - Array access di Blade
   - HTML + CSS inline
   - Layout sederhana

---

**Tanggal:** 13 April 2026  
**Versi Laravel:** 10.50.2
