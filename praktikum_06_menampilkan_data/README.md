# Praktikum 06: Menampilkan Data dari Database

**Status:** ✅ Selesai

Tutorial menampilkan data dari database dengan Eloquent Accessor untuk transformasi data otomatis.

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Menampilkan data mahasiswa dari database
- Menggunakan Eloquent Accessor untuk transformasi data
- Merelasikan model Mahasiswa dengan ProgramStudi
- Mengubah format jenis kelamin (L → Laki-laki, P → Perempuan)
- Mengubah format nama fakultas menjadi Title Case

## 🚀 Quick Start

```bash
# Masuk ke folder project
cd praktikum_06_menampilkan_data/praktikum_laravel

# Install dependencies (jika belum)
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
- [SUMMARY.md](docs/SUMMARY.md) - Ringkasan implementasi

## ✨ Fitur Baru

### Eloquent Accessor

**1. Jenis Kelamin Otomatis**
- L → "Laki-laki"
- P → "Perempuan"

**2. Fakultas Title Case**
- "fakultas teknologi informasi" → "Fakultas Teknologi Informasi"

**3. Relasi Prodi**
- Akses data program studi melalui `$mahasiswa->prodi`

---

**Previous:** [Praktikum 05 - Migration, Model, Seeder](../praktikum_05_migration_model_seeder/README.md)  
**Next:** Praktikum 07 - Relasi Database
