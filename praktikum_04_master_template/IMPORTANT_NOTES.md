# Important Notes - Praktikum 04

Catatan penting untuk Praktikum 04: Master Template.

---

## ⚠️ PENTING: Template Assets

### Template TIDAK Disertakan di Repository

Karena ukuran file yang besar, **template Quixlab Bootstrap TIDAK disertakan** dalam repository ini.

**Anda harus download sendiri dari:**
https://github.com/themefisher/quixlab-bootstrap

### Cara Setup Template

1. **Download template** dari link di atas
2. **Ekstrak** file ZIP
3. **Copy semua folder** (css, fonts, images, js, plugins) ke `public/assets/`
4. **Jalankan** `php artisan serve`

**Lihat:** [TEMPLATE_SETUP.md](TEMPLATE_SETUP.md) untuk panduan lengkap.

---

## 📁 Struktur Assets yang Dibutuhkan

Setelah setup, struktur folder harus seperti ini:

```
public/
└── assets/
    ├── css/
    │   ├── style.css
    │   └── ...
    ├── fonts/
    │   └── ...
    ├── images/
    │   ├── logo.png
    │   ├── logo-text.png
    │   └── ...
    ├── js/
    │   ├── custom.min.js
    │   ├── settings.js
    │   └── ...
    └── plugins/
        ├── common/
        ├── chartist/
        ├── pg-calendar/
        └── ...
```

---

## 🚫 File yang Tidak Di-Push ke Git

File berikut **TIDAK** di-push ke Git (sudah ada di .gitignore):

```gitignore
/public/assets/
```

**Alasan:**
- Ukuran file terlalu besar (puluhan MB)
- Bukan source code project
- Bisa didownload dari sumber asli

---

## ✅ File yang Sudah Disertakan

File berikut **SUDAH** ada di repository:

1. ✅ `resources/views/layout/layout.blade.php` - Master layout
2. ✅ `resources/views/mahasiswa/index.blade.php` - View mahasiswa
3. ✅ `resources/views/dashboard.blade.php` - Dashboard page
4. ✅ `routes/web.php` - Routes
5. ✅ `app/Http/Controllers/MahasiswaController.php` - Controller

---

## 🔧 Jika Template Tidak Tampil

### Checklist Troubleshooting

- [ ] Template sudah didownload dari GitHub
- [ ] File template sudah diekstrak
- [ ] Folder `public/assets/` sudah dibuat
- [ ] Semua file (css, js, images, plugins) sudah di-copy
- [ ] Path di `{{ asset() }}` sudah benar
- [ ] Server Laravel sudah dijalankan (`php artisan serve`)
- [ ] Browser cache sudah di-clear (Ctrl+Shift+R)

### Cek di Browser

1. **Buka Developer Tools** (F12)
2. **Tab Network** - Cek apakah ada 404 errors
3. **Tab Console** - Cek apakah ada JavaScript errors

### Cek File Assets

```bash
# Cek apakah file CSS ada
ls public/assets/css/style.css

# Cek apakah file JS ada
ls public/assets/js/custom.min.js
```

---

## 💡 Alternative: Gunakan CDN

Jika tidak ingin download template, bisa gunakan Bootstrap CDN:

```php
<!-- Di layout.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

**Catatan:** Tampilan akan berbeda dari Quixlab template.

---

## 📝 Untuk Mahasiswa

### Jika Anda Clone Repository Ini

1. **Download template** dari https://github.com/themefisher/quixlab-bootstrap
2. **Copy assets** ke `public/assets/`
3. **Jalankan** `composer install` (jika belum)
4. **Jalankan** `php artisan serve`

### Jika Template Sudah Ada

Jika Anda sudah punya template dari praktikum sebelumnya:

```bash
# Copy dari praktikum lain
cp -r ../praktikum_lain/public/assets public/
```

---

## 🎯 Fokus Pembelajaran

Yang penting dipelajari di praktikum ini:

1. ✅ **Konsep Master Layout** - @extends, @section, @yield
2. ✅ **Asset Management** - {{ asset() }} helper
3. ✅ **Template Inheritance** - Reusable layout
4. ✅ **Bootstrap Integration** - Styling dengan framework

**Bukan:**
- ❌ Desain template dari nol
- ❌ Kustomisasi CSS/JS template
- ❌ Membuat komponen Bootstrap sendiri

---

## 📚 Dokumentasi Lengkap

- [TEMPLATE_SETUP.md](TEMPLATE_SETUP.md) - Panduan setup template
- [README.md](README.md) - Instruksi praktikum lengkap
- [CHANGELOG.md](CHANGELOG.md) - Perubahan dari praktikum 03

---

## 🆘 Butuh Bantuan?

Jika ada masalah:

1. Baca [TEMPLATE_SETUP.md](TEMPLATE_SETUP.md)
2. Cek [README.md](README.md) section Troubleshooting
3. Tanya di Telegram Group: https://t.me/+yQaQEQAi8c44YjFl

---

**Selamat Belajar! 🚀**
