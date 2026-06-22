# Praktikum 10: CRUD Program Studi - Tutorial Lengkap

## 📋 Instruksi Praktikum

> Silahkan membuat CRUD untuk menangani menu **Program Studi**

## 🎯 Ringkasan

Pada praktikum ini, kita membuat CRUD lengkap untuk entitas Program Studi dengan mengikuti pattern yang sudah dipelajari pada CRUD Mahasiswa (Praktikum 07–09).

## 📁 File yang Dibuat/Dimodifikasi

### File Baru
| File | Keterangan |
|------|-----------|
| `app/Http/Controllers/ProgramStudiController.php` | Controller CRUD Program Studi |
| `resources/views/prodi/index.blade.php` | Halaman daftar program studi |
| `resources/views/prodi/create.blade.php` | Form tambah program studi |
| `resources/views/prodi/edit.blade.php` | Form edit program studi |

### File Dimodifikasi
| File | Perubahan |
|------|-----------|
| `routes/web.php` | Menambahkan route CRUD untuk program studi |
| `resources/views/layout/layout.blade.php` | Mengaktifkan link sidebar "Data Program Studi" |
| `.env` | Mengubah DB_DATABASE menjadi `akademik` |

---

## 📝 Langkah-langkah Implementasi

### Step 1: Membuat ProgramStudiController

Buat controller baru di `app/Http/Controllers/ProgramStudiController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    // Method index() - Menampilkan daftar program studi
    public function index()
    {
        $data['master'] = array('title' => 'Daftar Program Studi');
        $data['prodi'] = ProgramStudi::withCount('mahasiswas')->latest()->get();

        return view('prodi.index', $data);
    }

    // Method create() - Menampilkan form tambah
    public function create()
    {
        $data['master'] = array('title' => 'Tambah Program Studi');
        return view('prodi.create', $data);
    }

    // Method store() - Menyimpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi',
            'nama_prodi' => 'required|string|max:100',
            'fakultas'   => 'required|string|max:200',
            'jenjang'    => 'required|in:D3,S1,S2,S3',
        ]);

        try {
            ProgramStudi::create($validated);
            return redirect()->route('prodi.index')
                ->with('success', 'Data program studi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Data gagal ditambahkan: ' . $e->getMessage());
        }
    }

    // Method edit() - Menampilkan form edit (Route Model Binding)
    public function edit(ProgramStudi $prodi)
    {
        $data['master'] = array('title' => 'Edit Program Studi');
        $data['prodi'] = $prodi;
        return view('prodi.edit', $data);
    }

    // Method update() - Mengupdate data
    public function update(Request $request, ProgramStudi $prodi)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:program_studis,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'required|string|max:100',
            'fakultas'   => 'required|string|max:200',
            'jenjang'    => 'required|in:D3,S1,S2,S3',
        ]);

        try {
            $prodi->update($validated);
            return redirect()->route('prodi.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Data gagal diupdate: ' . $e->getMessage());
        }
    }

    // Method destroy() - Menghapus data
    public function destroy(ProgramStudi $prodi)
    {
        try {
            // Cek referential integrity
            if ($prodi->mahasiswas()->count() > 0) {
                return redirect()->route('prodi.index')
                    ->with('error', 'Tidak dapat dihapus, masih ada mahasiswa terkait');
            }

            $namaProdi = $prodi->nama_prodi;
            $prodi->delete();

            return redirect()->route('prodi.index')
                ->with('success', 'Data "' . $namaProdi . '" berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('prodi.index')
                ->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }
}
```

**Catatan penting:**
- Menggunakan `withCount('mahasiswas')` untuk menampilkan jumlah mahasiswa per prodi
- Cek referential integrity sebelum hapus (tolak jika masih ada mahasiswa)
- Pattern validasi sama dengan MahasiswaController

---

### Step 2: Menambahkan Routes

Edit file `routes/web.php`, tambahkan route berikut:

```php
use App\Http\Controllers\ProgramStudiController;

// Route untuk program studi (CRUD)
Route::get('/prodi', [ProgramStudiController::class, 'index'])->name('prodi.index');
Route::get('/prodi/create', [ProgramStudiController::class, 'create'])->name('prodi.create');
Route::post('/prodi', [ProgramStudiController::class, 'store'])->name('prodi.store');
Route::get('/prodi/{prodi}/edit', [ProgramStudiController::class, 'edit'])->name('prodi.edit');
Route::put('/prodi/{prodi}', [ProgramStudiController::class, 'update'])->name('prodi.update');
Route::delete('/prodi/{prodi}', [ProgramStudiController::class, 'destroy'])->name('prodi.destroy');
```

---

### Step 3: Membuat Views

Buat folder `resources/views/prodi/` dengan 3 file:

#### 3.1 index.blade.php
- Tabel daftar program studi dengan kolom: NO, Kode Prodi, Nama Program Studi, Fakultas, Jenjang, Jumlah Mahasiswa, Aksi
- Tombol Tambah, Edit, Hapus
- Flash message sukses/gagal
- Konfirmasi JavaScript saat hapus

#### 3.2 create.blade.php
- Form input: kode_prodi, nama_prodi, fakultas, jenjang (dropdown)
- Validasi error display
- CSRF token
- Tombol Simpan dan Kembali

#### 3.3 edit.blade.php
- Form edit dengan data terisi (`old()` + data lama)
- `getRawOriginal('fakultas')` agar form tidak terpengaruh accessor
- Method spoofing `@method('PUT')`
- Tombol Update dan Kembali

---

### Step 4: Update Sidebar Navigation

Edit `resources/views/layout/layout.blade.php`, ubah link Program Studi:

```html
<!-- Dari -->
<li><a href="#">Data Program Studi</a></li>

<!-- Menjadi -->
<li><a href="/prodi">Data Program Studi</a></li>
```

---

## 🔑 Konsep Kunci

### 1. Route Model Binding
Laravel otomatis mengambil data dari database berdasarkan parameter URL:
```php
// {prodi} di route otomatis di-resolve menjadi instance ProgramStudi
public function edit(ProgramStudi $prodi) { ... }
```

### 2. withCount()
Menghitung jumlah relasi tanpa mengambil semua data:
```php
ProgramStudi::withCount('mahasiswas')->get();
// Akses: $prodi->mahasiswas_count
```

### 3. Referential Integrity
Mencegah hapus data yang masih memiliki relasi:
```php
if ($prodi->mahasiswas()->count() > 0) {
    return redirect()->with('error', 'Masih ada mahasiswa terkait');
}
```

### 4. getRawOriginal()
Mengambil nilai asli dari database (bypass accessor):
```php
// Di form edit, agar fakultas tidak jadi title case
value="{{ old('fakultas', $prodi->getRawOriginal('fakultas')) }}"
```

---

## ✅ Checklist Penyelesaian

- [x] ProgramStudiController dengan 6 method CRUD
- [x] Route CRUD untuk program studi
- [x] View index.blade.php (daftar + hapus)
- [x] View create.blade.php (form tambah)
- [x] View edit.blade.php (form edit)
- [x] Validasi input di store() dan update()
- [x] Flash message berhasil/gagal
- [x] Konfirmasi JavaScript saat hapus
- [x] Cek referential integrity sebelum hapus
- [x] Sidebar navigation terhubung ke /prodi
- [x] Jumlah mahasiswa ditampilkan per prodi
