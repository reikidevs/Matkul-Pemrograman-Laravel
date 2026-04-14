# Testing Guide - Praktikum 02

Panduan untuk testing hasil praktikum 02.

---

## 🧪 Checklist Testing

### 1. Setup & Installation
- [ ] Project berhasil di-copy dari Praktikum 01
- [ ] `composer install` berhasil (jika diperlukan)
- [ ] `.env` file sudah ada
- [ ] `php artisan serve` berjalan tanpa error

### 2. Route Testing
- [ ] Route `/` masih berfungsi (halaman welcome)
- [ ] Route `/mahasiswa` berfungsi
- [ ] Route `/mahasiswa/10` berfungsi
- [ ] Route `/mahasiswa/G.131.24.0001/KURNIAWAN` berfungsi

### 3. Controller Testing
- [ ] File `MahasiswaController.php` ada di `app/Http/Controllers/`
- [ ] Method `index()` ada dan berfungsi
- [ ] Method `show($id)` ada dan berfungsi
- [ ] Data mahasiswa ter-define dengan benar

### 4. View Testing
- [ ] Folder `mahasiswa/` ada di `resources/views/`
- [ ] File `index.blade.php` ada
- [ ] View menampilkan semua 6 field data mahasiswa
- [ ] Styling CSS berfungsi
- [ ] Link "Kembali ke Home" berfungsi

---

## 🔍 Manual Testing

### Test 1: Halaman Mahasiswa
```
URL: http://localhost:8000/mahasiswa
Expected: Halaman dengan data mahasiswa lengkap
```

**Checklist:**
- [ ] Judul "Data Mahasiswa" muncul
- [ ] NIM: G.131.24.0001 muncul
- [ ] Nama: KURNIAWAN muncul
- [ ] Tempat Lahir: Semarang muncul
- [ ] Tanggal Lahir: 2005-01-15 muncul
- [ ] Jenis Kelamin: Laki-laki muncul
- [ ] Program Studi: Sistem Informasi muncul
- [ ] Background putih dengan shadow
- [ ] Link "Kembali ke Home" ada

### Test 2: Route dengan Parameter ID
```
URL: http://localhost:8000/mahasiswa/10
Expected: "Menampilkan mahasiswa dengan ID: 10"
```

**Checklist:**
- [ ] Text muncul dengan benar
- [ ] ID yang ditampilkan sesuai dengan URL

### Test 3: Route dengan Multiple Parameter
```
URL: http://localhost:8000/mahasiswa/G.131.24.0001/KURNIAWAN
Expected: "NIM: G.131.24.0001, Nama: KURNIAWAN"
```

**Checklist:**
- [ ] Text muncul dengan benar
- [ ] NIM dan Nama sesuai dengan URL

### Test 4: Route List
```bash
php artisan route:list
```

**Expected Output:**
```
GET|HEAD   mahasiswa .................. MahasiswaController@index
GET|HEAD   mahasiswa/{id} ............. MahasiswaController@show
GET|HEAD   mahasiswa/{nim}/{nama} .....
```

**Checklist:**
- [ ] Route `/mahasiswa` terdaftar
- [ ] Route `/mahasiswa/{id}` terdaftar
- [ ] Route `/mahasiswa/{nim}/{nama}` terdaftar

---

## 🐛 Common Issues & Solutions

### Issue 1: "Target class [MahasiswaController] does not exist"
**Solusi:**
```bash
composer dump-autoload
```

### Issue 2: "View [mahasiswa.index] not found"
**Solusi:**
- Pastikan folder `resources/views/mahasiswa/` ada
- Pastikan file `index.blade.php` ada di folder tersebut
- Cek nama file (case-sensitive)

### Issue 3: "Undefined array key 'nim'"
**Solusi:**
- Cek array `$mahasiswa` di controller
- Pastikan semua key ada: nim, nama, tempat_lahir, tgl_lahir, jenis_kelamin, prodi

### Issue 4: Styling tidak muncul
**Solusi:**
- Cek tag `<style>` di view
- Pastikan CSS ada di dalam tag `<head>`

### Issue 5: Route tidak ditemukan (404)
**Solusi:**
```bash
php artisan route:clear
php artisan route:cache
```

---

## ✅ Acceptance Criteria

Praktikum 02 dianggap **SELESAI** jika:

1. ✅ Controller `MahasiswaController` berhasil dibuat
2. ✅ Route `/mahasiswa` berfungsi dan menampilkan data
3. ✅ View menampilkan 6 field data mahasiswa
4. ✅ Route dengan parameter berfungsi
5. ✅ Tidak ada error saat dijalankan
6. ✅ Styling tampil dengan baik

---

## 📸 Screenshot Checklist

Ambil screenshot untuk dokumentasi:
- [ ] Halaman `/mahasiswa` (full page)
- [ ] Output `php artisan route:list`
- [ ] Browser console (no errors)

---

## 🎯 Performance Testing (Opsional)

### Load Time
- [ ] Halaman load < 1 detik
- [ ] No console errors
- [ ] No PHP errors

### Code Quality
- [ ] Controller mengikuti PSR standards
- [ ] View menggunakan Blade syntax dengan benar
- [ ] Route terdefinisi dengan jelas

---

**Testing Completed:** ___/___/2026  
**Tested By:** _______________  
**Result:** ☐ PASS ☐ FAIL
