# Praktikum 05: Migration, Model, Seeder

**Status:** 🔜 Coming Soon

**Tujuan Pembelajaran:**
- Mahasiswa mampu membuat database dengan migration
- Memahami konsep Model di Laravel (Eloquent ORM)
- Menggunakan seeder untuk populate data
- Konfigurasi database connection

---

## 📋 Instruksi Praktikum

> **Setup Database:**
> - Buat database `akademik`
> - Konfigurasi Database di file `.env`
> - Buat Migrate, Model, dan Seeder untuk tabel `mahasiswa` dan `program_studi`
> - Desain tabel mengikuti file PBKK T05 - Desain Tabel
> - Running Migrate, Model, dan Seeder hingga tabel muncul dalam database akademik

---

## 🚀 Persiapan

Copy project dari Praktikum 04:

**Linux/Mac:**
```bash
cp -r praktikum_04_master_template/praktikum_laravel praktikum_05_migration_model_seeder/
```

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse praktikum_04_master_template/praktikum_laravel praktikum_05_migration_model_seeder/
```

---

## 📝 Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```

---

## 📚 Materi yang Akan Dipelajari

### 1. Migration
- Membuat migration untuk tabel `mahasiswa`
- Membuat migration untuk tabel `program_studi`
- Menjalankan migration

### 2. Model
- Membuat model `Mahasiswa`
- Membuat model `ProgramStudi`
- Konfigurasi fillable/guarded

### 3. Seeder
- Membuat seeder untuk data dummy
- Menjalankan seeder
- Populate database dengan data

### 4. Relasi Database
- One-to-many relationship
- Foreign key constraint

---

## 🗄️ Desain Tabel

### Tabel: program_studi
| Field | Type | Key |
|-------|------|-----|
| id | bigint | PK |
| kode_prodi | varchar(10) | |
| nama_prodi | varchar(100) | |
| created_at | timestamp | |
| updated_at | timestamp | |

### Tabel: mahasiswa
| Field | Type | Key |
|-------|------|-----|
| id | bigint | PK |
| nim | varchar(20) | |
| nama | varchar(100) | |
| tempat_lahir | varchar(50) | |
| tgl_lahir | date | |
| jenis_kelamin | enum('L','P') | |
| program_studi_id | bigint | FK |
| created_at | timestamp | |
| updated_at | timestamp | |

---

## 🎯 Command yang Akan Digunakan

```bash
# Membuat migration
php artisan make:migration create_program_studi_table
php artisan make:migration create_mahasiswa_table

# Membuat model
php artisan make:model ProgramStudi
php artisan make:model Mahasiswa

# Membuat seeder
php artisan make:seeder ProgramStudiSeeder
php artisan make:seeder MahasiswaSeeder

# Menjalankan migration
php artisan migrate

# Menjalankan seeder
php artisan db:seed
```

---

**Previous:** [Praktikum 04 - Master Template](../praktikum_04_master_template/README.md)  
**Next:** [Praktikum 06 - Menampilkan Data dari Database](../praktikum_06_database/README.md)
