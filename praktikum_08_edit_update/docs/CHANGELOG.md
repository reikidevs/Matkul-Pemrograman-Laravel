# CHANGELOG - Praktikum 08

Perubahan dari Praktikum 07 (Create) ke Praktikum 08 (Edit & Update).

## File Baru

- `resources/views/mahasiswa/edit.blade.php` - Form edit mahasiswa

## File Diubah

### `routes/web.php`
- Tambah route GET `/mahasiswa/{mahasiswa}/edit` → method `edit()`
- Tambah route PUT `/mahasiswa/{mahasiswa}` → method `update()`
- Menggunakan parameter `{mahasiswa}` untuk Route Model Binding

### `app/Http/Controllers/MahasiswaController.php`
- Isi method `edit(Mahasiswa $mahasiswa)`: ambil data prodi + tampilkan form edit dengan data terisi
- Isi method `update(Request $request, Mahasiswa $mahasiswa)`: validasi + update data + redirect

### `resources/views/mahasiswa/index.blade.php`
- Modifikasi button Edit: dari `href="#"` menjadi `href="{{ route('mahasiswa.edit', $shs->id) }}"`

## Konsep Baru

| Konsep | Penggunaan |
|--------|------------|
| Route Model Binding | Parameter `{mahasiswa}` otomatis di-resolve ke instance `Mahasiswa` |
| `@method('PUT')` | Method spoofing untuk method PUT (HTML hanya support GET/POST) |
| `$mahasiswa->nim` | Akses atribut model dengan tanda panah (object property) |
| `unique:mahasiswas,nim,{$id}` | Unique kecuali untuk record yang sedang diupdate |
| `getRawOriginal('field')` | Ambil nilai asli dari database (bypass accessor) |
| `old('field', $default)` | Pertahankan input lama, fallback ke nilai default |

## Catatan Penting

**Route Model Binding:**
Saat menggunakan parameter `{mahasiswa}` di route, Laravel akan otomatis mencari record `Mahasiswa` berdasarkan ID. Jika tidak ditemukan, otomatis return 404.

```php
// Di route
Route::get('/mahasiswa/{mahasiswa}/edit', ...);

// Di controller, parameter akan otomatis berisi instance Mahasiswa
public function edit(Mahasiswa $mahasiswa) {
    // $mahasiswa sudah berisi data lengkap
}
```

**Accessor pada jenis_kelamin:**
Karena di Model ada accessor yang mengubah `L` → `Laki-laki` dan `P` → `Perempuan`, saat menampilkan di select option harus pakai `getRawOriginal('jenis_kelamin')` agar dapat nilai aslinya (`L`/`P`).
