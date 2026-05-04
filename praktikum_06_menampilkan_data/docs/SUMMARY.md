# Summary - Praktikum 06

## 📊 Ringkasan Implementasi

Praktikum 06 fokus pada **menampilkan data dari database** dengan menggunakan **Eloquent Accessor** untuk transformasi data otomatis.

---

## ✨ Fitur Utama

### 1. Eloquent Accessor

**Accessor** adalah method khusus di Model yang mengubah format data saat diakses, tanpa mengubah data asli di database.

#### Accessor Jenis Kelamin

```php
// Model Mahasiswa
protected function jenisKelamin(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => $value === 'L' ? 'Laki-laki' : 'Perempuan',
    );
}
```

**Hasil:**
- Database: `L` atau `P`
- Saat diakses: `"Laki-laki"` atau `"Perempuan"`

#### Accessor Fakultas

```php
// Model ProgramStudi
protected function fakultas(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => Str::title($value),
    );
}
```

**Hasil:**
- Database: `"fakultas teknologi informasi"`
- Saat diakses: `"Fakultas Teknologi Informasi"`

### 2. Relasi Eloquent

```php
// Model Mahasiswa
public function prodi()
{
    return $this->belongsTo(ProgramStudi::class, 'prodi_id', 'id');
}

// Controller
$mahasiswa = Mahasiswa::with('prodi')->latest()->get();

// View
{{ $mahasiswa->prodi->nama_prodi }}
{{ $mahasiswa->prodi->fakultas }}
```

---

## 🗄️ Database Schema

### Tabel `program_studis`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT (PK) | Auto increment |
| kode_prodi | VARCHAR(10) | Unique, contoh: SI, TI |
| nama_prodi | VARCHAR(100) | Nama program studi |
| **fakultas** | **VARCHAR(200)** | **Nama fakultas (BARU)** |
| **jenjang** | **ENUM** | **D3, S1, S2, S3 (BARU)** |
| created_at | TIMESTAMP | Otomatis |
| updated_at | TIMESTAMP | Otomatis |

### Tabel `mahasiswas`

Tidak ada perubahan dari Praktikum 05.

---

## 📁 File yang Dimodifikasi

### 1. Migration

**File:** `database/migrations/2024_04_14_000001_create_program_studis_table.php`

**Perubahan:**
```php
$table->string('fakultas', 200);              // BARU
$table->enum('jenjang', ['D3', 'S1', 'S2', 'S3']);  // BARU
```

### 2. Model ProgramStudi

**File:** `app/Models/ProgramStudi.php`

**Perubahan:**
```php
use Illuminate\Database\Eloquent\Casts\Attribute;  // BARU
use Illuminate\Support\Str;                         // BARU

protected $fillable = [
    'kode_prodi',
    'nama_prodi',
    'fakultas',  // BARU
    'jenjang',   // BARU
];

// Accessor BARU
protected function fakultas(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => Str::title($value),
    );
}
```

### 3. Model Mahasiswa

**File:** `app/Models/Mahasiswa.php`

**Perubahan:**
```php
use Illuminate\Database\Eloquent\Casts\Attribute;  // BARU

// Relasi (nama method diubah)
public function prodi()  // Sebelumnya: programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'prodi_id', 'id');
}

// Accessor BARU
protected function jenisKelamin(): Attribute
{
    return Attribute::make(
        get: fn(string $value) => $value === 'L' ? 'Laki-laki' : 'Perempuan',
    );
}
```

### 4. Seeder

**File:** `database/seeders/ProgramStudiSeeder.php`

**Perubahan:**
```php
[
    'kode_prodi' => 'SI',
    'nama_prodi' => 'Sistem Informasi',
    'fakultas' => 'fakultas teknologi informasi dan komunikasi',  // BARU
    'jenjang' => 'S1',  // BARU
]
```

### 5. Controller

**File:** `app/Http/Controllers/MahasiswaController.php`

**Perubahan:**
```php
public function index()
{
    $data['master'] = array('title' => 'Daftar Mahasiswa');
    $data['mahasiswa'] = Mahasiswa::with('prodi')->latest()->get();
    return view('mahasiswa.index', $data);
}
```

### 6. View

**File:** `resources/views/mahasiswa/index.blade.php`

**Perubahan:**
- Struktur tabel: 5 kolom (NO, Mahasiswa, Lahir, Program Studi, Aksi)
- Akses relasi: `$shs['prodi']` (sebelumnya `$shs->programStudi`)
- Jenis kelamin: `{{ $shs['jenis_kelamin'] }}` (otomatis transformasi)
- Fakultas: `{{ $shs['prodi']['fakultas'] }}` (otomatis Title Case)

---

## 🎯 Konsep yang Dipelajari

### 1. Eloquent Accessor

**Definisi:** Method di Model untuk transformasi data saat diakses.

**Keuntungan:**
- ✅ Data di database tetap dalam format asli (efisien)
- ✅ Transformasi otomatis saat diakses
- ✅ Kode lebih bersih dan reusable
- ✅ Tidak perlu transformasi manual di view

**Syntax:**
```php
protected function namaKolom(): Attribute
{
    return Attribute::make(
        get: fn($value) => // transformasi
    );
}
```

**Konvensi:**
- Method name: `camelCase` → `jenisKelamin()`
- Column name: `snake_case` → `jenis_kelamin`

### 2. String Helper

**Str::title():**
```php
Str::title('hello world')  // "Hello World"
```

**Helper Lainnya:**
- `Str::upper()`: UPPERCASE
- `Str::lower()`: lowercase
- `Str::ucfirst()`: Ucfirst
- `Str::slug()`: URL-friendly

### 3. Eager Loading

**Tanpa Eager Loading (N+1 Problem):**
```php
$mahasiswa = Mahasiswa::all();  // 1 query
foreach ($mahasiswa as $mhs) {
    echo $mhs->prodi->nama_prodi;  // N queries
}
// Total: 1 + N queries
```

**Dengan Eager Loading:**
```php
$mahasiswa = Mahasiswa::with('prodi')->all();  // 2 queries
foreach ($mahasiswa as $mhs) {
    echo $mhs->prodi->nama_prodi;  // Tidak ada query tambahan
}
// Total: 2 queries
```

### 4. Query Builder Methods

**latest():**
```php
Mahasiswa::latest()->get()  // ORDER BY created_at DESC
```

**oldest():**
```php
Mahasiswa::oldest()->get()  // ORDER BY created_at ASC
```

---

## 📊 Perbandingan dengan Praktikum 05

| Aspek | Praktikum 05 | Praktikum 06 |
|-------|--------------|--------------|
| **Jenis Kelamin** | Manual di view: `$mhs->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'` | Otomatis dengan Accessor: `$mhs->jenis_kelamin` |
| **Fakultas** | Tidak ada | Otomatis Title Case dengan Accessor |
| **Relasi** | `programStudi()` | `prodi()` (lebih singkat) |
| **Controller** | `compact('mahasiswa')` | Array `$data` dengan master |
| **View** | 7 kolom terpisah | 5 kolom (data digabung) |
| **Sorting** | Tidak ada | `latest()` (terbaru dulu) |

---

## 🚀 Perintah Penting

```bash
# Reset database dan jalankan seeder
php artisan migrate:fresh --seed

# Jalankan server
php artisan serve

# Akses halaman
http://localhost:8000/mahasiswa
```

---

## ✅ Hasil Akhir

### Halaman `/mahasiswa`

**Kolom yang ditampilkan:**

1. **NO**: Nomor urut
2. **Mahasiswa**: 
   - NIM
   - Nama
   - Jenis Kelamin (Laki-laki/Perempuan)
3. **Lahir**: 
   - Tempat, Tanggal (dd-mm-yyyy)
4. **Program Studi**:
   - Nama Fakultas (Title Case)
   - Nama Program Studi
5. **Aksi**:
   - Tombol Edit (warning)
   - Tombol Hapus (danger)

**Contoh Output:**

| NO | Mahasiswa | Lahir | Program Studi | Aksi |
|----|-----------|-------|---------------|------|
| 1 | G.131.24.0001<br>KURNIAWAN<br>Laki-laki | Semarang, 15-01-2005 | Fakultas Teknologi Informasi Dan Komunikasi<br>Sistem Informasi | [Edit] [Hapus] |

---

## 🎓 Best Practices

### 1. Gunakan Accessor untuk Transformasi

✅ **GOOD:**
```php
// Model
protected function jenisKelamin(): Attribute { ... }

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
// Database: lowercase
'fakultas' => 'fakultas teknologi informasi'

// Accessor: Title Case saat diakses
```

❌ **BAD:**
```php
// Database: mixed case
'fakultas' => 'Fakultas Teknologi Informasi'
```

---

## 📖 Referensi

- [Laravel Eloquent Accessors](https://laravel.com/docs/10.x/eloquent-mutators#defining-an-accessor)
- [Laravel String Helpers](https://laravel.com/docs/10.x/helpers#strings)
- [Laravel Eager Loading](https://laravel.com/docs/10.x/eloquent-relationships#eager-loading)

---

**Tanggal:** 4 Mei 2026  
**Versi Laravel:** 10.x  
**Database:** MySQL 8.0+
