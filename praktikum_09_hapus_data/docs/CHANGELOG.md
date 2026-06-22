# CHANGELOG - Praktikum 09

Perubahan dari Praktikum 08 (Edit & Update) ke Praktikum 09 (Delete).

## File Diubah

### `routes/web.php`
- Tambah route DELETE `/mahasiswa/{mahasiswa}` → method `destroy()`

### `app/Http/Controllers/MahasiswaController.php`
- Isi method `destroy(Mahasiswa $mahasiswa)`: hapus data + redirect dengan flash message
- Ganti signature dari `destroy(string $id)` menjadi `destroy(Mahasiswa $mahasiswa)` (Route Model Binding)

### `resources/views/mahasiswa/index.blade.php`
- Modifikasi button Hapus: dari `<a href="#">` menjadi `<form>` dengan `@method('DELETE')`
- Tambah konfirmasi JS dengan `onsubmit="return confirm(...)"` 

## Konsep Baru

| Konsep | Penggunaan |
|--------|------------|
| `Route::delete()` | Definisi route HTTP method DELETE |
| `@method('DELETE')` | Method spoofing untuk DELETE |
| `confirm()` JS | Pop up konfirmasi browser sebelum delete |
| `onsubmit="return ..."` | Cancel submit jika konfirmasi `false` |
| `$model->delete()` | Hapus record dari database via Eloquent |
| `onDelete('cascade')` | Foreign key constraint - cascade delete relasi |

## Catatan Penting

**Kenapa pakai form, bukan link biasa?**
HTTP method DELETE tidak bisa dilakukan dengan tag `<a>` biasa (yang hanya GET). Solusi: gunakan `<form method="POST">` dengan `@method('DELETE')` untuk method spoofing.

**Konfirmasi sebelum delete:**
```html
<form onsubmit="return confirm('Yakin?');">
    ...
    <button type="submit">Hapus</button>
</form>
```
Jika user klik Cancel, `confirm()` return `false`, dan form tidak submit.

**Cascade delete:**
Di migration `mahasiswas`, foreign key `prodi_id` menggunakan `->onDelete('cascade')`. Artinya jika program studi dihapus, semua mahasiswa di prodi tersebut otomatis terhapus juga.
