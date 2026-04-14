# Template Setup Guide - Quixlab Bootstrap

Panduan untuk download dan setup template Quixlab Bootstrap.

---

## 📥 Download Template

### 1. Download dari GitHub

**URL:** https://github.com/themefisher/quixlab-bootstrap

**Cara Download:**
1. Buka link di atas
2. Klik tombol hijau "Code"
3. Pilih "Download ZIP"
4. Ekstrak file ZIP yang sudah didownload

**Atau via Git Clone:**
```bash
git clone https://github.com/themefisher/quixlab-bootstrap.git
```

---

## 📁 Struktur Template

Setelah ekstrak, struktur folder template:

```
quixlab-bootstrap/
├── css/
├── fonts/
├── images/
├── js/
├── plugins/
├── scss/
├── index.html
└── ...
```

---

## 🔧 Integrasi ke Laravel

### Step 1: Copy Template ke Public

1. **Copy semua folder** dari template (css, fonts, images, js, plugins)
2. **Paste ke** `public/assets/` di project Laravel

**Struktur akhir:**
```
praktikum_04_master_template/
└── praktikum_laravel/
    └── public/
        └── assets/
            ├── css/
            ├── fonts/
            ├── images/
            ├── js/
            └── plugins/
```

### Step 2: Rename Folder (Opsional)

Rename folder template menjadi `assets` untuk konsistensi:

**Before:**
```
public/quixlab-bootstrap/
```

**After:**
```
public/assets/
```

---

## 🎨 Menggunakan Assets di Blade

### 1. CSS Files

```php
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
```

### 2. JavaScript Files

```php
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
```

### 3. Images

```php
<img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
```

### 4. Plugins

```php
<link href="{{ asset('assets/plugins/chartist/css/chartist.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/chartist/js/chartist.min.js') }}"></script>
```

---

## 📝 Helper Function: asset()

Laravel menyediakan helper `asset()` untuk generate URL ke public folder:

```php
asset('assets/css/style.css')
// Output: http://localhost:8000/assets/css/style.css
```

**Keuntungan:**
- Otomatis menambahkan base URL
- Bekerja di semua environment (local, staging, production)
- Mudah di-maintain

---

## ⚠️ Catatan Penting

### 1. Jangan Commit Assets ke Git (Opsional)

Jika file assets terlalu besar, tambahkan ke `.gitignore`:

```gitignore
/public/assets/
```

### 2. CDN Alternative

Untuk production, pertimbangkan menggunakan CDN:

```php
<!-- Bootstrap CSS dari CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
```

### 3. Asset Versioning

Untuk cache busting, gunakan `mix()` atau `asset()` dengan version:

```php
<link href="{{ asset('assets/css/style.css?v=1.0') }}" rel="stylesheet">
```

---

## 🚀 Quick Setup Commands

```bash
# 1. Masuk ke folder project
cd praktikum_04_master_template/praktikum_laravel

# 2. Buat folder assets di public
mkdir public/assets

# 3. Copy template files (manual atau command)
# Windows (PowerShell):
Copy-Item -Recurse path/to/quixlab-bootstrap/* public/assets/

# Linux/Mac:
cp -r path/to/quixlab-bootstrap/* public/assets/

# 4. Jalankan server
php artisan serve
```

---

## 📊 Checklist Setup

- [ ] Template Quixlab sudah didownload
- [ ] File template sudah diekstrak
- [ ] Folder assets sudah dibuat di `public/`
- [ ] Semua file template (css, js, images, plugins) sudah di-copy
- [ ] Layout master sudah dibuat di `resources/views/layout/layout.blade.php`
- [ ] Asset helper `{{ asset() }}` sudah digunakan di layout
- [ ] Server Laravel berjalan tanpa error
- [ ] Template tampil dengan benar di browser

---

## 🆘 Troubleshooting

### Error: "Failed to load resource: 404"

**Penyebab:** File asset tidak ditemukan

**Solusi:**
1. Cek path file di `public/assets/`
2. Pastikan nama file dan folder sesuai
3. Cek case-sensitive (Linux/Mac)

### Styling tidak muncul

**Solusi:**
1. Cek apakah CSS file sudah di-load (inspect element → Network tab)
2. Pastikan path `{{ asset() }}` benar
3. Clear browser cache (Ctrl+Shift+R)

### JavaScript tidak berfungsi

**Solusi:**
1. Cek console browser untuk error
2. Pastikan jQuery sudah di-load sebelum script lain
3. Cek urutan loading script

---

## 📚 Referensi

- [Quixlab Template GitHub](https://github.com/themefisher/quixlab-bootstrap)
- [Laravel Asset Helper](https://laravel.com/docs/10.x/helpers#method-asset)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)

---

**Setup Completed!** 🎉
