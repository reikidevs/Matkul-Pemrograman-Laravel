# Praktikum 10: Membuat CRUD Program Studi

**Status:** ✅ Selesai

Implementasi CRUD (Create, Read, Update, Delete) lengkap untuk mengelola data Program Studi, menggunakan pattern yang sama dengan CRUD Mahasiswa.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Mampu membuat CRUD baru secara mandiri berdasarkan pattern yang sudah dipelajari
- Membuat Controller, Views, dan Routes untuk entitas baru (Program Studi)
- Mengimplementasikan validasi input, notifikasi, dan konfirmasi delete
- Menerapkan Route Model Binding pada entitas baru
- Menangani referential integrity (tidak bisa hapus prodi jika masih ada mahasiswa)

## 🚀 Quick Start

```bash
cd praktikum_10_crud_program_studi/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate

# Setup database di .env
# DB_DATABASE=akademik
# DB_USERNAME=root
# DB_PASSWORD=

php artisan migrate:fresh --seed
php artisan serve
```

Akses:
- Dashboard: **http://localhost:8000**
- Mahasiswa: **http://localhost:8000/mahasiswa**
- Program Studi: **http://localhost:8000/prodi**

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap step-by-step
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan dari Praktikum 09

## ✨ Fitur CRUD Program Studi

### 1. Index (Read)
- Menampilkan daftar semua program studi
- Menampilkan jumlah mahasiswa per prodi (`withCount`)
- Tombol Tambah, Edit, dan Hapus

### 2. Create
- Form tambah program studi (kode, nama, fakultas, jenjang)
- Validasi input lengkap
- Flash message berhasil/gagal

### 3. Edit / Update
- Form edit dengan data terisi otomatis
- `getRawOriginal('fakultas')` untuk bypass accessor
- Method spoofing PUT

### 4. Delete
- Konfirmasi JavaScript sebelum hapus
- Cek referential integrity (tolak hapus jika masih ada mahasiswa)
- Flash message berhasil/gagal

---

**Previous:** [Praktikum 09 - Hapus Data](../praktikum_09_hapus_data/README.md)
