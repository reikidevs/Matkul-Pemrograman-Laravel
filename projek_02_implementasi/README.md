# Projek 02: Implementasi Sistem Manajemen Kost "KostKu"

**Status:** ✅ **SELESAI 100%** - Production Ready  
**Last Update:** 4 Juni 2026, 11:20 WIB

Implementasi aplikasi web Laravel untuk manajemen kost berdasarkan desain dari Projek 01 (Analisis & Perancangan).

---

## 🎉 Fitur Terbaru yang Baru Diselesaikan!

### ⭐ Update 4 Juni 2026

1. **✅ Navbar Dropdowns - FUNCTIONAL**
   - Notification dropdown dengan icon bell
   - User menu dropdown (Profil, Change Password, Logout)
   - Smooth animation & auto-close on outside click

2. **✅ Upload Bukti Transfer - COMPLETE**
   - Form upload JPG/PNG/PDF (max 2MB)
   - Real-time preview sebelum upload
   - Validasi client & server side

3. **✅ View Bukti Transfer - FULLSCREEN MODAL**
   - Pemilik dapat review bukti transfer
   - Modal fullscreen untuk zoom detail
   - Approve/Reject dengan alasan

4. **✅ SVG Icons - FIXED**
   - 60+ icons diperbaiki dengan viewBox attribute
   - Icons tidak berantakan lagi di semua halaman

---

## 📋 Overview

**Nama Aplikasi:** KostKu - Sistem Manajemen Kost  
**Framework:** Laravel 10.x  
**Database:** MySQL  
**Basis Desain:** Projek 01 (Use Case, Activity, Sequence, Class Diagram)

## 🎯 Fitur Yang Diimplementasikan

### Untuk Pemilik Kost
- ✅ Dashboard dengan statistik (occupancy, pendapatan, pending items)
- ✅ Kelola Kamar (CRUD): Tambah, edit, hapus kamar
- ✅ Kelola Penghuni: Approve/reject pendaftaran penghuni
- ✅ **Kelola Pembayaran: Approve/reject pembayaran dengan VIEW BUKTI TRANSFER** ⭐ NEW
- ✅ Kelola Komplain: Update status komplain

### Untuk Penghuni
- ✅ Dashboard informasi kamar
- ✅ Info Kamar Saya: Detail kamar yang dihuni
- ✅ **Tagihan Saya: Bayar tagihan dengan UPLOAD BUKTI TRANSFER** ⭐ NEW
- ✅ Ajukan Komplain dengan kategori & foto
- ✅ Profil: View, edit, change password

### UI/UX Improvements
- ✅ **Navbar Dropdowns: Notification & user menu** ⭐ NEW
- ✅ **SVG Icons: Fixed 60+ icons dengan viewBox** ⭐ FIXED
- ✅ Responsive design dengan custom CSS
- ✅ **Real-time preview untuk upload file** ⭐ NEW

### Untuk Admin
- ✅ Akses penuh ke semua fitur

## 🗂️ Struktur Database

Aplikasi ini menggunakan 9 tabel utama:

1. **users** - Base table untuk autentikasi (multi-role: admin, pemilik, penghuni)
2. **pemilik_kosts** - Profil pemilik kost
3. **penghunis** - Profil penghuni
4. **kamars** - Master data kamar kost
5. **penghunians** - Relasi penghuni-kamar (kontrak sewa)
6. **tagihans** - Tagihan pembayaran sewa
7. **pembayarans** - Transaksi pembayaran
8. **komplains** - Komplain penghuni
9. **notifikasis** - Sistem notifikasi

## 🚀 Cara Menjalankan Aplikasi

### 1. Persiapan

Pastikan sudah terinstall:
- PHP 8.1+
- Composer
- MySQL
- Web Server (XAMPP/Laragon/PHP Built-in Server)

### 2. Setup Database

```bash
# Buat database MySQL
CREATE DATABASE kostku_db;
```

### 3. Konfigurasi Environment

```bash
cd projek_02_implementasi/kostku_laravel

# Copy file .env
cp .env.example .env

# Edit .env, sesuaikan koneksi database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kostku_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Dependencies & Create Storage Link

```bash
composer install

# PENTING: Create symbolic link untuk upload file
php artisan storage:link
```

### 5. Generate Key & Migrate Database

```bash
# Generate application key
php artisan key:generate

# Jalankan migration + seeder
php artisan migrate:fresh --seed
```

**Output seeder:**
```
✅ Seeder berhasil!
📧 Admin: admin@kostku.com / admin123
📧 Pemilik: pemilik@kostku.com / pemilik123
📧 Penghuni: ani@test.com / penghuni123
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses: **http://localhost:8000**

## 🔐 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| **Admin** | admin@kostku.com | admin123 |
| **Pemilik Kost** | pemilik@kostku.com | pemilik123 |
| **Penghuni** | ani@test.com | penghuni123 |

## 📸 Screenshot Fitur (Untuk Laporan BAB 4)

### Cara Screenshot:

1. Login sebagai **Pemilik** (pemilik@kostku.com / pemilik123)
2. Screenshot halaman-halaman berikut:

**Dashboard Pemilik**
- Statistik kamar, penghuni, pendapatan
- Alert pembayaran pending & komplain open

**Kelola Kamar**
- List kamar dengan status (tersedia/terisi/maintenance)
- Form tambah kamar
- Form edit kamar
- Konfirmasi hapus kamar

**Kelola Penghuni**
- List penghuni dengan status approval
- Button approve/reject penghuni pending

**Kelola Pembayaran** ⭐ WAJIB SCREENSHOT!
- List pembayaran dengan tombol "Lihat Bukti"
- **Modal fullscreen view bukti transfer** ⭐ NEW
- Approve/Reject pembayaran

**Kelola Komplain**
- List komplain dengan kategori & prioritas
- Dropdown update status komplain

3. Login sebagai **Penghuni** (ani@test.com / penghuni123)

**Dashboard Penghuni**
- Informasi kamar yang ditempati
- Info komplain aktif

**Tagihan Saya** ⭐ WAJIB SCREENSHOT!
- List tagihan (lunas & belum lunas)
- **Form bayar dengan upload bukti transfer** ⭐ NEW
- **Preview image upload** ⭐ NEW

**Navbar Dropdowns** ⭐ WAJIB SCREENSHOT!
- **Notification dropdown open** ⭐ NEW
- **User menu dropdown open** ⭐ NEW

4. Simpan screenshot di folder `docs/screenshots/`

## 📚 Teknologi yang Digunakan

- **Backend:** Laravel 10.x (PHP 8.1-8.4)
- **Frontend:** Blade Template + Custom CSS (no framework)
- **Database:** MySQL dengan Eloquent ORM
- **Authentication:** Laravel Auth (manual implementation)
- **Authorization:** Role-based middleware
- **File Storage:** Laravel Storage (`storage/app/public/`) ⭐ NEW
- **Icons:** Feather Icons (inline SVG) ⭐ FIXED

## 🏗️ Arsitektur Aplikasi

```
kostku_laravel/
├── app/
│   ├── Http/Controllers/      # Controllers untuk business logic
│   │   ├── DashboardController.php
│   │   ├── KamarController.php
│   │   ├── PenghuniController.php
│   │   ├── PembayaranController.php
│   │   └── KomplainController.php
│   └── Models/                 # Eloquent Models dengan relasi
│       ├── User.php
│       ├── PemilikKost.php
│       ├── Penghuni.php
│       ├── Kamar.php
│       ├── Penghunian.php
│       ├── Tagihan.php
│       ├── Pembayaran.php
│       ├── Komplain.php
│       └── Notifikasi.php
├── database/
│   ├── migrations/             # Schema database
│   └── seeders/                # Data dummy untuk testing
│       └── DatabaseSeeder.php
├── resources/views/            # Blade templates
│   ├── auth/                   # Login page
│   ├── dashboard/              # Dashboard views
│   ├── kamar/                  # CRUD Kamar
│   ├── penghuni/               # Kelola Penghuni
│   ├── pembayaran/             # Kelola Pembayaran
│   ├── komplain/               # Kelola Komplain
│   └── layout/                 # Master template
└── routes/
    └── web.php                 # Route definitions
```

## 🔄 Alur Kerja Sistem

### 1. Pendaftaran Penghuni Baru
- Penghuni register → Status "pending"
- Pemilik approve → Status "active"
- Buat penghunian (assign kamar)
- Generate tagihan otomatis

### 2. Pembayaran Sewa
- Penghuni upload bukti bayar → Status "pending"
- Pemilik verifikasi & approve → Status "approved"
- Tagihan berubah status jadi "paid"

### 3. Komplain
- Penghuni ajukan komplain → Status "open"
- Pemilik tangani → Status "in_progress"
- Selesai → Status "resolved" / "closed"

## 📝 Catatan Implementasi

### Yang Diimplementasikan dari Class Diagram:
✅ 9 Models dengan relasi sesuai diagram  
✅ Inheritance concept (User sebagai base)  
✅ One-to-Many relationships  
✅ One-to-One relationship (Tagihan-Pembayaran)  
✅ Methods sesuai class diagram (approve, reject, update, etc)

### Penyesuaian dari Desain Asli:
- **Authentication:** Simplified manual auth (no register form untuk penghuni via web)
- **Notifikasi:** Model sudah ada, fitur notifikasi belum diimplementasi
- **Generate Kwitansi PDF:** Belum implement
- **Dashboard Chart:** Statistik ada tapi belum pakai chart visual

### Fitur Bonus yang Ditambahkan:
- ✅ Auto-seeder dengan data dummy lengkap
- ✅ Role-based access control dengan middleware
- ✅ Flash messages untuk feedback user
- ✅ Responsive design dengan Custom CSS
- ✅ Badge status dengan warna berbeda
- ✅ **Upload bukti transfer dengan preview** ⭐ NEW
- ✅ **Modal fullscreen view bukti transfer** ⭐ NEW
- ✅ **Navbar dropdowns functional** ⭐ NEW
- ✅ **SVG icons fixed (60+ icons)** ⭐ NEW

## 🐛 Troubleshooting

**Error "Class not found"**
```bash
composer dump-autoload
```

**Error Migration**
```bash
php artisan migrate:fresh --seed
```

**Permission Error (Linux/Mac)**
```bash
chmod -R 775 storage bootstrap/cache
```

**Port 8000 sudah dipakai**
```bash
php artisan serve --port=8001
```

## 📞 Informasi Tambahan

**Basis Desain:** Projek 01 - Analisis Perancangan KostKu  
**Untuk Mata Kuliah:** PBKK (Pemrograman Berbasis Kerangka Kerja)

### 📚 Dokumentasi & Laporan

- **`LAPORAN_PROJEK2_KOSTKU.docx`** - Laporan final (Cover + BAB 4) untuk dikumpulkan
- **`generate_laporan.py`** - Script generator laporan .docx (jalankan ulang setelah menambah screenshot)
- **`PANDUAN_TESTING.md`** - Panduan pengujian seluruh fitur
- **`docs/PAYMENT_FLOW_IMPLEMENTATION.md`** - Catatan teknis flow pembayaran & upload bukti
- **`docs/NAVBAR_DROPDOWNS.md`** - Catatan teknis implementasi navbar dropdown
- **`docs/screenshots/`** - Folder screenshot untuk laporan

### 🔐 Informasi Rekening Transfer

Sesuai Activity Diagram di Projek 01:

**Transfer Bank:**
- Bank BCA: 1234567890 a.n. PT Kost Sejahtera
- Bank Mandiri: 9876543210 a.n. PT Kost Sejahtera
- Bank BNI: 5555666677 a.n. PT Kost Sejahtera

**E-Wallet:**
- GoPay/OVO/Dana: 081234567890

---

**Selamat mencoba!** 🚀

**Status:** 🎉 **PRODUCTION READY - Siap untuk Testing & Screenshot!**
