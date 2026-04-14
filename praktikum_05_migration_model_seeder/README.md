# Praktikum 05: Migration, Model, Seeder

**Status:** 🔜 Ready

Tutorial membuat migration, model, dan seeder untuk database di Laravel.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Membuat migration untuk database schema
- Membuat model Eloquent
- Membuat seeder untuk data dummy
- Menjalankan migration dan seeder

## 🚀 Quick Start

```bash
# Masuk ke folder project
cd praktikum_05_migration_model_seeder/praktikum_laravel

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database di .env
# DB_DATABASE=akademik
# DB_USERNAME=root
# DB_PASSWORD=

# Jalankan migration
php artisan migrate

# Jalankan seeder
php artisan db:seed

# Jalankan server
php artisan serve
```

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap migration, model, dan seeder

---

**Previous:** [Praktikum 04 - Master Template](../praktikum_04_master_template/README.md)  
**Next:** Praktikum 06 - Menampilkan Data dari Database
