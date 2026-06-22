# PBKK Laravel Tutorial 2026

Tutorial Laravel step-by-step untuk Mata Kuliah Pemrograman Berbasis Kerangka Kerja (PBKK)

**Dosen:** Ahmad Rifa'i, S.Kom., M.Kom  
**Universitas:** Universitas Semarang  
**Semester:** Genap 2025/2026

---

> 🆕 **Pemula? Baca [TUTORIAL.md](TUTORIAL.md) lebih dulu!**
> Panduan lengkap step-by-step dari nol (install tools → CRUD database), ditulis khusus untuk pemula.

> 🟢 **Pakai Laragon atau XAMPP?** Baca **[PANDUAN_LARAGON_XAMPP.md](PANDUAN_LARAGON_XAMPP.md)** — panduan setup super detail khusus pengguna Laragon & XAMPP (cocok untuk pemula total).

---

## 📚 Daftar Praktikum

| No  | Praktikum                      | Folder                                                                         | Status     | Materi                                            |
| --- | ------------------------------ | ------------------------------------------------------------------------------ | ---------- | ------------------------------------------------- |
| 01  | Install Laravel                | [`praktikum_01_install/`](praktikum_01_install/)                               | ✅ Selesai | Install Laravel, struktur folder, jalankan server |
| 02  | Routing & Controller           | [`praktikum_02_routing_controller/`](praktikum_02_routing_controller/)         | ✅ Selesai | Route, Controller, parameter, kirim data ke view  |
| 03  | Blade Template                 | [`praktikum_03_blade_template/`](praktikum_03_blade_template/)                 | ✅ Selesai | View, Blade syntax, `@foreach`, tampilkan data    |
| 04  | Master Template                | [`praktikum_04_master_template/`](praktikum_04_master_template/)               | ✅ Selesai | Layout master, `@extends`, `@yield`, Bootstrap    |
| 05  | Migration, Model, Seeder       | [`praktikum_05_migration_model_seeder/`](praktikum_05_migration_model_seeder/) | ✅ Selesai | Database, migration, model, seeder, relasi        |
| 06  | Menampilkan Data dari Database | [`praktikum_06_menampilkan_data/`](praktikum_06_menampilkan_data/)             | ✅ Selesai | Eloquent query, relasi, accessor                  |
| 07  | Menambah Data (Create)         | [`praktikum_07_create_data/`](praktikum_07_create_data/)                       | ✅ Selesai | Form input, CSRF, validasi, flash message         |
| 08  | Mengedit Data (Update)         | [`praktikum_08_edit_update/`](praktikum_08_edit_update/)                       | ✅ Selesai | Route Model Binding, method spoofing PUT          |
| 09  | Menghapus Data (Delete)        | [`praktikum_09_hapus_data/`](praktikum_09_hapus_data/)                         | ✅ Selesai | Method DELETE, konfirmasi JavaScript              |
| 10  | CRUD Program Studi             | [`praktikum_10_crud_program_studi/`](praktikum_10_crud_program_studi/)         | ✅ Selesai | CRUD mandiri, integritas referensial              |

### 🎓 Projek

| No  | Projek                 | Folder                                                               | Materi                            |
| --- | ---------------------- | -------------------------------------------------------------------- | --------------------------------- |
| 01  | Analisis & Perancangan | [`projek_01_analisis_perancangan/`](projek_01_analisis_perancangan/) | Use case, ERD, mockup aplikasi    |
| 02  | Implementasi (KostKu)  | [`projek_02_implementasi/`](projek_02_implementasi/)                 | Aplikasi manajemen kos multi-role |

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

| Aspek                            | Bobot |
| -------------------------------- | ----- |
| Partisipatif (Kehadiran & Aktif) | 10%   |
| Kuis                             | 10%   |
| Tugas                            | 30%   |
| Projek                           | 50%   |

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
