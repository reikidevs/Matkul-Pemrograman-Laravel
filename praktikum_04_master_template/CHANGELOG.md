# Changelog - Praktikum 04

## Perubahan dari Praktikum 03

### File Baru

1. **public/assets/** (Folder)
   - Template Quixlab Bootstrap
   - css/, fonts/, images/, js/, plugins/

2. **resources/views/layout/layout.blade.php**
   - Master layout dengan sidebar, header, footer
   - Navigation menu
   - Asset loading (CSS & JS)

3. **resources/views/dashboard.blade.php**
   - Halaman dashboard dengan cards statistik
   - Welcome message

### File yang Dimodifikasi

1. **resources/views/mahasiswa/index.blade.php**
   - Ubah dari standalone HTML ke extends layout
   - Gunakan Bootstrap card component
   - Gunakan Bootstrap table classes
   - Tambah button styling (btn-primary, btn-danger)

2. **routes/web.php**
   - Route `/` sekarang mengarah ke dashboard
   - Bukan lagi ke welcome page

### Fitur yang Ditambahkan

- ✅ Master template dengan Quixlab Bootstrap
- ✅ Sidebar navigation (collapsible)
- ✅ Header dengan user profile dropdown
- ✅ Footer dengan copyright
- ✅ Dashboard page dengan cards statistik
- ✅ Responsive design (mobile-first)
- ✅ Bootstrap styling untuk tabel
- ✅ Button styling untuk aksi Edit & Hapus

### Konsep Blade yang Dipelajari

1. **@extends Directive**
   - Menggunakan layout master
   - Template inheritance

2. **@section & @endsection**
   - Mendefinisikan konten section
   - Mengisi placeholder @yield

3. **@yield Directive**
   - Placeholder untuk konten dinamis
   - Di-define di master layout

4. **asset() Helper**
   - Generate URL ke public folder
   - Untuk CSS, JS, images, plugins

### Bootstrap Components yang Digunakan

1. **Card** - Container untuk konten
2. **Table** - table-striped, table-bordered
3. **Button** - btn-primary, btn-danger, btn-sm
4. **Grid System** - row, col-12, col-lg-3
5. **Gradient Cards** - gradient-1, gradient-2, dll

---

## Struktur Template Quixlab

### CSS Files
- `style.css` - Main stylesheet
- `pignose.calendar.min.css` - Calendar plugin
- `chartist.min.css` - Chart plugin

### JavaScript Files
- `common.min.js` - Common utilities
- `custom.min.js` - Custom scripts
- `settings.js` - Settings configuration
- Various plugins (chart.js, morris, etc.)

### Images
- Logo files
- User avatars
- Icons

### Plugins
- ChartJS - Charts
- Morris - Charts
- Pignose Calendar - Calendar
- DataTables - Table enhancement
- And more...

---

## Perbedaan dengan Praktikum 03

| Aspek | Praktikum 03 | Praktikum 04 |
|-------|--------------|--------------|
| Layout | Standalone HTML | Master template |
| Styling | Tanpa CSS | Bootstrap Quixlab |
| Navigation | Tidak ada | Sidebar menu |
| Header | Tidak ada | Header dengan profile |
| Footer | Link sederhana | Footer dengan copyright |
| Dashboard | Tidak ada | Dashboard dengan cards |
| Table | HTML basic | Bootstrap table |
| Button | Link biasa | Bootstrap button |
| Responsive | Tidak | Ya (mobile-first) |

---

## Asset Management

### Before (Praktikum 03)
```html
<!-- Inline atau tidak ada styling -->
<table border="1">
```

### After (Praktikum 04)
```php
<!-- Bootstrap dari assets -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<table class="table table-striped table-bordered">
```

---

**Tanggal:** 13 April 2026  
**Versi Laravel:** 10.50.2  
**Template:** Quixlab Bootstrap
