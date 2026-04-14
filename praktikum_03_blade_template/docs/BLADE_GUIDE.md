# Blade Template Guide

Panduan lengkap Blade Template Engine untuk Laravel.

---

## 📚 Apa itu Blade?

Blade adalah template engine yang digunakan Laravel untuk membuat view secara dinamis. Blade memungkinkan:
- Menampilkan data dari controller
- Menggunakan struktur kontrol (if, loop)
- Membuat layout yang reusable
- Menulis kode yang lebih bersih dan mudah dibaca

**File Extension:** `.blade.php`  
**Lokasi:** `resources/views/`

---

## 🎯 Sintaks Dasar Blade

### 1. Menampilkan Data

#### {{ }} - Echo dengan HTML Escaping
```php
{{ $variable }}
{{ $user->name }}
{{ $array['key'] }}
```

**Contoh:**
```php
<h1>{{ $title }}</h1>
<p>Nama: {{ $mahasiswa['nama'] }}</p>
```

**Output:**
```html
<h1>Data Mahasiswa</h1>
<p>Nama: Fajar Santoso</p>
```

#### {!! !!} - Echo tanpa HTML Escaping
```php
{!! $html_content !!}
```

**⚠️ Hati-hati:** Gunakan hanya untuk konten yang sudah aman!

---

### 2. Komentar Blade

```php
{{-- Ini komentar Blade, tidak akan muncul di HTML --}}

<!-- Ini komentar HTML, akan muncul di source code -->
```

---

### 3. Struktur Kontrol

#### If Statement
```php
@if($status == 'aktif')
    <p>Mahasiswa Aktif</p>
@elseif($status == 'cuti')
    <p>Mahasiswa Cuti</p>
@else
    <p>Mahasiswa Tidak Aktif</p>
@endif
```

#### Unless (Kebalikan If)
```php
@unless($user->isAdmin())
    <p>Anda bukan admin</p>
@endunless
```

#### Isset & Empty
```php
@isset($mahasiswa)
    <p>Data mahasiswa tersedia</p>
@endisset

@empty($mahasiswa)
    <p>Tidak ada data mahasiswa</p>
@endempty
```

---

### 4. Looping

#### Foreach
```php
@foreach($mahasiswa as $mhs)
    <p>{{ $mhs['nama'] }}</p>
@endforeach
```

**Dengan Index:**
```php
@foreach($mahasiswa as $index => $mhs)
    <p>{{ $index + 1 }}. {{ $mhs['nama'] }}</p>
@endforeach
```

#### For Loop
```php
@for($i = 0; $i < 10; $i++)
    <p>Nomor: {{ $i }}</p>
@endfor
```

#### While Loop
```php
@while($condition)
    <p>Loop content</p>
@endwhile
```

#### Forelse (Foreach dengan Else)
```php
@forelse($mahasiswa as $mhs)
    <p>{{ $mhs['nama'] }}</p>
@empty
    <p>Tidak ada data mahasiswa</p>
@endforelse
```

---

### 5. Loop Variable

Blade menyediakan variable `$loop` di dalam foreach:

```php
@foreach($mahasiswa as $mhs)
    @if($loop->first)
        <p>Ini data pertama</p>
    @endif

    <p>{{ $mhs['nama'] }}</p>

    @if($loop->last)
        <p>Ini data terakhir</p>
    @endif
@endforeach
```

**Loop Properties:**
- `$loop->index` - Index saat ini (mulai dari 0)
- `$loop->iteration` - Iterasi saat ini (mulai dari 1)
- `$loop->remaining` - Sisa iterasi
- `$loop->count` - Total item
- `$loop->first` - Apakah iterasi pertama
- `$loop->last` - Apakah iterasi terakhir
- `$loop->even` - Apakah iterasi genap
- `$loop->odd` - Apakah iterasi ganjil
- `$loop->depth` - Nesting level
- `$loop->parent` - Parent loop variable

---

## 🎨 Layout & Template Inheritance

### 1. Membuat Master Layout

**File:** `resources/views/layouts/app.blade.php`

```php
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>
```

### 2. Menggunakan Layout (Extends)

**File:** `resources/views/mahasiswa/index.blade.php`

```php
@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <h1>Data Mahasiswa</h1>
    <p>Konten halaman di sini</p>
@endsection
```

### 3. Section dengan Default Value

```php
@yield('sidebar', 'Default sidebar content')
```

### 4. Append ke Section

```php
@section('scripts')
    @parent
    <script src="custom.js"></script>
@endsection
```

---

## 📦 Include & Components

### 1. Include File

```php
@include('partials.navbar')

@include('partials.alert', ['type' => 'success', 'message' => 'Berhasil!'])
```

### 2. Include If Exists

```php
@includeIf('partials.navbar')
```

### 3. Include When

```php
@includeWhen($user->isAdmin(), 'partials.admin-menu')
```

### 4. Include Unless

```php
@includeUnless($user->isGuest(), 'partials.user-menu')
```

---

## 🔧 Directive Lainnya

### 1. PHP Code

```php
@php
    $total = count($mahasiswa);
    $active = array_filter($mahasiswa, fn($m) => $m['status'] == 'aktif');
@endphp
```

### 2. CSRF Token

```php
<form method="POST">
    @csrf
    <!-- Form fields -->
</form>
```

### 3. Method Spoofing

```php
<form method="POST">
    @csrf
    @method('PUT')
    <!-- Form fields -->
</form>
```

### 4. Validation Errors

```php
@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
```

---

## 💡 Tips & Best Practices

### 1. Gunakan {{ }} untuk Output
Selalu gunakan `{{ }}` untuk output data agar aman dari XSS:
```php
✅ {{ $user->name }}
❌ {!! $user->name !!}
```

### 2. Pisahkan Logic dari View
```php
❌ Bad:
@php
    $total = 0;
    foreach($items as $item) {
        $total += $item->price;
    }
@endphp

✅ Good:
// Di Controller
$total = $items->sum('price');
return view('page', compact('total'));
```

### 3. Gunakan @forelse untuk Empty State
```php
@forelse($mahasiswa as $mhs)
    <p>{{ $mhs['nama'] }}</p>
@empty
    <p>Tidak ada data</p>
@endforelse
```

### 4. Manfaatkan $loop Variable
```php
@foreach($items as $item)
    <tr class="{{ $loop->even ? 'bg-gray' : '' }}">
        <td>{{ $item->name }}</td>
    </tr>
@endforeach
```

---

## 📝 Contoh Praktis

### Tabel dengan Looping

```php
<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
```

### Conditional Rendering

```php
@if($user->role == 'admin')
    <a href="/admin">Dashboard Admin</a>
@elseif($user->role == 'editor')
    <a href="/editor">Dashboard Editor</a>
@else
    <a href="/user">Dashboard User</a>
@endif
```

### Nested Loop

```php
@foreach($categories as $category)
    <h2>{{ $category->name }}</h2>
    <ul>
        @foreach($category->products as $product)
            <li>{{ $product->name }}</li>
        @endforeach
    </ul>
@endforeach
```

---

## 🚀 Advanced Features

### 1. Custom Blade Directives

Di `AppServiceProvider.php`:

```php
use Illuminate\Support\Facades\Blade;

public function boot()
{
    Blade::directive('datetime', function ($expression) {
        return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
    });
}
```

Penggunaan:
```php
@datetime($user->created_at)
```

### 2. Blade Components (Laravel 7+)

```php
<!-- resources/views/components/alert.blade.php -->
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>

<!-- Penggunaan -->
<x-alert type="success">
    Data berhasil disimpan!
</x-alert>
```

---

## 📚 Referensi

- [Laravel Blade Documentation](https://laravel.com/docs/10.x/blade)
- [Blade Templates - Laracasts](https://laracasts.com/series/laravel-from-scratch/episodes/7)

---

**Happy Coding! 🚀**
