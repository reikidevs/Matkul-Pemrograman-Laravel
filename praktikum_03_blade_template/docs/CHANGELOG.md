# Changelog - Praktikum 03

## Perubahan dari Praktikum 02

### File yang Dimodifikasi

1. **app/Http/Controllers/MahasiswaController.php**
   - Ubah data mahasiswa dari single object menjadi array of arrays
   - Tambah 5 data mahasiswa sesuai instruksi
   - Data mahasiswa sekarang: 20240001 - 20240005

2. **resources/views/mahasiswa/index.blade.php**
   - Ubah tampilan dari list menjadi tabel HTML
   - Tambah @foreach untuk looping data
   - Tambah kolom: NO, MAHASISWA, LAHIR, PROGRAM STUDI, AKSI
   - Hapus CSS inline (sesuai instruksi: tanpa CSS)
   - Tambah link Edit dan Hapus

### Fitur yang Ditambahkan

- ✅ Tabel HTML dengan border
- ✅ Looping data dengan @foreach
- ✅ Menampilkan 5 data mahasiswa
- ✅ Kolom MAHASISWA dengan 3 baris (NIM, Nama, Jenis Kelamin)
- ✅ Kolom LAHIR dengan format "Tempat, Tanggal"
- ✅ Kolom AKSI dengan link Edit dan Hapus

### Konsep Blade yang Dipelajari

1. **@foreach Directive**
   - Looping array data
   - Menggunakan $index untuk nomor urut
   - Mengakses data array dengan key

2. **{{ }} Syntax**
   - Menampilkan data dengan HTML escaping
   - Array access: `$mhs['key']`

3. **Array Multidimensional**
   - Array of arrays
   - Setiap element adalah associative array

4. **HTML Table**
   - Structure: table > thead/tbody > tr > th/td
   - Attributes: border, cellpadding, cellspacing

---

## Data Mahasiswa

| NO | NIM | Nama | Tempat Lahir | Tgl Lahir | Jenis Kelamin | Prodi |
|----|-----|------|--------------|-----------|---------------|-------|
| 1 | 20240001 | Fajar Santoso | Yogyakarta | 2003-08-02 | Perempuan | Manajemen |
| 2 | 20240002 | Lani Utami | Bandung | 2003-03-11 | Laki-laki | Manajemen |
| 3 | 20240003 | Agus Wijaya | Bandung | 2001-01-28 | Laki-laki | Ilmu Komunikasi |
| 4 | 20240004 | Rian Utami | Jakarta | 2000-04-10 | Laki-laki | Psikologi |
| 5 | 20240005 | Budi Wulandari | Medan | 2002-11-21 | Laki-laki | Akuntansi |

---

## Perbedaan dengan Praktikum 02

| Aspek | Praktikum 02 | Praktikum 03 |
|-------|--------------|--------------|
| Data | Single object | Array of arrays (5 data) |
| View | List dengan styling | Tabel HTML tanpa CSS |
| Looping | Tidak ada | @foreach |
| Kolom | 6 field vertikal | 5 kolom horizontal |
| Aksi | Tidak ada | Link Edit & Hapus |

---

**Tanggal:** 13 April 2026  
**Versi Laravel:** 10.50.2
