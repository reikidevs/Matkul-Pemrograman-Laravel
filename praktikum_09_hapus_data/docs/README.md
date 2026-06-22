# Praktikum 09: Menghapus Data Mahasiswa

**Status:** ✅ Selesai

## Tujuan Pembelajaran

- Memahami HTTP method DELETE dan method spoofing
- Membuat pop up konfirmasi JS sebelum delete
- Menghapus data dari database dengan Eloquent
- Menampilkan notifikasi delete berhasil/gagal

## Instruksi Praktikum

1. Modifikasi button Hapus pada `index.blade.php`
2. Buat pop up JS untuk konfirmasi delete data
3. Buat penanganan untuk delete data di tabel
4. Tampilkan notifikasi berhasil atau gagal

## Persiapan

Praktikum ini melanjutkan Praktikum 08. Folder `praktikum_laravel/` di-copy dari Praktikum 08.

```bash
cd praktikum_09_hapus_data/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Langkah-Langkah

### 1. Tambahkan Route DELETE

Edit `routes/web.php`:

```php
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
```

### 2. Isi Method destroy() di Controller

Edit `app/Http/Controllers/MahasiswaController.php`:

```php
public function destroy(Mahasiswa $mahasiswa)
{
    try {
        $namaMahasiswa = $mahasiswa->nama;
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa "' . $namaMahasiswa . '" berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->route('mahasiswa.index')
            ->with('error', 'Data mahasiswa gagal dihapus: ' . $e->getMessage());
    }
}
```

> 📌 Method `destroy()` menggunakan Route Model Binding. Parameter `Mahasiswa $mahasiswa` otomatis berisi instance model berdasarkan ID di URL.

### 3. Modifikasi Button Hapus di index.blade.php

Ubah button Hapus dari `<a>` menjadi `<form>` dengan method spoofing:

**Sebelum:**
```blade
<a href="#" class="btn btn-sm btn-danger mr-2">Hapus</a>
```

**Sesudah:**
```blade
<form action="{{ route('mahasiswa.destroy', $shs->id) }}" method="POST"
      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa {{ $shs->nama }}?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
</form>
```

**Penjelasan:**

| Bagian | Fungsi |
|--------|--------|
| `method="POST"` | HTML hanya support GET/POST, jadi pakai POST |
| `@csrf` | Token keamanan |
| `@method('DELETE')` | Method spoofing → diterjemahkan Laravel sebagai DELETE |
| `onsubmit="return confirm(...)"` | Pop up konfirmasi; jika user klik Cancel, form tidak submit |
| `route('mahasiswa.destroy', $shs->id)` | URL `/mahasiswa/{id}` |

## Checklist

- [x] Route `mahasiswa.destroy` (DELETE) ditambahkan
- [x] Method `destroy()` menggunakan Route Model Binding
- [x] Method `destroy()` menghapus data dengan `->delete()`
- [x] Button Hapus di index sudah berbentuk form dengan `@method('DELETE')`
- [x] Pop up konfirmasi JS muncul saat klik Hapus
- [x] Cancel pada pop up membatalkan submit
- [x] Notifikasi sukses tampil setelah berhasil hapus
- [x] Notifikasi gagal tampil jika terjadi error

## Troubleshooting

**Error 405 Method Not Allowed**
- Pastikan ada `@method('DELETE')` di dalam form
- Pastikan route menggunakan `Route::delete()`

**Konfirmasi tidak muncul**
- Pastikan `onsubmit="return confirm(...)"` ada di tag `<form>`, bukan `<button>`
- Cek tidak ada error JavaScript di console browser

**Error "Class not found" saat delete**
- Pastikan ada `use App\Models\Mahasiswa;` di controller
- Run `composer dump-autoload`

**Foreign key constraint error**
- Jika menghapus Program Studi yang masih punya Mahasiswa, akan error
- Solusi: pastikan migration mahasiswa pakai `->onDelete('cascade')`

## Eksplorasi Tambahan

**Ganti `confirm()` dengan SweetAlert2:**
```html
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin hapus?',
            icon: 'warning',
            showCancelButton: true,
        }).then(result => {
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>
```

**Soft Delete:**
Tambah `use SoftDeletes;` di Model dan kolom `deleted_at` di migration untuk soft delete.
