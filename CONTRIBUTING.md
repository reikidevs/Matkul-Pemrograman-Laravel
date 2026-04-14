# Contributing Guide

Panduan untuk berkontribusi ke repository PBKK Laravel 2026.

---

## 🎯 Tujuan Repository

Repository ini dibuat untuk membantu mahasiswa belajar Laravel secara bertahap melalui praktikum mingguan.

---

## 📁 Struktur Repository

```
pbkk-laravel-2026/
├── praktikum_01_install/
│   ├── praktikum_laravel/          # Laravel project
│   └── README.md                   # Dokumentasi praktikum
├── praktikum_02_routing_controller/
│   ├── praktikum_laravel/
│   └── README.md
├── ...
├── README.md                       # Dokumentasi utama
├── QUICK_START.md                  # Panduan cepat
├── PROGRESS.md                     # Tracking progress
└── .gitignore                      # Git ignore rules
```

---

## ✅ Checklist Sebelum Push

### 1. Pastikan .gitignore Bekerja

File yang **TIDAK** boleh di-push:
- `vendor/` - Dependencies PHP
- `node_modules/` - Dependencies JavaScript
- `.env` - Environment variables (sensitive data)
- `storage/logs/` - Log files
- `storage/framework/cache/` - Cache files

File yang **HARUS** di-push:
- Struktur folder Laravel
- File `.env.example`
- Semua file source code (Controllers, Models, Views, Routes)
- File `composer.json` dan `composer.lock`
- File README.md setiap praktikum

### 2. Test Sebelum Push

```bash
# Test apakah Laravel bisa dijalankan
cd praktikum_XX/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

### 3. Update Dokumentasi

Setiap praktikum harus punya:
- `README.md` dengan instruksi lengkap
- Checklist yang jelas
- Contoh code yang bisa di-copy
- Screenshot hasil (opsional)

---

## 📝 Format Commit Message

Gunakan format yang jelas:

```
[PraktikumXX] Judul singkat

Deskripsi lebih detail (opsional)
```

**Contoh:**
```
[Praktikum01] Install Laravel 10

- Install Laravel 10.50.2
- Setup struktur folder
- Buat dokumentasi README.md
```

```
[Praktikum02] Implementasi Routing & Controller

- Buat MahasiswaController
- Tambah route /mahasiswa
- Buat view mahasiswa/index.blade.php
```

---

## 🔄 Workflow Git

### 1. Clone Repository
```bash
git clone https://github.com/username/pbkk-laravel-2026.git
cd pbkk-laravel-2026
```

### 2. Buat Branch Baru (Opsional)
```bash
git checkout -b praktikum-02
```

### 3. Kerjakan Praktikum
```bash
# Copy dari praktikum sebelumnya
cp -r praktikum_01_install/praktikum_laravel praktikum_02_routing_controller/

# Kerjakan praktikum...
```

### 4. Add & Commit
```bash
git add .
git commit -m "[Praktikum02] Implementasi Routing & Controller"
```

### 5. Push ke GitHub
```bash
git push origin main
# atau
git push origin praktikum-02
```

---

## 🚫 Apa yang TIDAK Boleh Di-push

1. **File .env** - Berisi sensitive data (database password, API keys)
2. **Folder vendor/** - Terlalu besar, bisa di-install ulang dengan `composer install`
3. **Folder node_modules/** - Terlalu besar, bisa di-install ulang dengan `npm install`
4. **File log** - Tidak perlu di-track
5. **File cache** - Generated files

---

## ✅ Apa yang HARUS Di-push

1. **Source code** - Controllers, Models, Views, Routes
2. **File konfigurasi** - composer.json, package.json, .env.example
3. **Dokumentasi** - README.md, QUICK_START.md, PROGRESS.md
4. **Assets** - CSS, JS, images (jika ada)

---

## 📊 Update Progress

Setiap selesai praktikum, update file `PROGRESS.md`:

```markdown
### Praktikum 02: Routing & Controller
- **Status:** ✅ Selesai
- **Tanggal:** 14 April 2026
- **Folder:** `praktikum_02_routing_controller/praktikum_laravel/`
- **Checklist:**
  - [x] Controller MahasiswaController dibuat
  - [x] Route /mahasiswa terdaftar
  - [x] View mahasiswa/index.blade.php dibuat
  - [x] Data mahasiswa tampil di browser
```

---

## 🆘 Troubleshooting Git

### Accidentally Pushed vendor/
```bash
# Remove from Git but keep locally
git rm -r --cached vendor/
git commit -m "Remove vendor from Git"
git push
```

### Accidentally Pushed .env
```bash
# Remove from Git
git rm --cached .env
git commit -m "Remove .env from Git"
git push

# IMPORTANT: Change all sensitive data (passwords, API keys)
```

### Large File Error
```bash
# Check file size
du -sh praktikum_XX/praktikum_laravel/vendor

# Make sure .gitignore is working
cat .gitignore
```

---

## 📞 Kontak

Jika ada pertanyaan tentang kontribusi:
- Telegram Group: https://t.me/+yQaQEQAi8c44YjFl
- E-Learning: elearning.usm.ac.id

---

**Terima kasih atas kontribusinya! 🙏**
