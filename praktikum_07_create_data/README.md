# Praktikum 07: Menambah Data Mahasiswa (Create)

**Status:** ✅ Selesai

Implementasi fitur tambah data mahasiswa (CRUD - Create) dengan form input, validasi, dan notifikasi.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Memahami konsep CRUD (Create, Read, Update, Delete) di Laravel
- Membuat form input dengan Blade
- Menggunakan method POST dan CSRF token
- Implementasi validasi input
- Menampilkan notifikasi flash message

## 🚀 Quick Start

```bash
cd praktikum_07_create_data/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Akses: http://localhost:8000/mahasiswa

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan dari Praktikum 06

---

**Previous:** [Praktikum 06](../praktikum_06_menampilkan_data/README.md)  
**Next:** [Praktikum 08](../praktikum_08_edit_update/README.md)
