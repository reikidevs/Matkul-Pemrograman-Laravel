# Praktikum 04: Master Template

**Status:** ✅ Selesai

**Tujuan Pembelajaran:**
- Mahasiswa mampu mengimplementasikan master template
- Menggunakan template Bootstrap (Quixlab)
- Memahami konsep layout inheritance di Blade
- Menggunakan `@extends`, `@section`, `@yield`

---

## 📋 Instruksi Praktikum

> **Gunakan controller mahasiswa yang sudah dibuat sebelumnya**
> - Template dapat di download pada link: https://github.com/themefisher/quixlab-bootstrap
> - Implementasikan template Quixlab ke dalam project Laravel
> - Buat master layout
> - Integrasikan halaman mahasiswa dengan master template

---

## 🚀 Persiapan

### 1. Copy Project dari Praktikum 03

**Linux/Mac:**
```bash
cp -r praktikum_03_blade_template/praktikum_laravel praktikum_04_master_template/
```

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse praktikum_03_blade_template/praktikum_laravel praktikum_04_master_template/
```

### 2. Download Template Quixlab

**URL:** https://github.com/themefisher/quixlab-bootstrap

**Cara Download:**
1. Buka link di atas
2. Klik "Code" → "Download ZIP"
3. Ekstrak file ZIP

**Atau via Git:**
```bash
git clone https://github.com/themefisher/quixlab-bootstrap.git
```

---

## 📝 Langkah-Langkah Praktikum

### Step 1: Masuk ke Folder Project
```bash
cd praktikum_04_master_template/praktikum_laravel
```

### Step 2: Copy Template ke Public Folder

1. **Buat folder assets** di `public/`
```bash
mkdir public/assets
```

2. **Copy semua file template** (css, fonts, images, js, plugins) ke `public/assets/`

**Windows (PowerShell):**
```powershell
Copy-Item -Recurse path/to/quixlab-bootstrap/* public/assets/
```

**Linux/Mac:**
```bash
cp -r path/to/quixlab-bootstrap/* public/assets/
```

**Struktur akhir:**
```
public/
└── assets/
    ├── css/
    ├── fonts/
    ├── images/
    ├── js/
    └── plugins/
```

### Step 3: Buat Master Layout

Buat file `resources/views/layout/layout.blade.php`:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    
    <!-- CSS -->
    <link href="{{ asset('assets/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="main-wrapper">
        <!-- Nav Header -->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/">
                    <b class="logo-abbr"><img src="{{ asset('assets/images/logo.png') }}" alt=""></b>
                    <span class="brand-title">
                        <img src="{{ asset('assets/images/logo-text.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer" data-toggle="dropdown">
                                <img src="{{ asset('assets/images/user/1.png') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="#"><i class="icon-user"></i> <span>Profile</span></a></li>
                                        <li><a href="#"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="/" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Master Data</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-notebook menu-icon"></i>
                            <span class="nav-text">Mahasiswa</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/mahasiswa">Data Mahasiswa</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content Body -->
        <div class="content-body">
            <div class="container-fluid mt-3">
                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
</body>
</html>
```

### Step 4: Update View Mahasiswa

Edit file `resources/views/mahasiswa/index.blade.php`:

```php
@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Mahasiswa</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MAHASISWA</th>
                                <th>LAHIR</th>
                                <th>PROGRAM STUDI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $index => $mhs)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $mhs['nim'] }}<br>
                                    <strong>{{ $mhs['nama'] }}</strong><br>
                                    <small>{{ $mhs['jenis_kelamin'] }}</small>
                                </td>
                                <td>{{ $mhs['tempat_lahir'] }}, {{ $mhs['tgl_lahir'] }}</td>
                                <td>{{ $mhs['prodi'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

### Step 5: Buat Halaman Dashboard

Buat file `resources/views/dashboard.blade.php`:

```php
@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card gradient-1">
            <div class="card-body">
                <h3 class="card-title text-white">Total Mahasiswa</h3>
                <div class="d-inline-block">
                    <h2 class="text-white">5</h2>
                    <p class="text-white mb-0">Mahasiswa Aktif</p>
                </div>
                <span class="float-right display-5 opacity-5">
                    <i class="fa fa-users"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Selamat Datang di Dashboard</h4>
                <p>Sistem Informasi Akademik - Universitas Semarang</p>
            </div>
        </div>
    </div>
</div>
@endsection
```

### Step 6: Update Route untuk Dashboard

Edit file `routes/web.php`:

```php
Route::get('/', function () {
    return view('dashboard');
});
```

### Step 7: Jalankan Server

```bash
php artisan serve
```

### Step 8: Test di Browser

- **Dashboard:** http://localhost:8000/
- **Data Mahasiswa:** http://localhost:8000/mahasiswa

---

## ✅ Checklist Praktikum

- [ ] Project di-copy dari Praktikum 03
- [ ] Template Quixlab sudah didownload
- [ ] Folder `public/assets/` sudah dibuat
- [ ] File template (css, js, images, plugins) sudah di-copy
- [ ] Master layout `layout.blade.php` sudah dibuat
- [ ] View mahasiswa menggunakan `@extends('layout.layout')`
- [ ] Halaman dashboard sudah dibuat
- [ ] Route dashboard sudah diupdate
- [ ] Template tampil dengan benar (sidebar, header, footer)
- [ ] Data mahasiswa tampil dalam card dengan styling Bootstrap

---

## 🎯 Konsep yang Dipelajari

### 1. Template Inheritance

**@extends** - Menggunakan layout master
```php
@extends('layout.layout')
```

**@section** - Mendefinisikan konten section
```php
@section('content')
    <!-- Konten di sini -->
@endsection
```

**@yield** - Placeholder untuk konten dinamis
```php
@yield('content')
```

### 2. Asset Helper

**asset()** - Generate URL ke public folder
```php
{{ asset('assets/css/style.css') }}
// Output: http://localhost:8000/assets/css/style.css
```

### 3. Bootstrap Components

- **Card** - Container untuk konten
- **Table** - Tabel dengan styling
- **Button** - Tombol dengan warna
- **Grid System** - Layout responsive

---

## 📚 Struktur File

```
praktikum_04_master_template/
└── praktikum_laravel/
    ├── public/
    │   └── assets/                      ← BARU (Template files)
    │       ├── css/
    │       ├── fonts/
    │       ├── images/
    │       ├── js/
    │       └── plugins/
    ├── resources/
    │   └── views/
    │       ├── layout/
    │       │   └── layout.blade.php     ← BARU (Master layout)
    │       ├── mahasiswa/
    │       │   └── index.blade.php      ← MODIFIED (Extends layout)
    │       └── dashboard.blade.php      ← BARU (Dashboard page)
    └── routes/
        └── web.php                      ← MODIFIED (Dashboard route)
```

---

## 🎨 Fitur Template Quixlab

1. **Responsive Design** - Mobile-first approach
2. **Sidebar Navigation** - Collapsible menu
3. **Header** - User profile dropdown
4. **Dashboard Cards** - Gradient cards untuk statistik
5. **DataTables** - Table dengan search & pagination
6. **Icons** - Icon library (Simple Line Icons)
7. **Charts** - ChartJS, Morris, Chartist
8. **Calendar** - Pignose Calendar

---

## 🆘 Troubleshooting

### Template tidak tampil / styling hilang

**Solusi:**
1. Cek apakah folder `public/assets/` sudah ada
2. Cek apakah semua file template sudah di-copy
3. Inspect element → Network tab → cek 404 errors
4. Clear browser cache (Ctrl+Shift+R)

### Sidebar tidak berfungsi

**Solusi:**
1. Cek apakah JavaScript files sudah di-load
2. Pastikan jQuery di-load sebelum script lain
3. Cek console browser untuk error

### Asset tidak load (404)

**Solusi:**
1. Cek path di `{{ asset() }}`
2. Pastikan nama file dan folder sesuai (case-sensitive)
3. Cek apakah file ada di `public/assets/`

---

## 📸 Screenshot Hasil

Setelah berhasil, Anda akan melihat:
- **Dashboard** dengan sidebar, header, dan cards statistik
- **Data Mahasiswa** dalam tabel Bootstrap dengan styling
- **Sidebar menu** yang collapsible
- **Header** dengan user profile dropdown
- **Footer** dengan copyright

---

## 📚 Referensi

- [Quixlab Template](https://github.com/themefisher/quixlab-bootstrap)
- [Laravel Blade Templates](https://laravel.com/docs/10.x/blade)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [Laravel Asset Helper](https://laravel.com/docs/10.x/helpers#method-asset)

---

**Previous:** [Praktikum 03 - Blade Template](../praktikum_03_blade_template/README.md)  
**Next:** [Praktikum 05 - Migration, Model, Seeder](../praktikum_05_migration_model_seeder/README.md)
