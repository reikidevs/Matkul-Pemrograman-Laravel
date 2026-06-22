# Praktikum 08: Mengedit Data Mahasiswa (Edit & Update)

**Status:** ✅ Selesai

Implementasi fitur edit dan update data mahasiswa (CRUD - Update) dengan Route Model Binding dan method spoofing PUT.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Memahami Route Model Binding di Laravel
- Implementasi method spoofing dengan `@method('PUT')`
- Membuat form edit yang otomatis terisi data lama
- Update data dengan validasi unique-except-self
- Mengelola flash message untuk update

## 🚀 Quick Start

```bash
cd praktikum_08_edit_update/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Akses: http://localhost:8000/mahasiswa, lalu klik tombol Edit pada salah satu data.

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan dari Praktikum 07

---

**Previous:** [Praktikum 07](../praktikum_07_create_data/README.md)  
**Next:** [Praktikum 09](../praktikum_09_hapus_data/README.md)
