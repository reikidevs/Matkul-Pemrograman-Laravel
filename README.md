# PBKK Laravel Tutorial 2026

Tutorial Laravel step-by-step untuk Mata Kuliah Pemrograman Berbasis Kerangka Kerja (PBKK)

**Dosen:** Ahmad Rifa'i, S.Kom., M.Kom  
**Universitas:** Universitas Semarang  
**Semester:** Genap 2025/2026

---

## 📚 Daftar Praktikum

| No | Praktikum | Folder | Status | Materi |
|----|-----------|--------|--------|--------|
| 01 | Install Laravel | [`praktikum_01_install/`](praktikum_01_install/) | ✅ Selesai | Install Laravel, struktur folder, jalankan server |
| 02 | Routing & Controller | [`praktikum_02_routing_controller/`](praktikum_02_routing_controller/) | ✅ Selesai | Route, Controller, parameter, resource route |
| 03 | Blade Template | [`praktikum_03_blade_template/`](praktikum_03_blade_template/) | ✅ Selesai | View, Blade syntax, tampilkan data mahasiswa |
| 04 | Master Template | [`praktikum_04_master_template/`](praktikum_04_master_template/) | ✅ Selesai | Layout master, template inheritance |
| 05 | Migration, Model, Seeder | [`praktikum_05_migration_model_seeder/`](praktikum_05_migration_model_seeder/) | 🔜 Ready | Database, migration, model, seeder |
| 06 | Menampilkan Data dari Database | `praktikum_06_database/` | ⏳ Coming | Eloquent ORM, query data |
| 07 | Relasi Database | `praktikum_07_relasi/` | ⏳ Coming | One-to-many, many-to-many |
| 08 | CRUD Create | `praktikum_08_create/` | ⏳ Coming | Form input, validasi, simpan data |
| 09 | CRUD Edit & Delete | `praktikum_09_edit_delete/` | ⏳ Coming | Update dan hapus data |
| 10 | Validasi | `praktikum_10_validasi/` | ⏳ Coming | Form validation, error handling |

---

## 🚀 Cara Menggunakan Repository Ini

### 1. Clone Repository
```bash
git clone https://github.com/username/pbkk-laravel-2026.git
cd pbkk-laravel-2026
```

### 2. Pilih Praktikum yang Mau Dipelajari
```bash
# Contoh: Praktikum 02
cd praktikum_02_routing_controller/praktikum_laravel
```

### 3. Install Dependencies
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 4. Jalankan Server
```bash
php artisan serve
```

### 5. Buka Browser
```
http://localhost:8000
```

---

## 📋 Persyaratan Sistem

- **PHP:** 8.1 - 8.4 (sesuai versi Laravel)
- **Composer:** Latest version
- **MySQL:** 8.0 ke atas
- **Code Editor:** VSCode, Sublime Text, atau lainnya
- **Database Client:** PHPMyAdmin, DBeaver, HeidiSQL, atau lainnya

### Cek Versi
```bash
php --version
composer --version
mysql --version
```

---

## 📝 Catatan Penting

- ✅ Setiap folder adalah project Laravel yang **independen**
- ✅ Jangan lupa `composer install` setiap kali pindah folder
- ✅ File `.env` harus di-copy dari `.env.example`
- ✅ Jika ada error, cek apakah sudah `php artisan key:generate`
- ✅ Setiap praktikum memiliki README.md sendiri dengan penjelasan detail

---

## 🆘 Troubleshooting

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: Database connection
- Cek file `.env`
- Pastikan MySQL sudah jalan
- Sesuaikan `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

### Error: "composer: command not found"
- Install Composer dari https://getcomposer.org/

### Error: Port 8000 sudah digunakan
```bash
php artisan serve --port=8001
```

---

## 📖 Struktur Pembelajaran

Setiap praktikum dibangun **incremental** dari praktikum sebelumnya:

```
Praktikum 01 (Install)
    ↓
Praktikum 02 (Routing & Controller) ← Copy dari 01 + tambahan
    ↓
Praktikum 03 (Blade Template) ← Copy dari 02 + tambahan
    ↓
Praktikum 04 (Master Template) ← Copy dari 03 + tambahan
    ↓
... dan seterusnya
```

---

## 🎯 Penilaian

| Aspek | Bobot |
|-------|-------|
| Partisipatif (Kehadiran & Aktif) | 10% |
| Kuis | 10% |
| Tugas | 30% |
| Projek | 50% |

---

## 📞 Kontak & Komunikasi

- **Telegram Group:** https://t.me/+yQaQEQAi8c44YjFl
- **E-Learning:** elearning.usm.ac.id
- **Presensi:** sima.usm.ac.id

---

## 📄 Lisensi

Repository ini dibuat untuk keperluan pembelajaran mata kuliah PBKK di Universitas Semarang.

---

**Selamat Belajar! 🚀**
