# Praktikum 09: Menghapus Data Mahasiswa (Delete)

**Status:** ✅ Selesai

Implementasi fitur hapus data mahasiswa (CRUD - Delete) dengan konfirmasi JavaScript dan method spoofing DELETE.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Memahami HTTP method DELETE
- Implementasi method spoofing dengan `@method('DELETE')`
- Membuat konfirmasi delete dengan JavaScript `confirm()`
- Menghapus data dari database dengan Eloquent
- Menampilkan notifikasi delete berhasil/gagal

## 🚀 Quick Start

```bash
cd praktikum_09_hapus_data/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Akses: http://localhost:8000/mahasiswa, lalu klik tombol Hapus pada salah satu data.

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan dari Praktikum 08

---

**Previous:** [Praktikum 08](../praktikum_08_edit_update/README.md)
