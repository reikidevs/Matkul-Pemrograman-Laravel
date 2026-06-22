# CHANGELOG - Praktikum 07

Perubahan dari Praktikum 06 (Menampilkan Data) ke Praktikum 07 (Menambah Data).

## File Baru

- `resources/views/mahasiswa/create.blade.php` - Form tambah mahasiswa

## File Diubah

### `routes/web.php`
- Tambah `name('mahasiswa.index')` pada route index
- Tambah route GET `/mahasiswa/create` → method `create()`
- Tambah route POST `/mahasiswa` → method `store()`
- Hapus route contoh multiple parameter (tidak relevan lagi)

### `app/Http/Controllers/MahasiswaController.php`
- Tambah `use App\Models\ProgramStudi;`
- Isi method `create()`: ambil data prodi, tampilkan view create
- Isi method `store()`: validasi input + simpan ke database + redirect dengan flash message

### `resources/views/mahasiswa/index.blade.php`
- Tambah tombol "Tambah Mahasiswa" di atas tabel (link ke route `mahasiswa.create`)
- Tambah blok notifikasi `@if (session('success'))` 
- Tambah blok notifikasi `@if (session('error'))`

## Konsep Baru

| Konsep | Penggunaan |
|--------|------------|
| `@csrf` | Token keamanan untuk form POST |
| `$request->validate()` | Validasi input di controller |
| `Model::create()` | Insert data dengan mass assignment |
| `redirect()->with()` | Flash message setelah redirect |
| `session('key')` | Akses flash message di view |
| `old('field')` | Pertahankan input setelah validasi gagal |
| `@error('field')` | Tampilkan error validasi per field |
| `route('name', $param)` | Generate URL dari nama route |
