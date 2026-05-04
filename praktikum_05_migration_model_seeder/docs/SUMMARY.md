# Summary - Praktikum 05

## 📊 Ringkasan Implementasi

Praktikum 05 memperkenalkan pengelolaan database di Laravel menggunakan **Migration**, **Model (Eloquent ORM)**, dan **Seeder**.

---

## 🗄️ Database Schema

### Tabel: `program_studis`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT (PK) | Auto increment |
| kode_prodi | VARCHAR(10) | Unique, contoh: SI, TI |
| nama_prodi | VARCHAR(100) | Nama program studi |
| created_at | TIMESTAMP | Otomatis |
| updated_at | TIMESTAMP | Otomatis |

**Data:** 6 program studi (SI, TI, MNJ, AKT, PSI, IKOM)

### Tabel: `mahasiswas`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT (PK) | Auto increment |
| nim | VARCHAR(20) | Unique |
| nama | VARCHAR(100) | Nama mahasiswa |
| tempat_lahir | VARCHAR(50) | Tempat lahir |
| tanggal_lahir | DATE | Tanggal lahir |
| jenis_kelamin | ENUM('L','P') | L = Laki-laki, P = Perempuan |
| prodi_id | BIGINT (FK) | Foreign key ke program_studis |
| created_at | TIMESTAMP | Otomatis |
| updated_at | TIMESTAMP | Otomatis |

**Data:** 10 mahasiswa dengan berbagai program studi

**Relasi:** `mahasiswas.prodi_id` → `program_studis.id` (ON DELETE CASCADE)

---

## 📁 File yang Dibuat/Dimodifikasi

### Migration Files
```
database/migrations/
├── 2024_04_14_000001_create_program_studis_table.php
└── 2024_04_14_000002_create_mahasiswas_table.php
```

### Model Files
```
app/Models/
├── ProgramStudi.php
└── Mahasiswa.php
```

### Seeder Files
```
database/seeders/
├── DatabaseSeeder.php (modified)
├── ProgramStudiSeeder.php
└── MahasiswaSeeder.php
```

### Controller & View
```
app/Http/Controllers/
└── MahasiswaController.php (modified)

resources/views/mahasiswa/
└── index.blade.php (modified)
```

---

## 🔗 Relasi Database

### One-to-Many Relationship

**ProgramStudi → Mahasiswa**

```php
// Model ProgramStudi
public function mahasiswas()
{
    return $this->hasMany(Mahasiswa::class, 'prodi_id');
}

// Model Mahasiswa
public function programStudi()
{
    return $this->belongsTo(ProgramStudi::class, 'prodi_id');
}
```

**Penggunaan:**
```php
// Ambil mahasiswa dengan program studi (Eager Loading)
$mahasiswa = Mahasiswa::with('programStudi')->get();

// Akses relasi di view
{{ $mhs->programStudi->nama_prodi }}
```

---

## 🎯 Konsep yang Dipelajari

### 1. Migration
- Membuat struktur tabel dengan Schema Builder
- Mendefinisikan kolom dengan tipe data yang tepat
- Membuat foreign key constraint
- Method `up()` dan `down()` untuk rollback

### 2. Model (Eloquent ORM)
- Konvensi penamaan (singular vs plural)
- Mass assignment dengan `$fillable`
- Type casting dengan `$casts`
- Relasi `hasMany` dan `belongsTo`

### 3. Seeder
- Mengisi data dummy/master data
- Menggunakan `Model::create()`
- Orchestration di `DatabaseSeeder`
- Urutan eksekusi seeder (parent dulu, child kemudian)

### 4. Eager Loading
- Menghindari N+1 query problem
- Menggunakan `with()` method
- Performa query lebih optimal

---

## 🚀 Perintah Penting

```bash
# Membuat migration
php artisan make:migration create_table_name

# Membuat model
php artisan make:model ModelName

# Membuat model + migration + factory + seeder
php artisan make:model ModelName -mfs

# Membuat seeder
php artisan make:seeder SeederName

# Menjalankan migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Reset database dan jalankan seeder
php artisan migrate:fresh --seed

# Menjalankan seeder saja
php artisan db:seed

# Menjalankan seeder tertentu
php artisan db:seed --class=SeederName
```

---

## 📈 Workflow Development

```
1. Buat Migration
   ↓
2. Definisikan struktur tabel (kolom, tipe, constraint)
   ↓
3. Jalankan migration (php artisan migrate)
   ↓
4. Buat Model dengan relasi
   ↓
5. Buat Seeder dengan data dummy
   ↓
6. Daftarkan seeder di DatabaseSeeder
   ↓
7. Jalankan seeder (php artisan db:seed)
   ↓
8. Update Controller untuk query database
   ↓
9. Update View untuk menampilkan data
   ↓
10. Testing di browser
```

---

## ✅ Hasil Akhir

### Halaman `/mahasiswa`

Menampilkan tabel dengan:
- ✅ 10 data mahasiswa dari database
- ✅ Informasi lengkap: NIM, Nama, Tempat/Tanggal Lahir, Jenis Kelamin
- ✅ Nama Program Studi (dari relasi, bukan ID)
- ✅ Format tanggal: dd-mm-yyyy
- ✅ Jenis kelamin: "Laki-laki" / "Perempuan"
- ✅ Tombol aksi (Edit, Hapus) - belum fungsional

### Database `akademik`

- ✅ Tabel `program_studis` dengan 6 data
- ✅ Tabel `mahasiswas` dengan 10 data
- ✅ Foreign key constraint berfungsi
- ✅ Timestamps otomatis terisi

---

## 🔍 Perbedaan dari Praktikum Sebelumnya

| Aspek | Praktikum 04 | Praktikum 05 |
|-------|--------------|--------------|
| **Data Source** | Array hardcoded | Database MySQL |
| **Data Access** | Array notation `$mhs['nim']` | Object notation `$mhs->nim` |
| **Relasi** | Manual array | Eloquent relationship |
| **Persistence** | Tidak persisten | Persisten di database |
| **Query** | Tidak ada | Eloquent ORM |

---

## 📚 Referensi

- [Laravel Migrations](https://laravel.com/docs/10.x/migrations)
- [Eloquent ORM](https://laravel.com/docs/10.x/eloquent)
- [Database Seeding](https://laravel.com/docs/10.x/seeding)
- [Eloquent Relationships](https://laravel.com/docs/10.x/eloquent-relationships)

---

**Tanggal:** 27 April 2026  
**Versi Laravel:** 10.x  
**Database:** MySQL 8.0+
