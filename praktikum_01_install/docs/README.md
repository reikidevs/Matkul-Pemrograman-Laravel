# Praktikum 01: Install Laravel

**Tujuan Pembelajaran:**
- Mahasiswa mampu menginstall Laravel
- Memahami struktur folder Laravel
- Menjalankan Laravel development server
- Melihat halaman welcome Laravel

---

## 📋 Persyaratan

Pastikan sudah terinstall:
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 8.0 atau lebih tinggi

Cek versi:
```bash
php --version
composer --version
mysql --version
```

---

## 🚀 Langkah-Langkah Praktikum

### 1. Install Laravel

Buka terminal/command prompt, masuk ke folder `praktikum_01_install`:

```bash
cd praktikum_01_install
```

Install Laravel dengan nama project `praktikum_laravel`:

```bash
composer create-project --prefer-dist laravel/laravel praktikum_laravel
```

**Catatan:** Proses ini akan memakan waktu beberapa menit tergantung koneksi internet.

---

### 2. Masuk ke Folder Project

```bash
cd praktikum_laravel
```

---

### 3. Jalankan Laravel Server

```bash
php artisan serve
```

Output yang muncul:
```
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

---

### 4. Buka Browser

Akses: **http://localhost:8000**

Anda akan melihat halaman welcome Laravel dengan tampilan modern.

---

## 📁 Struktur Folder Laravel

Setelah install, struktur folder Laravel:

```
praktikum_laravel/
├── app/                    # Logika aplikasi (Models, Controllers)
│   ├── Http/
│   │   └── Controllers/   # Semua controller
│   └── Models/            # Semua model (User.php sudah ada)
├── bootstrap/             # Bootstrap framework
├── config/                # File konfigurasi
├── database/              # Migration, seeder, factory
│   └── migrations/        # File migration
├── public/                # Assets publik (CSS, JS, images)
│   └── index.php         # Entry point aplikasi
├── resources/             # View, assets mentah
│   └── views/            # Semua file Blade template
│       └── welcome.blade.php
├── routes/                # Routing aplikasi
│   ├── web.php           # Routes untuk web
│   └── api.php           # Routes untuk API
├── storage/               # File generated, logs, cache
├── tests/                 # Unit testing
├── vendor/                # Dependencies (jangan di-edit!)
├── .env                   # Environment variables (database config)
├── .env.example           # Template .env
├── artisan                # CLI tool Laravel
├── composer.json          # Dependencies PHP
└── package.json           # Dependencies JavaScript
```

---

## 🔍 Folder Penting yang Sering Digunakan

| Folder | Fungsi |
|--------|--------|
| `app/Http/Controllers/` | Tempat semua controller |
| `app/Models/` | Tempat semua model |
| `resources/views/` | Tempat semua view (Blade) |
| `routes/web.php` | Routing untuk aplikasi web |
| `database/migrations/` | File migration database |
| `public/` | Assets publik (CSS, JS, images) |
| `.env` | Konfigurasi environment (database, dll) |

---

## 📝 File Penting

### 1. `.env` - Environment Configuration

File ini berisi konfigurasi aplikasi:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan:** File `.env` tidak di-push ke Git (sudah ada di .gitignore)

---

### 2. `routes/web.php` - Web Routes

File ini berisi routing aplikasi:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
```

Route di atas artinya: ketika user akses `/`, tampilkan view `welcome.blade.php`

---

### 3. `resources/views/welcome.blade.php` - Welcome View

File ini adalah halaman welcome yang Anda lihat di browser.

---

## ✅ Checklist Praktikum

- [ ] PHP, Composer, MySQL sudah terinstall
- [ ] Laravel berhasil diinstall dengan nama `praktikum_laravel`
- [ ] Server berhasil dijalankan dengan `php artisan serve`
- [ ] Halaman welcome Laravel muncul di browser
- [ ] Memahami struktur folder Laravel
- [ ] Mengetahui folder-folder penting

---

## 🆘 Troubleshooting

### Error: "composer: command not found"
**Solusi:** Install Composer dari https://getcomposer.org/

### Error: "php: command not found"
**Solusi:** Install PHP atau tambahkan PHP ke PATH

### Error: "No application encryption key"
**Solusi:**
```bash
php artisan key:generate
```

### Error: Port 8000 sudah digunakan
**Solusi:** Gunakan port lain
```bash
php artisan serve --port=8001
```

### Error: "Your requirements could not be resolved"
**Solusi:** Cek versi PHP, pastikan minimal 8.1

---

## 📸 Screenshot

Setelah berhasil, Anda akan melihat:
- Halaman welcome Laravel dengan logo Laravel
- Tampilan modern dengan dark mode toggle
- Link ke dokumentasi Laravel

---

## 🎯 Tugas

**Instruksi Praktikum:**
> Silahkan install laravel minimal versi 10 dengan nama projek `praktikum_laravel`

**Status:** ✅ Selesai

---

## 📚 Referensi

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Installation Guide](https://laravel.com/docs/installation)
- [Composer Documentation](https://getcomposer.org/doc/)

---

**Next:** [Praktikum 02 - Routing & Controller](../praktikum_02_routing_controller/README.md)
