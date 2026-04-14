# Quick Start Guide - PBKK Laravel 2026

Panduan cepat untuk memulai praktikum Laravel.

---

## 🚀 Setup Awal (Hanya Sekali)

### 1. Clone Repository
```bash
git clone https://github.com/username/pbkk-laravel-2026.git
cd pbkk-laravel-2026
```

### 2. Cek Persyaratan Sistem
```bash
php --version    # Minimal PHP 8.1
composer --version
mysql --version  # Minimal MySQL 8.0
```

---

## 📚 Cara Menggunakan Setiap Praktikum

### Praktikum 01: Install Laravel (Sudah Selesai)

Praktikum 01 sudah berisi Laravel yang ter-install. Anda bisa langsung:

```bash
cd praktikum_01_install/praktikum_laravel
php artisan serve
```

Buka browser: http://localhost:8000

---

### Praktikum 02 dan Seterusnya (Copy dari Praktikum Sebelumnya)

**Langkah-langkah:**

#### 1. Copy Project dari Praktikum Sebelumnya
```bash
# Contoh: Copy dari praktikum 01 ke praktikum 02
cp -r praktikum_01_install/praktikum_laravel praktikum_02_routing_controller/
```

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse praktikum_01_install/praktikum_laravel praktikum_02_routing_controller/
```

#### 2. Masuk ke Folder Baru
```bash
cd praktikum_02_routing_controller/praktikum_laravel
```

#### 3. Install Dependencies (Jika Belum Ada vendor/)
```bash
composer install
```

#### 4. Copy File .env
```bash
cp .env.example .env
```

**Windows (PowerShell):**
```powershell
Copy-Item .env.example .env
```

#### 5. Generate Application Key
```bash
php artisan key:generate
```

#### 6. Jalankan Server
```bash
php artisan serve
```

#### 7. Mulai Kerjakan Praktikum
Ikuti instruksi di `README.md` folder praktikum tersebut.

---

## 🔄 Workflow Praktikum

```
Praktikum 01 (Fresh Install)
    ↓ Copy
Praktikum 02 (+ Routing & Controller)
    ↓ Copy
Praktikum 03 (+ Blade Template)
    ↓ Copy
Praktikum 04 (+ Master Template)
    ↓ Copy
... dan seterusnya
```

---

## ⚡ Tips & Tricks

### 1. Jangan Lupa Composer Install
Setiap kali copy project, jangan lupa:
```bash
composer install
```

### 2. Cek Route yang Tersedia
```bash
php artisan route:list
```

### 3. Clear Cache (Jika Ada Masalah)
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 4. Gunakan Port Lain (Jika Port 8000 Terpakai)
```bash
php artisan serve --port=8001
```

### 5. Lihat Log Error
```bash
# File log ada di:
storage/logs/laravel.log
```

---

## 🆘 Troubleshooting Umum

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Permission denied" (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### Error: Database connection
1. Buka file `.env`
2. Sesuaikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```
3. Pastikan MySQL sudah jalan

### Error: "composer: command not found"
Install Composer dari: https://getcomposer.org/

---

## 📖 Struktur Belajar

1. **Baca README.md** di folder praktikum
2. **Ikuti langkah-langkah** yang ada
3. **Eksperimen** dengan kode
4. **Cek hasil** di browser
5. **Commit** perubahan ke Git (opsional)

---

## 🎯 Checklist Setiap Praktikum

- [ ] Copy project dari praktikum sebelumnya
- [ ] `composer install`
- [ ] Copy `.env.example` ke `.env`
- [ ] `php artisan key:generate`
- [ ] Baca README.md praktikum
- [ ] Kerjakan instruksi praktikum
- [ ] Test di browser
- [ ] Selesai!

---

## 📞 Bantuan

Jika ada masalah:
1. Cek file `README.md` di folder praktikum
2. Cek section Troubleshooting di atas
3. Tanya di Telegram Group: https://t.me/+yQaQEQAi8c44YjFl

---

**Selamat Belajar! 🚀**
