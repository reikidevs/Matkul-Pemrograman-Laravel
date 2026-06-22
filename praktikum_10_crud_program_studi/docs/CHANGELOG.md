# Changelog: Praktikum 10 - CRUD Program Studi

## Perubahan dari Praktikum 09 (Hapus Data)

### ➕ File Baru

1. **`app/Http/Controllers/ProgramStudiController.php`**
   - Controller CRUD lengkap untuk Program Studi
   - Method: index, create, store, edit, update, destroy
   - Validasi input dengan custom error messages
   - Cek referential integrity sebelum delete
   - withCount untuk menampilkan jumlah mahasiswa

2. **`resources/views/prodi/index.blade.php`**
   - Tabel daftar program studi
   - Kolom: NO, Kode Prodi, Nama Prodi, Fakultas, Jenjang, Jumlah Mahasiswa, Aksi
   - Tombol Tambah, Edit, Hapus
   - Flash message sukses/gagal
   - Konfirmasi JavaScript saat hapus

3. **`resources/views/prodi/create.blade.php`**
   - Form tambah program studi
   - Field: kode_prodi, nama_prodi, fakultas, jenjang (dropdown)
   - Validasi error display
   - CSRF protection

4. **`resources/views/prodi/edit.blade.php`**
   - Form edit program studi
   - Data terisi otomatis dari database
   - getRawOriginal('fakultas') untuk bypass accessor
   - Method spoofing PUT

### ✏️ File Dimodifikasi

1. **`routes/web.php`**
   - Ditambahkan 6 route CRUD untuk program studi
   - Import ProgramStudiController

2. **`resources/views/layout/layout.blade.php`**
   - Link sidebar "Data Program Studi" diubah dari `#` ke `/prodi`

3. **`.env`**
   - DB_DATABASE diubah dari `laravel` ke `akademik`

### 🔄 File Tidak Berubah

- Model ProgramStudi (sudah ada dari Praktikum 05)
- Migration (sudah ada dari Praktikum 05)
- Seeder (sudah ada dari Praktikum 05)
- Semua file mahasiswa (controller, views)
