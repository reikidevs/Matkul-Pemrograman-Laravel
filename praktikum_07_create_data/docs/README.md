# Praktikum 07: Menambah Data Mahasiswa

**Status:** ✅ Selesai

## Tujuan Pembelajaran

- Membuat form tambah data dengan Blade
- Menggunakan method POST dan @csrf
- Implementasi validasi input di Controller
- Menampilkan notifikasi sukses/gagal (flash message)
- Memahami alur Form → POST → Controller → Database → Redirect

## Instruksi Praktikum

1. Buat tombol Tambah pada `index.blade.php`
2. Buat form tambah data di `create.blade.php`
3. Buat penanganan untuk insert data ke tabel
4. Tampilkan notifikasi berhasil atau gagal

## Persiapan

Praktikum ini melanjutkan Praktikum 06. Folder `praktikum_laravel/` di-copy dari Praktikum 06.

```bash
cd praktikum_07_create_data/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
```

Konfigurasi `.env` untuk koneksi database, lalu jalankan:

```bash
php artisan migrate --seed
```

## Langkah-Langkah

### 1. Tambahkan Routes

Edit file `routes/web.php`, tambahkan route untuk create dan store:

```php
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
```

> ⚠️ **Penting:** Route `/mahasiswa/create` HARUS didefinisikan SEBELUM `/mahasiswa/{id}`, jika tidak Laravel akan menangkap "create" sebagai parameter `{id}`.

### 2. Tambahkan Method create() di Controller

Edit `app/Http/Controllers/MahasiswaController.php`:

```php
public function create()
{
    $data['master'] = array('title' => 'Tambah Mahasiswa');
    $data['prodi'] = ProgramStudi::orderBy('nama_prodi')->get();

    return view('mahasiswa.create', $data);
}
```

Jangan lupa tambahkan `use App\Models\ProgramStudi;` di bagian atas file.

### 3. Buat View create.blade.php

Buat file baru `resources/views/mahasiswa/create.blade.php` berisi form input mahasiswa lengkap dengan:

- `@csrf` untuk token CSRF
- Field: nim, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, prodi_id (dropdown)
- Tampilkan error validasi dengan `@error('field')`
- Pertahankan input lama dengan `old('field')`

Lihat file lengkap di [resources/views/mahasiswa/create.blade.php](../praktikum_laravel/resources/views/mahasiswa/create.blade.php).

### 4. Modifikasi index.blade.php

Tambahkan tombol Tambah dan area notifikasi di atas tabel:

```blade
<div class="mb-3">
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Tambah Mahasiswa
    </a>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Gagal!</strong> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif
```

### 5. Tambahkan Method store() di Controller

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'nim'           => 'required|string|max:20|unique:mahasiswas,nim',
        'nama'          => 'required|string|max:100',
        'tempat_lahir'  => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'prodi_id'      => 'required|exists:program_studis,id',
    ]);

    try {
        Mahasiswa::create($validated);
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()
            ->with('error', 'Data mahasiswa gagal ditambahkan: ' . $e->getMessage());
    }
}
```

## Checklist

- [x] Route `mahasiswa.create` (GET) ditambahkan
- [x] Route `mahasiswa.store` (POST) ditambahkan
- [x] Method `create()` di controller mengirim data prodi ke view
- [x] View `create.blade.php` dibuat dengan form lengkap
- [x] Tombol "Tambah" muncul di halaman index
- [x] Method `store()` melakukan validasi
- [x] Method `store()` menyimpan data ke database
- [x] Notifikasi sukses tampil setelah berhasil simpan
- [x] Notifikasi gagal tampil jika terjadi error
- [x] Form mempertahankan input lama saat validasi gagal (`old()`)

## Troubleshooting

**Error: "Route [mahasiswa.create] not defined"**
- Pastikan route sudah ditambahkan di `web.php` dengan `->name('mahasiswa.create')`
- Jalankan `php artisan route:clear`

**Form mengarah ke route show, bukan create**
- Pastikan urutan route: `/mahasiswa/create` SEBELUM `/mahasiswa/{id}`

**Error 419 Page Expired**
- Pastikan ada `@csrf` di dalam form
- Pastikan tidak ada cache lama: `php artisan cache:clear`

**Validasi tidak jalan**
- Pastikan ada `@error('field')` di setiap input untuk menampilkan error
- Cek `protected $fillable` di Model `Mahasiswa.php`
