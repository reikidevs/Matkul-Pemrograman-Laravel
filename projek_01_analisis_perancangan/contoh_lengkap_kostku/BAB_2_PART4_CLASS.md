# BAB 2: DESAIN UML (Lanjutan)

## 2.4 Class Diagram

Class Diagram menggambarkan struktur statis sistem dengan menunjukkan class-class yang ada, atribut dan method yang dimiliki, serta relasi antar class. Diagram ini merupakan blueprint untuk implementasi database dan kode program.

---

### Diagram Class Lengkap

**[Gambar 2.8 Class Diagram - Sistem Manajemen Kost "KostKu"]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/class.puml` dan generate menggunakan PlantUML.

---

### Daftar Class dalam Sistem

Sistem KostKu memiliki 9 (sembilan) class utama:

1. **User** - Base class untuk semua pengguna
2. **Penghuni** - Class untuk penghuni kost
3. **PemilikKost** - Class untuk pemilik kost
4. **Kamar** - Class untuk kamar kost
5. **Penghunian** - Class untuk relasi penghuni-kamar
6. **Tagihan** - Class untuk tagihan pembayaran
7. **Pembayaran** - Class untuk transaksi pembayaran
8. **Komplain** - Class untuk komplain penghuni
9. **Notifikasi** - Class untuk notifikasi sistem

---

### Penjelasan Detail Setiap Class

#### 1. Class User

**Deskripsi:**  
Class User adalah **base class** (parent class) untuk semua pengguna sistem. Class ini menggunakan konsep **inheritance** di mana Penghuni dan PemilikKost merupakan turunan dari User.

**Atribut:**
- `id: int` - Primary key, auto-increment
- `email: string` - Email user (unique)
- `password: string` - Password (hashed dengan bcrypt)
- `role: enum` - Role user: 'penghuni', 'pemilik', 'admin'
- `created_at: datetime` - Waktu pembuatan akun
- `updated_at: datetime` - Waktu update terakhir

**Method:**
- `login(): boolean` - Melakukan autentikasi user
- `logout(): void` - Menghapus session user
- `changePassword(newPassword: string): boolean` - Mengubah password
- `resetPassword(email: string): boolean` - Reset password via email

**Relasi:**
- **Inheritance**: User adalah parent dari Penghuni dan PemilikKost
- **One to Many**: User memiliki banyak Notifikasi

**Catatan:**
- Password harus di-hash sebelum disimpan
- Email harus unique (tidak boleh duplikat)
- Role menentukan hak akses user

---

#### 2. Class Penghuni

**Deskripsi:**  
Class Penghuni merepresentasikan penyewa kamar kost. Class ini merupakan **child class** dari User (inheritance).

**Atribut:**
- `id: int` - Primary key
- `user_id: int` - Foreign key ke tabel users
- `nama: string` - Nama lengkap penghuni
- `nik: string` - Nomor Induk Kependudukan (16 digit)
- `no_hp: string` - Nomor HP penghuni
- `pekerjaan: string` - Pekerjaan penghuni
- `alamat_asal: text` - Alamat asal penghuni
- `kontak_darurat: string` - Nomor kontak darurat
- `foto_ktp: string` - Path file foto KTP
- `status: enum` - Status: 'pending', 'active', 'inactive', 'rejected'

**Method:**
- `register(): boolean` - Mendaftar sebagai penghuni baru
- `updateProfile(): boolean` - Update data profil
- `lihatTagihan(): array` - Melihat daftar tagihan
- `bayarSewa(tagihanId: int): boolean` - Melakukan pembayaran sewa
- `ajukanKomplain(data: array): boolean` - Mengajukan komplain
- `lihatRiwayatPembayaran(): array` - Melihat history pembayaran

**Relasi:**
- **Inheritance**: Penghuni extends User
- **One to Many**: Penghuni memiliki banyak Penghunian
- **One to Many**: Penghuni memiliki banyak Komplain

**Aturan Bisnis:**
- NIK harus 16 digit dan unique
- Status 'pending' menunggu approval dari Pemilik
- Status 'active' dapat mengakses semua fitur
- Status 'inactive' tidak dapat login

---

#### 3. Class PemilikKost

**Deskripsi:**  
Class PemilikKost merepresentasikan pemilik properti kost. Class ini merupakan **child class** dari User (inheritance).

**Atribut:**
- `id: int` - Primary key
- `user_id: int` - Foreign key ke tabel users
- `nama: string` - Nama lengkap pemilik
- `no_hp: string` - Nomor HP pemilik
- `alamat: text` - Alamat pemilik

**Method:**
- `kelolaKamar(): void` - Mengelola data kamar (CRUD)
- `kelolaPenghuni(): void` - Mengelola data penghuni (approve, edit, delete)
- `konfirmasiPembayaran(pembayaranId: int): boolean` - Approve/reject pembayaran
- `lihatLaporan(periode: string): array` - Melihat laporan keuangan
- `kelolaKomplain(komplainId: int): boolean` - Menangani komplain
- `kirimNotifikasi(penghuniId: int, message: string): boolean` - Kirim notifikasi

**Relasi:**
- **Inheritance**: PemilikKost extends User
- **One to Many**: PemilikKost approve banyak Pembayaran
- **One to Many**: PemilikKost menangani banyak Komplain

**Aturan Bisnis:**
- Satu sistem hanya memiliki satu PemilikKost
- PemilikKost memiliki akses penuh ke semua data
- PemilikKost dapat melihat statistik dan laporan

---

#### 4. Class Kamar

**Deskripsi:**  
Class Kamar merepresentasikan kamar kost yang tersedia untuk disewa.

**Atribut:**
- `id: int` - Primary key
- `nomor_kamar: string` - Nomor kamar (contoh: "201", "A-12")
- `tipe: enum` - Tipe kamar: 'standard', 'deluxe', 'vip'
- `luas: decimal` - Luas kamar dalam m² (contoh: 3.5)
- `harga_sewa: decimal` - Harga sewa per bulan
- `fasilitas: text` - Deskripsi fasilitas (JSON atau text)
- `lantai: int` - Lantai kamar (1, 2, 3, dst)
- `status: enum` - Status: 'available', 'occupied', 'maintenance'
- `foto: string` - Path file foto kamar

**Method:**
- `cekKetersediaan(): boolean` - Mengecek apakah kamar tersedia
- `updateStatus(status: string): void` - Update status kamar
- `getFasilitas(): array` - Mendapatkan list fasilitas
- `getHargaSewa(): decimal` - Mendapatkan harga sewa

**Relasi:**
- **One to Many**: Kamar dapat ditempati oleh banyak Penghunian (dalam periode berbeda)

**Aturan Bisnis:**
- Nomor kamar harus unique
- Status 'available' dapat disewa
- Status 'occupied' sedang ditempati
- Status 'maintenance' tidak dapat disewa
- Harga sewa dapat berbeda per tipe kamar

**Contoh Fasilitas:**
```json
{
  "kasur": "Single Bed",
  "lemari": "2 Pintu",
  "ac": "1 PK",
  "kamar_mandi": "Dalam",
  "wifi": true,
  "tv": "32 inch"
}
```

---

#### 5. Class Penghunian

**Deskripsi:**  
Class Penghunian merepresentasikan **hubungan antara Penghuni dan Kamar** dalam periode tertentu. Class ini merupakan **association class** yang menghubungkan Penghuni dan Kamar.

**Atribut:**
- `id: int` - Primary key
- `penghuni_id: int` - Foreign key ke tabel penghuni
- `kamar_id: int` - Foreign key ke tabel kamar
- `tanggal_masuk: date` - Tanggal mulai sewa
- `tanggal_keluar: date` - Tanggal akhir sewa (nullable)
- `durasi_kontrak: int` - Durasi kontrak dalam bulan
- `status: enum` - Status: 'active', 'expired', 'terminated'

**Method:**
- `perpanjangKontrak(bulan: int): boolean` - Perpanjang kontrak sewa
- `akhiriKontrak(): void` - Mengakhiri kontrak (checkout)
- `hitungDurasi(): int` - Menghitung durasi sewa (dalam bulan)
- `cekStatusAktif(): boolean` - Mengecek apakah kontrak masih aktif

**Relasi:**
- **Many to One**: Banyak Penghunian dimiliki oleh satu Penghuni
- **Many to One**: Banyak Penghunian terkait dengan satu Kamar
- **One to Many**: Penghunian menghasilkan banyak Tagihan

**Aturan Bisnis:**
- Satu penghuni dapat memiliki multiple penghunian (jika pindah kamar)
- Satu kamar dapat memiliki multiple penghunian (dalam periode berbeda)
- Satu penghuni hanya dapat memiliki 1 penghunian aktif
- Tagihan dibuat otomatis setiap bulan berdasarkan penghunian aktif

**Contoh Skenario:**
- Ahmad sewa Kamar 201 dari 1 Jan 2024 - 31 Des 2024 (durasi 12 bulan)
- Setiap tanggal 1, sistem generate tagihan untuk Ahmad
- Jika Ahmad pindah ke Kamar 202, penghunian lama di-terminate, buat penghunian baru

---

#### 6. Class Tagihan

**Deskripsi:**  
Class Tagihan merepresentasikan tagihan pembayaran sewa yang harus dibayar oleh penghuni setiap bulan.

**Atribut:**
- `id: int` - Primary key
- `penghunian_id: int` - Foreign key ke tabel penghunian
- `periode: string` - Periode tagihan (contoh: "Januari 2024")
- `jumlah: decimal` - Jumlah tagihan (sama dengan harga sewa kamar)
- `tanggal_jatuh_tempo: date` - Tanggal jatuh tempo pembayaran
- `denda: decimal` - Denda keterlambatan (default: 0)
- `status: enum` - Status: 'unpaid', 'pending_confirmation', 'paid', 'overdue'
- `created_at: datetime` - Waktu pembuatan tagihan

**Method:**
- `generate(penghunianId: int): boolean` - Generate tagihan baru
- `hitungDenda(): decimal` - Menghitung denda keterlambatan
- `updateStatus(status: string): void` - Update status tagihan
- `getTotal(): decimal` - Mendapatkan total (jumlah + denda)

**Relasi:**
- **Many to One**: Banyak Tagihan dimiliki oleh satu Penghunian
- **One to One**: Tagihan dibayar melalui satu Pembayaran

**Aturan Bisnis:**
- Tagihan dibuat otomatis setiap tanggal 1 bulan berjalan
- Jatuh tempo: tanggal 10 setiap bulan
- Denda: Rp 50.000 per hari setelah jatuh tempo
- Status 'unpaid': Belum dibayar
- Status 'pending_confirmation': Sudah submit pembayaran, menunggu konfirmasi
- Status 'paid': Sudah dikonfirmasi dan lunas
- Status 'overdue': Lewat jatuh tempo

**Contoh Perhitungan Denda:**
```
Harga Sewa: Rp 1.500.000
Jatuh Tempo: 10 Januari 2024
Tanggal Bayar: 15 Januari 2024
Keterlambatan: 5 hari
Denda: 5 x Rp 50.000 = Rp 250.000
Total: Rp 1.500.000 + Rp 250.000 = Rp 1.750.000
```

---

#### 7. Class Pembayaran

**Deskripsi:**  
Class Pembayaran merepresentasikan transaksi pembayaran yang dilakukan oleh penghuni untuk melunasi tagihan.

**Atribut:**
- `id: int` - Primary key
- `tagihan_id: int` - Foreign key ke tabel tagihan
- `tanggal_bayar: datetime` - Waktu submit pembayaran
- `jumlah_bayar: decimal` - Jumlah yang dibayarkan
- `metode_pembayaran: enum` - Metode: 'transfer_bank', 'cash', 'e_wallet'
- `bukti_transfer: string` - Path file bukti transfer
- `status: enum` - Status: 'pending', 'approved', 'rejected'
- `approved_by: int` - Foreign key ke tabel pemilik_kost (nullable)
- `approved_at: datetime` - Waktu approval (nullable)

**Method:**
- `submit(data: array): boolean` - Submit pembayaran baru
- `approve(): boolean` - Approve pembayaran (oleh Pemilik)
- `reject(alasan: string): boolean` - Reject pembayaran dengan alasan
- `generateKwitansi(): string` - Generate kwitansi PDF

**Relasi:**
- **One to One**: Pembayaran melunasi satu Tagihan
- **Many to One**: Banyak Pembayaran di-approve oleh satu PemilikKost

**Aturan Bisnis:**
- Satu tagihan hanya dapat memiliki satu pembayaran yang approved
- Jika pembayaran di-reject, penghuni dapat submit ulang
- Kwitansi hanya di-generate setelah pembayaran approved
- Bukti transfer wajib di-upload

**Status Flow:**
```
pending → approved → (generate kwitansi)
        ↓
      rejected → (penghuni submit ulang)
```

---

#### 8. Class Komplain

**Deskripsi:**  
Class Komplain merepresentasikan komplain atau keluhan yang diajukan oleh penghuni terkait fasilitas atau layanan kost.

**Atribut:**
- `id: int` - Primary key
- `penghuni_id: int` - Foreign key ke tabel penghuni
- `kategori: enum` - Kategori: 'fasilitas', 'kebersihan', 'keamanan', 'lainnya'
- `judul: string` - Judul komplain (ringkasan)
- `deskripsi: text` - Deskripsi detail masalah
- `foto: string` - Path file foto bukti (nullable)
- `prioritas: enum` - Prioritas: 'low', 'medium', 'high', 'urgent'
- `status: enum` - Status: 'open', 'in_progress', 'resolved', 'closed', 'reopened'
- `assigned_to: int` - Foreign key ke pemilik_kost (nullable)
- `created_at: datetime` - Waktu pengajuan komplain
- `resolved_at: datetime` - Waktu penyelesaian (nullable)

**Method:**
- `submit(): boolean` - Submit komplain baru
- `updateStatus(status: string): void` - Update status komplain
- `assign(staffId: int): void` - Assign komplain ke staff
- `resolve(catatan: string): boolean` - Menyelesaikan komplain
- `reopen(): boolean` - Membuka kembali komplain
- `addRating(rating: int): void` - Menambahkan rating (1-5)

**Relasi:**
- **Many to One**: Banyak Komplain diajukan oleh satu Penghuni
- **Many to One**: Banyak Komplain ditangani oleh satu PemilikKost

**Aturan Bisnis:**
- Prioritas 'urgent' harus ditangani dalam 2 jam
- Prioritas 'high' harus ditangani dalam 24 jam
- Prioritas 'medium' harus ditangani dalam 3 hari
- Prioritas 'low' harus ditangani dalam 7 hari
- Penghuni dapat membuka kembali komplain jika tidak puas
- Rating wajib diberikan sebelum close komplain

**Status Flow:**
```
open → in_progress → resolved → closed
                              ↓
                          reopened → in_progress
```

---

#### 9. Class Notifikasi

**Deskripsi:**  
Class Notifikasi merepresentasikan notifikasi yang dikirim sistem kepada user (penghuni atau pemilik).

**Atribut:**
- `id: int` - Primary key
- `user_id: int` - Foreign key ke tabel users
- `judul: string` - Judul notifikasi
- `pesan: text` - Isi pesan notifikasi
- `tipe: enum` - Tipe: 'info', 'warning', 'success', 'error'
- `is_read: boolean` - Status baca (default: false)
- `created_at: datetime` - Waktu notifikasi dibuat

**Method:**
- `send(): boolean` - Mengirim notifikasi
- `markAsRead(): void` - Menandai notifikasi sudah dibaca
- `delete(): void` - Menghapus notifikasi

**Relasi:**
- **Many to One**: Banyak Notifikasi diterima oleh satu User

**Aturan Bisnis:**
- Notifikasi otomatis dibuat saat ada event penting
- Notifikasi dapat dikirim via in-app, email, dan push notification
- Notifikasi yang sudah dibaca tetap tersimpan (untuk history)
- Notifikasi otomatis dihapus setelah 30 hari

**Contoh Event yang Trigger Notifikasi:**
- Pembayaran baru (ke Pemilik)
- Pembayaran approved (ke Penghuni)
- Komplain baru (ke Pemilik)
- Komplain resolved (ke Penghuni)
- Tagihan baru (ke Penghuni)
- Reminder jatuh tempo (ke Penghuni)

---

### Relasi Antar Class

#### 1. Inheritance (Generalization)

**User ← Penghuni**  
**User ← PemilikKost**

- Penghuni dan PemilikKost mewarisi atribut dan method dari User
- Penghuni dan PemilikKost memiliki atribut dan method tambahan
- Menggunakan konsep OOP: inheritance/pewarisan

**Implementasi Database:**
- Bisa menggunakan **Single Table Inheritance**: Satu tabel users dengan kolom 'role'
- Bisa menggunakan **Class Table Inheritance**: Tabel users + tabel penghuni + tabel pemilik_kost

---

#### 2. One to Many (1:N)

**Penghuni (1) → Penghunian (N)**
- Satu penghuni dapat memiliki banyak penghunian (jika pindah kamar)
- Foreign key: `penghunian.penghuni_id` references `penghuni.id`

**Kamar (1) → Penghunian (N)**
- Satu kamar dapat ditempati banyak kali (dalam periode berbeda)
- Foreign key: `penghunian.kamar_id` references `kamar.id`

**Penghunian (1) → Tagihan (N)**
- Satu penghunian menghasilkan banyak tagihan (setiap bulan)
- Foreign key: `tagihan.penghunian_id` references `penghunian.id`

**Penghuni (1) → Komplain (N)**
- Satu penghuni dapat mengajukan banyak komplain
- Foreign key: `komplain.penghuni_id` references `penghuni.id`

**User (1) → Notifikasi (N)**
- Satu user dapat menerima banyak notifikasi
- Foreign key: `notifikasi.user_id` references `users.id`

**PemilikKost (1) → Pembayaran (N)**
- Satu pemilik dapat approve banyak pembayaran
- Foreign key: `pembayaran.approved_by` references `pemilik_kost.id`

**PemilikKost (1) → Komplain (N)**
- Satu pemilik dapat menangani banyak komplain
- Foreign key: `komplain.assigned_to` references `pemilik_kost.id`

---

#### 3. One to One (1:1)

**Tagihan (1) → Pembayaran (1)**
- Satu tagihan dibayar melalui satu pembayaran
- Foreign key: `pembayaran.tagihan_id` references `tagihan.id`
- Constraint: UNIQUE pada `pembayaran.tagihan_id` (untuk pembayaran yang approved)

---

### Mapping ke Database Schema

Berikut adalah mapping class diagram ke database schema:

#### Tabel: users
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('penghuni', 'pemilik', 'admin') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Tabel: penghuni
```sql
CREATE TABLE penghuni (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  nama VARCHAR(255) NOT NULL,
  nik VARCHAR(16) UNIQUE NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  pekerjaan VARCHAR(100),
  alamat_asal TEXT,
  kontak_darurat VARCHAR(20),
  foto_ktp VARCHAR(255),
  status ENUM('pending', 'active', 'inactive', 'rejected') DEFAULT 'pending',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### Tabel: pemilik_kost
```sql
CREATE TABLE pemilik_kost (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  nama VARCHAR(255) NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  alamat TEXT,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

#### Tabel: kamar
```sql
CREATE TABLE kamar (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nomor_kamar VARCHAR(50) UNIQUE NOT NULL,
  tipe ENUM('standard', 'deluxe', 'vip') NOT NULL,
  luas DECIMAL(5,2),
  harga_sewa DECIMAL(10,2) NOT NULL,
  fasilitas TEXT,
  lantai INT,
  status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
  foto VARCHAR(255)
);
```

#### Tabel: penghunian
```sql
CREATE TABLE penghunian (
  id INT PRIMARY KEY AUTO_INCREMENT,
  penghuni_id INT NOT NULL,
  kamar_id INT NOT NULL,
  tanggal_masuk DATE NOT NULL,
  tanggal_keluar DATE,
  durasi_kontrak INT NOT NULL,
  status ENUM('active', 'expired', 'terminated') DEFAULT 'active',
  FOREIGN KEY (penghuni_id) REFERENCES penghuni(id) ON DELETE CASCADE,
  FOREIGN KEY (kamar_id) REFERENCES kamar(id) ON DELETE CASCADE
);
```

#### Tabel: tagihan
```sql
CREATE TABLE tagihan (
  id INT PRIMARY KEY AUTO_INCREMENT,
  penghunian_id INT NOT NULL,
  periode VARCHAR(50) NOT NULL,
  jumlah DECIMAL(10,2) NOT NULL,
  tanggal_jatuh_tempo DATE NOT NULL,
  denda DECIMAL(10,2) DEFAULT 0,
  status ENUM('unpaid', 'pending_confirmation', 'paid', 'overdue') DEFAULT 'unpaid',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (penghunian_id) REFERENCES penghunian(id) ON DELETE CASCADE
);
```

#### Tabel: pembayaran
```sql
CREATE TABLE pembayaran (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tagihan_id INT NOT NULL,
  tanggal_bayar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  jumlah_bayar DECIMAL(10,2) NOT NULL,
  metode_pembayaran ENUM('transfer_bank', 'cash', 'e_wallet') NOT NULL,
  bukti_transfer VARCHAR(255),
  status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  approved_by INT,
  approved_at TIMESTAMP NULL,
  FOREIGN KEY (tagihan_id) REFERENCES tagihan(id) ON DELETE CASCADE,
  FOREIGN KEY (approved_by) REFERENCES pemilik_kost(id) ON DELETE SET NULL
);
```

#### Tabel: komplain
```sql
CREATE TABLE komplain (
  id INT PRIMARY KEY AUTO_INCREMENT,
  penghuni_id INT NOT NULL,
  kategori ENUM('fasilitas', 'kebersihan', 'keamanan', 'lainnya') NOT NULL,
  judul VARCHAR(255) NOT NULL,
  deskripsi TEXT NOT NULL,
  foto VARCHAR(255),
  prioritas ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
  status ENUM('open', 'in_progress', 'resolved', 'closed', 'reopened') DEFAULT 'open',
  assigned_to INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  resolved_at TIMESTAMP NULL,
  FOREIGN KEY (penghuni_id) REFERENCES penghuni(id) ON DELETE CASCADE,
  FOREIGN KEY (assigned_to) REFERENCES pemilik_kost(id) ON DELETE SET NULL
);
```

#### Tabel: notifikasi
```sql
CREATE TABLE notifikasi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  judul VARCHAR(255) NOT NULL,
  pesan TEXT NOT NULL,
  tipe ENUM('info', 'warning', 'success', 'error') DEFAULT 'info',
  is_read BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

### Kesimpulan Class Diagram

Class Diagram sistem KostKu menggambarkan struktur data yang lengkap dan terorganisir dengan baik:

**Karakteristik Utama:**
- Menggunakan inheritance untuk User, Penghuni, dan PemilikKost
- Menggunakan association class (Penghunian) untuk relasi many-to-many
- Relasi yang jelas antar class dengan foreign key
- Atribut dan method yang sesuai dengan kebutuhan bisnis

**Manfaat untuk Implementasi:**
- Blueprint untuk membuat database schema
- Panduan untuk membuat class dalam kode (OOP)
- Dokumentasi struktur data yang jelas
- Memudahkan maintenance dan pengembangan

**Best Practices yang Diterapkan:**
- Normalisasi database (menghindari redundansi)
- Penggunaan enum untuk data yang terbatas
- Penggunaan timestamp untuk audit trail
- Penggunaan foreign key untuk integritas data
- Penggunaan ON DELETE CASCADE untuk data consistency

---

**Catatan Implementasi:**
- Gunakan ORM (Eloquent di Laravel) untuk mapping class ke database
- Implement validation di level model
- Gunakan accessor dan mutator untuk data transformation
- Implement soft delete untuk data penting (tidak benar-benar dihapus)
- Buat index pada foreign key untuk improve query performance
