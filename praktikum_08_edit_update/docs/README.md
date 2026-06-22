# Praktikum 08: Mengedit Data Mahasiswa

**Status:** ✅ Selesai

## Tujuan Pembelajaran

- Memahami konsep Route Model Binding
- Membuat form edit dengan data otomatis terisi
- Menggunakan method spoofing `@method('PUT')`
- Implementasi update dengan validasi unique-except-self
- Menampilkan notifikasi update berhasil/gagal

## Instruksi Praktikum

1. Modifikasi button Edit pada `index.blade.php`
2. Buat form edit data di `edit.blade.php`
3. Buat penanganan untuk update data ke tabel
4. Tampilkan notifikasi berhasil atau gagal

## Persiapan

Praktikum ini melanjutkan Praktikum 07. Folder `praktikum_laravel/` di-copy dari Praktikum 07.

```bash
cd praktikum_08_edit_update/praktikum_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Langkah-Langkah

### 1. Tambahkan Routes

Edit `routes/web.php`, tambahkan route untuk edit dan update:

```php
Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
```

> 📌 **Note:** Parameter `{mahasiswa}` (bukan `{id}`) memicu Route Model Binding — Laravel otomatis mencari record Mahasiswa berdasarkan ID.

### 2. Tambahkan Method edit() dan update() di Controller

Edit `app/Http/Controllers/MahasiswaController.php`:

```php
public function edit(Mahasiswa $mahasiswa)
{
    $data['master'] = array('title' => 'Edit Mahasiswa');
    $data['mahasiswa'] = $mahasiswa;
    $data['prodi'] = ProgramStudi::orderBy('nama_prodi')->get();

    return view('mahasiswa.edit', $data);
}

public function update(Request $request, Mahasiswa $mahasiswa)
{
    $validated = $request->validate([
        'nim'           => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
        'nama'          => 'required|string|max:100',
        'tempat_lahir'  => 'required|string|max:50',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:L,P',
        'prodi_id'      => 'required|exists:program_studis,id',
    ]);

    try {
        $mahasiswa->update($validated);
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()
            ->with('error', 'Data mahasiswa gagal diupdate: ' . $e->getMessage());
    }
}
```

### 3. Modifikasi Button Edit di index.blade.php

Ubah button Edit dari:
```blade
<a href="#" class="btn btn-sm btn-warning mr-2">Edit</a>
```

Menjadi:
```blade
<a href="{{ route('mahasiswa.edit', $shs->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
```

### 4. Buat View edit.blade.php

Buat file baru `resources/views/mahasiswa/edit.blade.php`. 

Hal penting yang berbeda dari `create.blade.php`:

**Action form mengarah ke route update:**
```blade
<form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')
    ...
</form>
```

**Akses data dengan tanda panah:**
```blade
value="{{ old('nim', $mahasiswa->nim) }}"
value="{{ old('nama', $mahasiswa->nama) }}"
```

**Untuk select jenis_kelamin (karena ada accessor):**
```blade
@php $jkValue = old('jenis_kelamin', $mahasiswa->getRawOriginal('jenis_kelamin')); @endphp
<option value="L" {{ $jkValue == 'L' ? 'selected' : '' }}>Laki-laki</option>
<option value="P" {{ $jkValue == 'P' ? 'selected' : '' }}>Perempuan</option>
```

**Untuk select prodi:**
```blade
@foreach ($prodi as $p)
<option value="{{ $p->id }}"
    {{ old('prodi_id', $mahasiswa->prodi_id) == $p->id ? 'selected' : '' }}>
    {{ $p->kode_prodi }} - {{ $p->nama_prodi }}
</option>
@endforeach
```

## Checklist

- [x] Route `mahasiswa.edit` (GET) ditambahkan
- [x] Route `mahasiswa.update` (PUT) ditambahkan
- [x] Method `edit()` menggunakan Route Model Binding
- [x] Method `update()` melakukan validasi unique-except-self
- [x] Button Edit di index mengarah ke `mahasiswa.edit`
- [x] View `edit.blade.php` dibuat dengan data terisi otomatis
- [x] Form edit menggunakan `@method('PUT')`
- [x] Akses atribut model menggunakan `->` (panah)
- [x] Notifikasi sukses tampil setelah berhasil update

## Troubleshooting

**Error 405 Method Not Allowed**
- Pastikan ada `@method('PUT')` di dalam form
- Pastikan route menggunakan `Route::put()`, bukan `Route::post()`

**Data tidak otomatis terisi di form**
- Pastikan controller mengirim variabel `$mahasiswa` ke view
- Pastikan menggunakan `$mahasiswa->nim` (panah), bukan `$mahasiswa['nim']`

**NIM error "sudah terdaftar" padahal tidak diubah**
- Pastikan validasi `unique` menggunakan exception ID:
  `unique:mahasiswas,nim,' . $mahasiswa->id`

**Jenis kelamin tidak ter-select**
- Gunakan `getRawOriginal('jenis_kelamin')` karena ada accessor di Model
