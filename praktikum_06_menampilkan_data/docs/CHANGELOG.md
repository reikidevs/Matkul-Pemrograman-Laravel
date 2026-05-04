# Changelog - Praktikum 06

## Perubahan dari Praktikum 05

### File yang Dimodifikasi

#### 1. **database/migrations/2024_04_14_000001_create_program_studis_table.php**
   - ✅ Tambah kolom `fakultas` (VARCHAR 200)
   - ✅ Tambah kolom `jenjang` (ENUM: D3, S1, S2, S3)

#### 2. **app/Models/ProgramStudi.php**
   - ✅ Import `Illuminate\Database\Eloquent\Casts\Attribute`
   - ✅ Import `Illuminate\Support\Str`
   - ✅ Tambah `fakultas` dan `jenjang` ke `$fillable`
   - ✅ Tambah accessor `fakultas()` untuk Title Case otomatis

#### 3. **app/Models/Mahasiswa.php**
   - ✅ Import `Illuminate\Database\Eloquent\Casts\Attribute`
   - ✅ Ubah nama method relasi dari `programStudi()` ke `prodi()`
   - ✅ Tambah accessor `jenisKelamin()` untuk transformasi L/P

#### 4. **database/seeders/ProgramStudiSeeder.php**
   - ✅ Tambah data `fakultas` untuk setiap program studi
   - ✅ Tambah data `jenjang` untuk setiap program studi
   - ✅ Data fakultas disimpan dalam huruf kecil

#### 5. **app/Http/Controllers/MahasiswaController.php**
   - ✅ Ubah struktur data dari `compact()` ke array `$data`
   - ✅ Tambah `$data['master']` untuk title halaman
   - ✅ Ubah `with('programStudi')` ke `with('prodi')`
   - ✅ Tambah `latest()` untuk sorting data terbaru

#### 6. **resources/views/mahasiswa/index.blade.php**
   - ✅ Ubah struktur tabel (4 kolom: NO, Mahasiswa, Lahir, Program Studi, Aksi)
   - ✅ Ubah akses relasi dari `programStudi` ke `prodi`
   - ✅ Tampilkan fakultas dengan accessor (otomatis Title Case)
   - ✅ Tampilkan jenis kelamin dengan accessor (otomatis Laki-laki/Perempuan)
   - ✅ Ubah layout tombol aksi

---

## Fitur Baru yang Ditambahkan

### 1. Eloquent Accessor

**Accessor untuk Jenis Kelamin:**
```php
protected function jenisKelamin(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => $value === 'L' ? 'Laki-laki' : 'Perempuan',
    );
}
```

**Keuntungan:**
- Data di database tetap "L" atau "P" (efisien)
- Saat diakses otomatis menjadi "Laki-laki" atau "Perempuan"
- Tidak perlu transformasi manual di view

**Accessor untuk Fakultas:**
```php
protected function fakultas(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => Str::title($value),
    );
}
```

**Keuntungan:**
- Data di database dalam huruf kecil (konsisten)
- Saat diakses otomatis menjadi Title Case
- Menggunakan helper `Str::title()` dari Laravel

### 2. Kolom Database Baru

**Tabel `program_studis`:**
- `fakultas` (VARCHAR 200): Nama fakultas
- `jenjang` (ENUM): D3, S1, S2, S3

### 3. Perubahan Nama Relasi

**Sebelumnya:**
```php
// Model Mahasiswa
public function programStudi() { ... }

// View
{{ $mahasiswa->programStudi->nama_prodi }}
```

**Sekarang:**
```php
// Model Mahasiswa
public function prodi() { ... }

// View
{{ $mahasiswa->prodi->nama_prodi }}
```

**Alasan:** Nama lebih singkat dan konsisten dengan konvensi

### 4. Perubahan Struktur View

**Sebelumnya:**
- 7 kolom: NO, NIM, NAMA, TEMPAT LAHIR, TANGGAL LAHIR, JENIS KELAMIN, PROGRAM STUDI

**Sekarang:**
- 5 kolom: NO, Mahasiswa, Lahir, Program Studi, Aksi
- Data digabung untuk tampilan lebih compact

---

## Konsep yang Dipelajari

### 1. Eloquent Accessor

**Definisi:** Method khusus di Model untuk mengubah format data saat diakses.

**Syntax Modern (Laravel 9+):**
```php
use Illuminate\Database\Eloquent\Casts\Attribute;

protected function namaKolom(): Attribute
{
    return Attribute::make(
        get: fn($value) => // transformasi
    );
}
```

**Syntax Lama (Laravel 8.x):**
```php
public function getNamaKolomAttribute($value)
{
    return // transformasi
}
```

**Konvensi Penamaan:**
- Nama method: `camelCase` → `jenisKelamin()`
- Nama kolom database: `snake_case` → `jenis_kelamin`
- Laravel otomatis mapping

### 2. String Helper

**Str::title():**
```php
Str::title('hello world')  // "Hello World"
Str::title('HELLO WORLD')  // "Hello World"
Str::title('fakultas teknologi informasi')  // "Fakultas Teknologi Informasi"
```

**Helper Lainnya:**
- `Str::upper()`: UPPERCASE
- `Str::lower()`: lowercase
- `Str::ucfirst()`: Ucfirst
- `Str::slug()`: URL-friendly

### 3. Query Builder Methods

**latest():**
```php
// Urutkan berdasarkan created_at DESC (terbaru dulu)
Mahasiswa::latest()->get()

// Sama dengan:
Mahasiswa::orderBy('created_at', 'desc')->get()
```

**oldest():**
```php
// Urutkan berdasarkan created_at ASC (terlama dulu)
Mahasiswa::oldest()->get()
```

---

## Perbandingan Kode

### Controller

**Praktikum 05:**
```php
public function index()
{
    $mahasiswa = Mahasiswa::with('programStudi')->get();
    return view('mahasiswa.index', compact('mahasiswa'));
}
```

**Praktikum 06:**
```php
public function index()
{
    $data['master'] = array('title' => 'Daftar Mahasiswa');
    $data['mahasiswa'] = Mahasiswa::with('prodi')->latest()->get();
    return view('mahasiswa.index', $data);
}
```

### View

**Praktikum 05:**
```blade
<td>{{ $mhs->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
<td>{{ $mhs->programStudi->nama_prodi }}</td>
```

**Praktikum 06:**
```blade
<td>{{ $shs['jenis_kelamin'] }}</td>  {{-- Otomatis "Laki-laki" atau "Perempuan" --}}
<td>
    {{ $shs['prodi']['fakultas'] }}<br>  {{-- Otomatis Title Case --}}
    {{ $shs['prodi']['nama_prodi'] }}
</td>
```

---

## Database Schema Update

### Tabel `program_studis` (Sebelumnya)

```sql
CREATE TABLE program_studis (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    kode_prodi VARCHAR(10) UNIQUE,
    nama_prodi VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabel `program_studis` (Sekarang)

```sql
CREATE TABLE program_studis (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    kode_prodi VARCHAR(10) UNIQUE,
    nama_prodi VARCHAR(100),
    fakultas VARCHAR(200),              -- BARU
    jenjang ENUM('D3','S1','S2','S3'),  -- BARU
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## Data Seeder Update

### Sebelumnya

```php
[
    'kode_prodi' => 'SI',
    'nama_prodi' => 'Sistem Informasi',
]
```

### Sekarang

```php
[
    'kode_prodi' => 'SI',
    'nama_prodi' => 'Sistem Informasi',
    'fakultas' => 'fakultas teknologi informasi dan komunikasi',  // BARU
    'jenjang' => 'S1',  // BARU
]
```

**Catatan:** Data fakultas disimpan dalam huruf kecil, tapi akan otomatis Title Case saat diakses.

---

## Testing Checklist

### Accessor Jenis Kelamin
- [ ] Data "L" di database tampil sebagai "Laki-laki"
- [ ] Data "P" di database tampil sebagai "Perempuan"
- [ ] Tidak ada error saat akses `$mahasiswa->jenis_kelamin`

### Accessor Fakultas
- [ ] Data "fakultas teknologi informasi" tampil sebagai "Fakultas Teknologi Informasi"
- [ ] Setiap kata diawali huruf kapital
- [ ] Tidak ada error saat akses `$prodi->fakultas`

### Relasi
- [ ] Data program studi tampil dengan benar
- [ ] Nama fakultas tampil
- [ ] Nama program studi tampil
- [ ] Tidak ada N+1 query problem (gunakan `with('prodi')`)

### View
- [ ] Tabel tampil dengan 5 kolom
- [ ] Data mahasiswa tampil lengkap
- [ ] Format tanggal: dd-mm-yyyy
- [ ] Tombol Edit dan Hapus tampil

---

## Performance Notes

### Eager Loading

**Tanpa Eager Loading (N+1 Problem):**
```php
$mahasiswa = Mahasiswa::all();  // 1 query

foreach ($mahasiswa as $mhs) {
    echo $mhs->prodi->nama_prodi;  // N queries (1 per mahasiswa)
}
// Total: 1 + N queries
```

**Dengan Eager Loading:**
```php
$mahasiswa = Mahasiswa::with('prodi')->all();  // 2 queries

foreach ($mahasiswa as $mhs) {
    echo $mhs->prodi->nama_prodi;  // Tidak ada query tambahan
}
// Total: 2 queries saja
```

**Kesimpulan:** Selalu gunakan `with()` untuk relasi yang akan diakses!

---

## Best Practices

### 1. Gunakan Accessor untuk Transformasi Data

✅ **GOOD:**
```php
// Model
protected function jenisKelamin(): Attribute
{
    return Attribute::make(
        get: fn($value) => $value === 'L' ? 'Laki-laki' : 'Perempuan',
    );
}

// View
{{ $mahasiswa->jenis_kelamin }}
```

❌ **BAD:**
```php
// View
{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
```

### 2. Gunakan Eager Loading

✅ **GOOD:**
```php
Mahasiswa::with('prodi')->get()
```

❌ **BAD:**
```php
Mahasiswa::all()  // N+1 problem
```

### 3. Simpan Data dalam Format Standar

✅ **GOOD:**
```php
// Database: "fakultas teknologi informasi" (lowercase)
// Accessor: Str::title() untuk Title Case saat diakses
```

❌ **BAD:**
```php
// Database: "Fakultas Teknologi Informasi" (mixed case)
// Tidak konsisten, sulit untuk query
```

---

**Tanggal:** 4 Mei 2026  
**Versi Laravel:** 10.x  
**Database:** MySQL 8.0+
