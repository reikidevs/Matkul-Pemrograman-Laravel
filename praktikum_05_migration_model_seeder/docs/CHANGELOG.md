# Changelog - Praktikum 05

## Perubahan dari Praktikum 04

### File Baru - Database

1. **database/migrations/2024_04_14_000001_create_program_studis_table.php**
   - Migration untuk tabel program_studis
   - Kolom: id, kode_prodi, nama_prodi, timestamps

2. **database/migrations/2024_04_14_000002_create_mahasiswas_table.php**
   - Migration untuk tabel mahasiswas
   - Kolom: id, nim, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, prodi_id, timestamps
   - Foreign key ke program_studis

### File Baru - Models

3. **app/Models/ProgramStudi.php**
   - Model untuk tabel program_studis
   - Relasi hasMany dengan Mahasiswa
   - Fillable: kode_prodi, nama_prodi

4. **app/Models/Mahasiswa.php**
   - Model untuk tabel mahasiswas
   - Relasi belongsTo dengan ProgramStudi
   - Fillable: nim, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, prodi_id
   - Cast tanggal_lahir ke date

### File Baru - Seeders

5. **database/seeders/ProgramStudiSeeder.php**
   - Seeder untuk 6 program studi
   - Data: SI, TI, MNJ, AKT, PSI, IKOM

6. **database/seeders/MahasiswaSeeder.php**
   - Seeder untuk 10 mahasiswa
   - Data dengan relasi ke program studi

### File yang Dimodifikasi

7. **database/seeders/DatabaseSeeder.php**
   - Tambah call ke ProgramStudiSeeder dan MahasiswaSeeder

8. **app/Http/Controllers/MahasiswaController.php**
   - Update method index()
   - Menggunakan Mahasiswa::with('programStudi')->get()
   - Mengganti data dummy array dengan data dari database

9. **resources/views/mahasiswa/index.blade.php**
   - Update akses data dari array ke object
   - Menggunakan $mhs->nim instead of $mhs['nim']
   - Menampilkan nama prodi dari relasi: $mhs->programStudi->nama_prodi
   - Format tanggal dengan ->format('d-m-Y')

### Fitur yang Ditambahkan

- ✅ Database migration system
- ✅ Eloquent ORM models
- ✅ Database seeding
- ✅ One-to-Many relationship
- ✅ Eager loading dengan with()
- ✅ Data persistence di database
- ✅ Foreign key constraints

### Konsep yang Dipelajari

1. **Migration**
   - Schema Builder
   - Column types
   - Foreign key constraints
   - up() dan down() methods

2. **Model (Eloquent ORM)**
   - Mass assignment
   - Fillable properties
   - Type casting
   - Relationships (hasMany, belongsTo)

3. **Seeder**
   - Data population
   - DatabaseSeeder orchestration
   - Model::create() method

4. **Database Relations**
   - One-to-Many relationship
   - Eager loading
   - Accessing related data

---

## 🗄️ Database Schema

### Tabel program_studis
```sql
CREATE TABLE program_studis (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    kode_prodi VARCHAR(10) UNIQUE,
    nama_prodi VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabel mahasiswas
```sql
CREATE TABLE mahasiswas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    nim VARCHAR(20) UNIQUE,
    nama VARCHAR(100),
    tempat_lahir VARCHAR(50),
    tanggal_lahir DATE,
    jenis_kelamin ENUM('L', 'P'),
    prodi_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (prodi_id) REFERENCES program_studis(id) ON DELETE CASCADE
);
```

---

## 📊 Data yang Di-seed

### Program Studi (6 data)
1. SI - Sistem Informasi
2. TI - Teknik Informatika
3. MNJ - Manajemen
4. AKT - Akuntansi
5. PSI - Psikologi
6. IKOM - Ilmu Komunikasi

### Mahasiswa (10 data)
- 5 data dari praktikum sebelumnya
- 5 data baru dengan NIM format G.131.24.XXXX
- Tersebar di berbagai program studi

---

**Tanggal:** 14 April 2026  
**Versi Laravel:** 10.50.2  
**Database:** MySQL 8.0+
