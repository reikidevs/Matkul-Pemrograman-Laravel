# Praktikum 05: Migration, Model, Seeder

**Status:** ✅ Selesai

Tutorial membuat migration, model, dan seeder untuk mengelola database di Laravel.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Membuat migration untuk struktur database
- Membuat model Eloquent ORM
- Membuat seeder untuk data dummy
- Memahami relasi One-to-Many
- Menggunakan data dari database

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

# Jalankan migration dan seeder
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve
```

Buka browser: **http://localhost:8000/mahasiswa**

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap step-by-step
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan dari praktikum sebelumnya

## 🗄️ Database

**Tabel yang dibuat:**
- `program_studis` - Data program studi (6 data)
- `mahasiswas` - Data mahasiswa (10 data)

**Relasi:**
- One program studi has many mahasiswa
- Many mahasiswa belong to one program studi

---

**Previous:** [Praktikum 04 - Master Template](../praktikum_04_master_template/README.md)  
**Next:** Praktikum 06 - Menampilkan Data dari Database
