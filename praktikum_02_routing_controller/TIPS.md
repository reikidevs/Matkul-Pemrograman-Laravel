# Tips & Tricks - Praktikum 02

Tips dan trik untuk memaksimalkan pembelajaran Praktikum 02.

---

## 💡 Tips Umum

### 1. Pahami Alur MVC
```
User → Route → Controller → View → Response
```
Selalu ingat alur ini saat membuat fitur baru.

### 2. Gunakan `php artisan route:list`
Command ini sangat berguna untuk melihat semua route yang terdaftar:
```bash
php artisan route:list
```

### 3. Gunakan `dd()` untuk Debugging
```php
public function index()
{
    $mahasiswa = [...];
    dd($mahasiswa); // Dump and Die
    return view('mahasiswa.index', compact('mahasiswa'));
}
```

### 4. Gunakan `compact()` vs Array
```php
// Cara 1: compact()
return view('mahasiswa.index', compact('mahasiswa'));

// Cara 2: Array
return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
```
Keduanya sama, pilih yang lebih nyaman.

---

## 🚀 Shortcut & Productivity

### 1. Artisan Make Commands
```bash
# Membuat controller
php artisan make:controller NamaController

# Membuat controller dengan resource methods
php artisan make:controller NamaController --resource

# Membuat model + controller
php artisan make:model Nama -c
```

### 2. Route Shortcuts
```php
// Route dengan nama
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

// Panggil di view
<a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
```

### 3. Blade Shortcuts
```php
// Output dengan escape HTML
{{ $variable }}

// Output tanpa escape (hati-hati!)
{!! $variable !!}

// Komentar Blade (tidak muncul di HTML)
{{-- Ini komentar --}}
```

---

## 🎨 Styling Tips

### 1. Gunakan CSS Framework (Opsional)
Untuk praktikum selanjutnya, bisa gunakan Bootstrap atau Tailwind:

```html
<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
```

### 2. Pisahkan CSS ke File Terpisah
```html
<!-- Di view -->
<link rel="stylesheet" href="{{ asset('css/mahasiswa.css') }}">
```

File: `public/css/mahasiswa.css`

---

## 🔧 Debugging Tips

### 1. Cek Error di Browser Console
- Buka Developer Tools (F12)
- Tab Console untuk JavaScript errors
- Tab Network untuk HTTP requests

### 2. Cek Laravel Log
```bash
# File log ada di:
storage/logs/laravel.log
```

### 3. Enable Debug Mode
Di file `.env`:
```env
APP_DEBUG=true
```

### 4. Gunakan Laravel Debugbar (Opsional)
```bash
composer require barryvdh/laravel-debugbar --dev
```

---

## 📝 Best Practices

### 1. Naming Convention
```php
// Controller: PascalCase + Controller suffix
MahasiswaController

// Method: camelCase
public function index()
public function show($id)

// Route: kebab-case
/mahasiswa
/mahasiswa-detail

// View: kebab-case
mahasiswa/index.blade.php
mahasiswa/detail.blade.php
```

### 2. Organize Routes
```php
// Group routes by prefix
Route::prefix('mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index']);
    Route::get('/{id}', [MahasiswaController::class, 'show']);
});
```

### 3. Use Route Model Binding (Advanced)
```php
// routes/web.php
Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show']);

// Controller
public function show(Mahasiswa $mahasiswa)
{
    // Laravel automatically finds the model
    return view('mahasiswa.show', compact('mahasiswa'));
}
```

---

## 🎯 Eksperimen & Latihan

### 1. Tambah Data Mahasiswa Lain
```php
$mahasiswa = [
    [
        'nim' => 'G.131.24.0001',
        'nama' => 'KURNIAWAN',
        // ...
    ],
    [
        'nim' => 'G.131.24.0002',
        'nama' => 'BUDI SANTOSO',
        // ...
    ]
];
```

### 2. Buat Route Baru
```php
// Route untuk edit
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit']);

// Route untuk delete
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
```

### 3. Tambah Validasi Parameter
```php
// Route dengan constraint
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])
    ->where('id', '[0-9]+');
```

---

## 🔍 Advanced Tips

### 1. Route Caching (Production)
```bash
# Cache routes untuk performa
php artisan route:cache

# Clear cache
php artisan route:clear
```

### 2. Controller Middleware
```php
public function __construct()
{
    $this->middleware('auth');
}
```

### 3. Response Types
```php
// Return JSON
return response()->json($mahasiswa);

// Return with status code
return response()->view('mahasiswa.index', compact('mahasiswa'), 200);

// Redirect
return redirect('/mahasiswa');
```

---

## 📚 Resources

### Official Documentation
- [Laravel Routing](https://laravel.com/docs/10.x/routing)
- [Laravel Controllers](https://laravel.com/docs/10.x/controllers)
- [Blade Templates](https://laravel.com/docs/10.x/blade)

### Video Tutorials
- Laravel From Scratch (Laracasts)
- Laravel Tutorial for Beginners (YouTube)

### Community
- [Laravel.io Forum](https://laravel.io/forum)
- [Laracasts Forum](https://laracasts.com/discuss)
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel)

---

## ⚡ Quick Reference

### Artisan Commands
```bash
php artisan serve              # Start server
php artisan route:list         # List all routes
php artisan make:controller    # Create controller
php artisan cache:clear        # Clear cache
php artisan config:clear       # Clear config cache
```

### Blade Directives
```php
{{ $var }}                     # Echo variable
@if ($condition)               # If statement
@foreach ($items as $item)     # Loop
@include('view.name')          # Include view
```

### Helper Functions
```php
route('name')                  # Generate route URL
asset('path')                  # Generate asset URL
url('path')                    # Generate full URL
compact('var1', 'var2')        # Create array
```

---

**Happy Coding! 🚀**
