# Contoh Studi Kasus: Sistem Perpustakaan Digital "DigiLib"

## 📚 Overview

**Nama Aplikasi:** DigiLib - Sistem Perpustakaan Digital  
**Kategori:** Sistem Informasi Perpustakaan  
**Target User:** Mahasiswa, Pustakawan, Admin

---

## 1. Latar Belakang

### Permasalahan

Saat ini, proses pengelolaan perpustakaan di Universitas Semarang masih dilakukan secara manual. Mahasiswa harus datang langsung ke perpustakaan untuk:
- Mencari ketersediaan buku
- Meminjam dan mengembalikan buku
- Memperpanjang masa pinjam

Hal ini menyebabkan beberapa masalah:
- **Antrian panjang** saat jam sibuk
- **Waktu terbuang** untuk mencari buku
- **Keterlambatan pengembalian** karena tidak ada notifikasi
- **Kesulitan tracking** buku yang dipinjam
- **Laporan manual** yang memakan waktu

### Solusi

Aplikasi DigiLib dirancang sebagai sistem perpustakaan digital yang dapat diakses secara online. Dengan aplikasi ini, mahasiswa dapat:
- Mencari buku secara online
- Melakukan peminjaman dan perpanjangan online
- Menerima notifikasi otomatis
- Melihat riwayat peminjaman

### Manfaat

**Untuk Mahasiswa:**
- Hemat waktu (tidak perlu antri)
- Mudah mencari buku
- Notifikasi jatuh tempo otomatis
- Akses 24/7

**Untuk Pustakawan:**
- Proses lebih efisien
- Tracking otomatis
- Laporan real-time
- Mengurangi kesalahan manual

**Untuk Perpustakaan:**
- Meningkatkan layanan
- Data terorganisir
- Statistik penggunaan
- Paperless

---

## 2. Fitur Utama

### 2.1 Fitur untuk Anggota (Mahasiswa)

1. **Registrasi & Login**
   - Daftar akun dengan NIM
   - Login dengan email/NIM

2. **Katalog Buku**
   - Browse katalog buku
   - Pencarian (judul, penulis, kategori)
   - Filter (kategori, tahun, ketersediaan)
   - Detail buku (sinopsis, penulis, stok)

3. **Peminjaman**
   - Pinjam buku online
   - Maksimal 3 buku
   - Durasi 7 hari

4. **Perpanjangan**
   - Perpanjang masa pinjam (max 1x)
   - Durasi tambahan 7 hari

5. **Pengembalian**
   - Konfirmasi pengembalian
   - Scan QR code

6. **Notifikasi**
   - H-2 sebelum jatuh tempo
   - Hari jatuh tempo
   - Keterlambatan

7. **Riwayat**
   - Riwayat peminjaman
   - Status buku (dipinjam, dikembalikan, terlambat)

8. **Denda**
   - Lihat denda
   - Rp 1.000/hari keterlambatan

### 2.2 Fitur untuk Pustakawan

1. **Dashboard**
   - Statistik peminjaman
   - Buku terpopuler
   - Denda tertunggak

2. **Manajemen Peminjaman**
   - Approve peminjaman
   - Konfirmasi pengembalian
   - Perpanjangan

3. **Manajemen Buku**
   - Tambah buku baru
   - Edit data buku
   - Hapus buku
   - Update stok

4. **Manajemen Anggota**
   - Lihat data anggota
   - Aktivasi/nonaktifkan akun
   - Riwayat peminjaman anggota

5. **Laporan**
   - Laporan peminjaman (harian, bulanan)
   - Laporan denda
   - Laporan buku populer

### 2.3 Fitur untuk Admin

1. **Manajemen User**
   - Kelola pustakawan
   - Kelola anggota
   - Role & permission

2. **Konfigurasi Sistem**
   - Atur durasi pinjam
   - Atur maksimal buku
   - Atur denda

3. **Backup Data**
   - Backup database
   - Restore data

---

## 3. Aktor

### 3.1 Anggota (Mahasiswa)
**Deskripsi:** Pengguna yang meminjam buku  
**Hak Akses:**
- Browse katalog
- Pinjam buku
- Perpanjang pinjaman
- Lihat riwayat
- Bayar denda

### 3.2 Pustakawan
**Deskripsi:** Petugas perpustakaan  
**Hak Akses:**
- Approve peminjaman
- Konfirmasi pengembalian
- Kelola buku
- Lihat laporan

### 3.3 Admin
**Deskripsi:** Administrator sistem  
**Hak Akses:**
- Semua akses pustakawan
- Kelola user
- Konfigurasi sistem
- Backup data

---

## 4. Use Case

### 4.1 Use Case Anggota

| ID | Use Case | Deskripsi |
|----|----------|-----------|
| UC-01 | Login | Anggota login ke sistem |
| UC-02 | Browse Katalog | Anggota melihat daftar buku |
| UC-03 | Cari Buku | Anggota mencari buku |
| UC-04 | Lihat Detail Buku | Anggota melihat detail buku |
| UC-05 | Pinjam Buku | Anggota meminjam buku |
| UC-06 | Perpanjang Pinjaman | Anggota memperpanjang masa pinjam |
| UC-07 | Lihat Riwayat | Anggota melihat riwayat peminjaman |
| UC-08 | Lihat Denda | Anggota melihat denda |

### 4.2 Use Case Pustakawan

| ID | Use Case | Deskripsi |
|----|----------|-----------|
| UC-09 | Approve Peminjaman | Pustakawan menyetujui peminjaman |
| UC-10 | Konfirmasi Pengembalian | Pustakawan konfirmasi pengembalian |
| UC-11 | Tambah Buku | Pustakawan menambah buku baru |
| UC-12 | Edit Buku | Pustakawan mengedit data buku |
| UC-13 | Hapus Buku | Pustakawan menghapus buku |
| UC-14 | Lihat Laporan | Pustakawan melihat laporan |

### 4.3 Use Case Admin

| ID | Use Case | Deskripsi |
|----|----------|-----------|
| UC-15 | Kelola User | Admin mengelola user |
| UC-16 | Konfigurasi Sistem | Admin mengatur konfigurasi |
| UC-17 | Backup Data | Admin backup database |

---

## 5. Activity Diagram (Contoh)

### 5.1 Proses Peminjaman Buku

**Alur:**
1. Anggota login
2. Anggota cari buku
3. Anggota pilih buku
4. Sistem cek ketersediaan
   - Jika tersedia → lanjut
   - Jika tidak → tampil pesan error
5. Sistem cek kuota anggota (max 3 buku)
   - Jika belum penuh → lanjut
   - Jika penuh → tampil pesan error
6. Anggota konfirmasi peminjaman
7. Sistem buat transaksi peminjaman (status: pending)
8. Notifikasi ke pustakawan
9. Pustakawan approve
10. Status berubah: approved
11. Anggota ambil buku di perpustakaan
12. Pustakawan scan QR code
13. Status berubah: dipinjam
14. Selesai

---

### 5.2 Proses Pengembalian Buku

**Alur:**
1. Anggota datang ke perpustakaan
2. Anggota serahkan buku
3. Pustakawan scan QR code buku
4. Sistem cek tanggal jatuh tempo
   - Jika tepat waktu → tidak ada denda
   - Jika terlambat → hitung denda
5. Jika ada denda:
   - Tampil jumlah denda
   - Anggota bayar denda
   - Pustakawan konfirmasi pembayaran
6. Pustakawan konfirmasi pengembalian
7. Status berubah: dikembalikan
8. Stok buku bertambah
9. Selesai

---

## 6. Sequence Diagram (Contoh)

### 6.1 Skenario: Anggota Pinjam Buku

**Objek yang Terlibat:**
- Anggota (Actor)
- BukuPage (Boundary)
- PeminjamanController (Control)
- Buku (Entity)
- Peminjaman (Entity)
- Database (Entity)

**Interaksi:**
```
Anggota → BukuPage: pilih buku
BukuPage → PeminjamanController: request pinjam
PeminjamanController → Buku: cek ketersediaan
Buku → Database: query stok
Database → Buku: return stok
Buku → PeminjamanController: stok tersedia
PeminjamanController → Peminjaman: create transaksi
Peminjaman → Database: insert data
Database → Peminjaman: success
Peminjaman → PeminjamanController: transaksi created
PeminjamanController → BukuPage: success response
BukuPage → Anggota: tampil konfirmasi
```

---

## 7. Class Diagram (Contoh)

### 7.1 Class Utama

#### Class: User
```
User
-----------------
- id: int
- email: string
- password: string
- role: enum (anggota, pustakawan, admin)
- created_at: datetime
-----------------
+ login()
+ logout()
+ changePassword()
```

#### Class: Anggota (extends User)
```
Anggota
-----------------
- nim: string
- nama: string
- jurusan: string
- no_hp: string
- alamat: text
-----------------
+ pinjamBuku()
+ perpanjangPinjaman()
+ lihatRiwayat()
+ lihatDenda()
```

#### Class: Buku
```
Buku
-----------------
- id: int
- isbn: string
- judul: string
- penulis: string
- penerbit: string
- tahun: int
- kategori: string
- stok: int
- lokasi: string
-----------------
+ cekKetersediaan()
+ kurangiStok()
+ tambahStok()
```

#### Class: Peminjaman
```
Peminjaman
-----------------
- id: int
- anggota_id: int
- buku_id: int
- tanggal_pinjam: date
- tanggal_kembali: date
- tanggal_dikembalikan: date
- status: enum (pending, approved, dipinjam, dikembalikan)
- denda: decimal
-----------------
+ approve()
+ perpanjang()
+ kembalikan()
+ hitungDenda()
```

### 7.2 Relasi

- **User** ←(1:1)→ **Anggota** (Inheritance)
- **Anggota** ←(1:N)→ **Peminjaman** (One to Many)
- **Buku** ←(1:N)→ **Peminjaman** (One to Many)

---

## 8. Database Schema

### 8.1 Tabel users
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('anggota', 'pustakawan', 'admin'),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 8.2 Tabel anggotas
```sql
CREATE TABLE anggotas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT,
    nim VARCHAR(20) UNIQUE,
    nama VARCHAR(100),
    jurusan VARCHAR(100),
    no_hp VARCHAR(20),
    alamat TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 8.3 Tabel bukus
```sql
CREATE TABLE bukus (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(20) UNIQUE,
    judul VARCHAR(200),
    penulis VARCHAR(100),
    penerbit VARCHAR(100),
    tahun INT,
    kategori VARCHAR(50),
    stok INT DEFAULT 0,
    lokasi VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 8.4 Tabel peminjamans
```sql
CREATE TABLE peminjamans (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    anggota_id BIGINT,
    buku_id BIGINT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    tanggal_dikembalikan DATE NULL,
    status ENUM('pending', 'approved', 'dipinjam', 'dikembalikan'),
    denda DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (anggota_id) REFERENCES anggotas(id),
    FOREIGN KEY (buku_id) REFERENCES bukus(id)
);
```

---

## 9. UI/UX Design

### 9.1 Halaman Utama

**Wireframe:**
- Header (Logo, Menu, Search, Login)
- Hero Section (Banner, CTA)
- Kategori Buku
- Buku Terpopuler
- Footer

**Mockup:**
- Color: Blue (#2563EB), White (#FFFFFF)
- Font: Inter (Heading), Open Sans (Body)
- Button: Rounded, Shadow

### 9.2 Halaman Katalog

**Wireframe:**
- Sidebar (Filter: Kategori, Tahun, Ketersediaan)
- Content (Grid buku, Pagination)
- Search bar

**Mockup:**
- Card buku: Cover, Judul, Penulis, Status
- Hover effect
- Badge ketersediaan

### 9.3 Halaman Detail Buku

**Wireframe:**
- Cover buku (large)
- Info buku (Judul, Penulis, Penerbit, Tahun, ISBN)
- Sinopsis
- Ketersediaan
- Button "Pinjam"

### 9.4 Dashboard Anggota

**Wireframe:**
- Sidebar (Menu navigasi)
- Content:
  - Statistik (Buku dipinjam, Denda)
  - Buku yang sedang dipinjam
  - Riwayat peminjaman

---

## 10. Business Rules

### 10.1 Peminjaman

1. Anggota maksimal meminjam 3 buku
2. Durasi peminjaman: 7 hari
3. Perpanjangan maksimal 1 kali (7 hari tambahan)
4. Buku harus tersedia (stok > 0)
5. Anggota tidak boleh memiliki denda tertunggak

### 10.2 Pengembalian

1. Keterlambatan dikenakan denda Rp 1.000/hari
2. Denda maksimal Rp 50.000 per buku
3. Buku rusak dikenakan denda sesuai harga buku
4. Buku hilang dikenakan denda 2x harga buku

### 10.3 Anggota

1. Registrasi dengan NIM aktif
2. Verifikasi email
3. Akun dinonaktifkan jika denda > Rp 100.000
4. Akun dihapus jika tidak aktif > 1 tahun

---

## 11. Non-Functional Requirements

### 11.1 Performance
- Response time < 3 detik
- Support 100 concurrent users
- Database query optimization

### 11.2 Security
- Password hashing (bcrypt)
- Session management
- HTTPS
- Input validation
- SQL injection prevention

### 11.3 Usability
- Responsive design (mobile, tablet, desktop)
- User-friendly interface
- Clear error messages
- Help documentation

### 11.4 Reliability
- Uptime 99%
- Daily backup
- Error logging
- Recovery plan

---

## 12. Technology Stack (Rekomendasi)

### Backend
- **Framework:** Laravel 10.x
- **Database:** MySQL 8.0
- **Authentication:** Laravel Sanctum

### Frontend
- **Framework:** Blade Template / Vue.js
- **CSS:** Tailwind CSS / Bootstrap
- **Icons:** Font Awesome

### Tools
- **Version Control:** Git
- **Deployment:** cPanel / VPS
- **Testing:** PHPUnit

---

## 13. Timeline Pengembangan (Estimasi)

| Fase | Durasi | Aktivitas |
|------|--------|-----------|
| Analisis | 1 minggu | Requirement gathering, Use case |
| Desain | 2 minggu | UML, Database design, UI/UX |
| Development | 6 minggu | Coding, Testing |
| Testing | 1 minggu | UAT, Bug fixing |
| Deployment | 1 minggu | Deploy, Training |

**Total:** 11 minggu

---

## 14. Kesimpulan

Sistem Perpustakaan Digital "DigiLib" dirancang untuk:
- ✅ Meningkatkan efisiensi layanan perpustakaan
- ✅ Memudahkan akses informasi buku
- ✅ Mengotomatisasi proses peminjaman
- ✅ Mengurangi antrian dan waktu tunggu
- ✅ Menyediakan laporan real-time

Dengan fitur-fitur yang lengkap dan user-friendly, DigiLib diharapkan dapat meningkatkan minat baca dan kepuasan pengguna perpustakaan.

---

**Catatan:** Ini adalah contoh studi kasus. Anda dapat mengadaptasi atau membuat studi kasus sendiri sesuai dengan tema yang dipilih kelompok Anda.
