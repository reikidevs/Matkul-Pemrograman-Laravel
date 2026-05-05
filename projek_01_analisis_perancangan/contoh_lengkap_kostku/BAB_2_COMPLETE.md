# BAB 2: DESAIN UML

## Pendahuluan

BAB 2 ini membahas desain sistem KostKu menggunakan UML (Unified Modeling Language). UML adalah bahasa pemodelan standar yang digunakan untuk visualisasi, spesifikasi, konstruksi, dan dokumentasi sistem perangkat lunak.

Dalam BAB ini, kami menyajikan 4 (empat) jenis diagram UML yang merepresentasikan berbagai aspek sistem:

1. **Use Case Diagram** - Menggambarkan interaksi aktor dengan sistem
2. **Activity Diagram** - Menggambarkan alur proses bisnis
3. **Sequence Diagram** - Menggambarkan interaksi antar objek berdasarkan waktu
4. **Class Diagram** - Menggambarkan struktur statis sistem

---

## 2.1 Use Case Diagram

Use Case Diagram menggambarkan interaksi antara aktor (pengguna) dengan sistem KostKu. Diagram ini menunjukkan fungsi-fungsi yang dapat dilakukan oleh setiap aktor dalam sistem manajemen kost.

### Diagram Use Case

**[Gambar 2.1 Use Case Diagram - Sistem KostKu]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/usecase.puml` dan generate menggunakan PlantUML.
> Online: https://www.plantuml.com/plantuml/uml/

---

### Penjelasan Aktor

Sistem KostKu memiliki 3 (tiga) aktor utama yang berinteraksi dengan sistem:

#### 1. Penghuni

**Deskripsi:** Penghuni adalah penyewa kamar kost yang menggunakan sistem untuk melakukan berbagai aktivitas terkait penyewaan kamar.

**Karakteristik:**
- Merupakan user dengan role "penghuni"
- Memiliki akses terbatas sesuai kebutuhan penyewa
- Dapat melakukan self-service untuk pembayaran dan komplain

**Use Case yang Dapat Diakses:**
- **UC-01 Registrasi**: Mendaftar akun baru dengan mengisi data diri dan memilih kamar
- **UC-02 Login**: Masuk ke sistem menggunakan email dan password
- **UC-03 Lihat Info Kamar**: Melihat informasi detail kamar yang ditempati (fasilitas, harga, dll)
- **UC-04 Bayar Sewa**: Melakukan pembayaran sewa bulanan secara online
- **UC-05 Lihat Riwayat Pembayaran**: Melihat history pembayaran yang pernah dilakukan
- **UC-06 Ajukan Komplain**: Mengajukan komplain terkait fasilitas atau layanan kost
- **UC-07 Lihat Status Komplain**: Melihat status dan progress penanganan komplain
- **UC-08 Update Profile**: Mengubah data profil seperti nomor HP, foto, dll

#### 2. Pemilik Kost

**Deskripsi:** Pemilik Kost adalah pengelola properti kost yang bertanggung jawab atas operasional dan manajemen kost.

**Karakteristik:**
- Merupakan user dengan role "pemilik"
- Memiliki akses penuh untuk mengelola kost
- Dapat memonitor dan mengontrol semua aktivitas

**Use Case yang Dapat Diakses:**
- **UC-02 Login**: Masuk ke sistem menggunakan email dan password
- **UC-09 Kelola Kamar**: Menambah, mengubah, menghapus, dan melihat data kamar
- **UC-10 Kelola Penghuni**: Mengelola data penghuni (approve registrasi, update data, nonaktifkan)
- **UC-11 Konfirmasi Pembayaran**: Menyetujui atau menolak pembayaran yang disubmit penghuni
- **UC-12 Lihat Laporan Keuangan**: Melihat laporan pendapatan, tunggakan, dan statistik keuangan
- **UC-13 Kelola Komplain**: Menangani komplain dari penghuni (assign, update status, resolve)
- **UC-14 Lihat Dashboard**: Melihat dashboard dengan statistik dan ringkasan operasional
- **UC-15 Kirim Notifikasi**: Mengirim notifikasi atau pengumuman kepada penghuni

#### 3. Admin

**Deskripsi:** Admin adalah administrator sistem yang bertanggung jawab atas konfigurasi dan maintenance sistem.

**Karakteristik:**
- Merupakan user dengan role "admin"
- Memiliki akses tertinggi dalam sistem
- Fokus pada aspek teknis dan konfigurasi sistem

**Use Case yang Dapat Diakses:**
- **UC-02 Login**: Masuk ke sistem menggunakan email dan password
- **UC-16 Kelola User**: Mengelola semua user (penghuni, pemilik, admin)
- **UC-17 Konfigurasi Sistem**: Mengatur parameter sistem (harga denda, durasi kontrak, dll)
- **UC-18 Backup Data**: Melakukan backup dan restore database

---

### Daftar Use Case Lengkap

Berikut adalah daftar lengkap use case dalam sistem KostKu beserta deskripsi dan aktor yang terlibat:

| ID | Use Case | Deskripsi | Aktor | Prioritas |
|----|----------|-----------|-------|-----------|
| UC-01 | Registrasi | Penghuni mendaftar akun baru dengan mengisi form registrasi dan memilih kamar yang diinginkan | Penghuni | High |
| UC-02 | Login | User melakukan autentikasi untuk masuk ke sistem menggunakan email dan password | Semua Aktor | High |
| UC-03 | Lihat Info Kamar | Penghuni melihat informasi detail kamar yang ditempati termasuk fasilitas dan harga | Penghuni | Medium |
| UC-04 | Bayar Sewa | Penghuni melakukan pembayaran sewa bulanan dengan upload bukti transfer | Penghuni | High |
| UC-05 | Lihat Riwayat Pembayaran | Penghuni melihat history pembayaran yang pernah dilakukan beserta status | Penghuni | Medium |
| UC-06 | Ajukan Komplain | Penghuni mengajukan komplain terkait fasilitas, kebersihan, atau layanan kost | Penghuni | High |
| UC-07 | Lihat Status Komplain | Penghuni melihat status dan progress penanganan komplain yang diajukan | Penghuni | Medium |
| UC-08 | Update Profile | Penghuni mengubah data profil seperti nomor HP, alamat, foto, dll | Penghuni | Low |
| UC-09 | Kelola Kamar | Pemilik mengelola data kamar (tambah, edit, hapus, lihat) | Pemilik Kost | High |
| UC-10 | Kelola Penghuni | Pemilik mengelola data penghuni (approve, edit, nonaktifkan) | Pemilik Kost | High |
| UC-11 | Konfirmasi Pembayaran | Pemilik menyetujui atau menolak pembayaran yang disubmit oleh penghuni | Pemilik Kost | High |
| UC-12 | Lihat Laporan Keuangan | Pemilik melihat laporan pendapatan, tunggakan, dan statistik keuangan | Pemilik Kost | Medium |
| UC-13 | Kelola Komplain | Pemilik menangani komplain (assign ke staff, update status, resolve) | Pemilik Kost | High |
| UC-14 | Lihat Dashboard | Pemilik melihat dashboard dengan statistik occupancy, pendapatan, dll | Pemilik Kost | Medium |
| UC-15 | Kirim Notifikasi | Pemilik mengirim notifikasi atau pengumuman kepada penghuni | Pemilik Kost | Low |
| UC-16 | Kelola User | Admin mengelola semua user dalam sistem (CRUD) | Admin | Medium |
| UC-17 | Konfigurasi Sistem | Admin mengatur parameter sistem seperti harga denda, durasi kontrak | Admin | Low |
| UC-18 | Backup Data | Admin melakukan backup dan restore database | Admin | Medium |

---

### Kesimpulan Use Case Diagram

Use Case Diagram sistem KostKu menggambarkan 18 use case yang melibatkan 3 aktor utama. Diagram ini memberikan gambaran umum tentang fungsionalitas sistem dan interaksi antar aktor.

---

## 2.2 Activity Diagram

Activity Diagram menggambarkan alur aktivitas atau proses bisnis dalam sistem. Diagram ini menunjukkan urutan aktivitas dari awal hingga akhir, termasuk decision point, parallel processing, dan swimlane.

Sistem KostKu memiliki 3 (tiga) Activity Diagram utama:

### 2.2.1 Activity Diagram - Proses Pendaftaran Penghuni Baru

**[Gambar 2.2 Activity Diagram - Proses Pendaftaran Penghuni Baru]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_pendaftaran.puml`

Proses pendaftaran melibatkan:
- Penghuni mengisi form registrasi
- Sistem validasi data
- Pemilik Kost melakukan approval
- Sistem generate akun dan invoice

**Elemen Penting:**
- Fork dan Join untuk parallel processing
- Decision point untuk validasi dan approval
- Notifikasi otomatis ke Pemilik dan Penghuni

---

### 2.2.2 Activity Diagram - Proses Pembayaran Sewa Kost

**[Gambar 2.3 Activity Diagram - Proses Pembayaran Sewa Kost]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_pembayaran.puml`

Proses pembayaran menggunakan swimlane untuk 3 aktor:
- **Penghuni**: Login, pilih tagihan, upload bukti transfer
- **Sistem**: Simpan data, kirim notifikasi
- **Pemilik Kost**: Verifikasi, approve/reject pembayaran

**Elemen Penting:**
- Swimlane untuk memisahkan tanggung jawab
- Decision point untuk validasi pembayaran
- Fork untuk parallel processing (notifikasi + update laporan)

---

### 2.2.3 Activity Diagram - Proses Pengajuan dan Penanganan Komplain

**[Gambar 2.4 Activity Diagram - Proses Komplain]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_komplain.puml`

Proses komplain dengan feedback loop:
- Penghuni ajukan komplain
- Pemilik tangani dan resolve
- Penghuni verifikasi hasil
- Jika tidak puas, komplain dapat dibuka kembali

**Elemen Penting:**
- Swimlane untuk 3 aktor
- Decision point untuk prioritas dan kepuasan
- Loop untuk komplain yang dibuka kembali

---

## 2.3 Sequence Diagram

Sequence Diagram menggambarkan interaksi antar objek dalam sistem berdasarkan urutan waktu. Diagram ini menunjukkan message passing untuk menyelesaikan suatu fungsi.

Sistem KostKu memiliki 3 (tiga) Sequence Diagram utama:

### 2.3.1 Sequence Diagram - Skenario Login Penghuni

**[Gambar 2.5 Sequence Diagram - Skenario Login Penghuni]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_login.puml`

Objek yang terlibat:
- Penghuni (aktor)
- LoginPage
- AuthController
- User (model)
- Database
- Session

**Alur Interaksi:**
1. Penghuni input email dan password
2. AuthController validasi input
3. User query database untuk cek email
4. AuthController verifikasi password
5. Session generate token
6. Redirect ke Dashboard

**Elemen Penting:**
- Alternative flow untuk error handling
- Self-call untuk internal method
- Activation bar menunjukkan objek aktif

---

### 2.3.2 Sequence Diagram - Skenario Penghuni Bayar Sewa

**[Gambar 2.6 Sequence Diagram - Skenario Penghuni Bayar Sewa]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_bayar.puml`

Objek yang terlibat:
- Penghuni (aktor)
- PembayaranPage
- PembayaranController
- Tagihan (model)
- Pembayaran (model)
- Database
- NotificationService

**Alur Interaksi:**
1. Ambil data tagihan aktif
2. Penghuni pilih tagihan dan upload bukti
3. Controller validasi file
4. Pembayaran insert data ke database
5. Update status tagihan
6. NotificationService kirim notifikasi ke Pemilik

---

### 2.3.3 Sequence Diagram - Skenario Pemilik Approve Pembayaran

**[Gambar 2.7 Sequence Diagram - Skenario Pemilik Approve Pembayaran]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_approve.puml`

Objek yang terlibat:
- Pemilik Kost (aktor)
- DashboardPage
- PembayaranController
- Pembayaran (model)
- Tagihan (model)
- Kwitansi (model)
- Database
- NotificationService

**Alur Interaksi:**
1. Ambil list pembayaran pending
2. Pemilik lihat detail dan verifikasi
3. Pemilik approve pembayaran
4. Update status pembayaran dan tagihan
5. Generate kwitansi PDF
6. Kirim notifikasi dan kwitansi ke Penghuni

---

## 2.4 Class Diagram

Class Diagram menggambarkan struktur statis sistem dengan menunjukkan class-class yang ada, atribut dan method yang dimiliki, serta relasi antar class.

### Diagram Class Lengkap

**[Gambar 2.8 Class Diagram - Sistem Manajemen Kost "KostKu"]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/class.puml`

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

### Ringkasan Class

#### 1. Class User (Base Class)

**Atribut:**
- id, email, password, role, created_at, updated_at

**Method:**
- login(), logout(), changePassword(), resetPassword()

**Relasi:**
- Parent dari Penghuni dan PemilikKost (inheritance)
- One to Many dengan Notifikasi

---

#### 2. Class Penghuni (extends User)

**Atribut:**
- id, user_id, nama, nik, no_hp, pekerjaan, alamat_asal, kontak_darurat, foto_ktp, status

**Method:**
- register(), updateProfile(), lihatTagihan(), bayarSewa(), ajukanKomplain(), lihatRiwayatPembayaran()

**Relasi:**
- Child dari User (inheritance)
- One to Many dengan Penghunian
- One to Many dengan Komplain

---

#### 3. Class PemilikKost (extends User)

**Atribut:**
- id, user_id, nama, no_hp, alamat

**Method:**
- kelolaKamar(), kelolaPenghuni(), konfirmasiPembayaran(), lihatLaporan(), kelolaKomplain(), kirimNotifikasi()

**Relasi:**
- Child dari User (inheritance)
- One to Many dengan Pembayaran (approve)
- One to Many dengan Komplain (handle)

---

#### 4. Class Kamar

**Atribut:**
- id, nomor_kamar, tipe, luas, harga_sewa, fasilitas, lantai, status, foto

**Method:**
- cekKetersediaan(), updateStatus(), getFasilitas(), getHargaSewa()

**Relasi:**
- One to Many dengan Penghunian

---

#### 5. Class Penghunian (Association Class)

**Atribut:**
- id, penghuni_id, kamar_id, tanggal_masuk, tanggal_keluar, durasi_kontrak, status

**Method:**
- perpanjangKontrak(), akhiriKontrak(), hitungDurasi(), cekStatusAktif()

**Relasi:**
- Many to One dengan Penghuni
- Many to One dengan Kamar
- One to Many dengan Tagihan

---

#### 6. Class Tagihan

**Atribut:**
- id, penghunian_id, periode, jumlah, tanggal_jatuh_tempo, denda, status, created_at

**Method:**
- generate(), hitungDenda(), updateStatus(), getTotal()

**Relasi:**
- Many to One dengan Penghunian
- One to One dengan Pembayaran

---

#### 7. Class Pembayaran

**Atribut:**
- id, tagihan_id, tanggal_bayar, jumlah_bayar, metode_pembayaran, bukti_transfer, status, approved_by, approved_at

**Method:**
- submit(), approve(), reject(), generateKwitansi()

**Relasi:**
- One to One dengan Tagihan
- Many to One dengan PemilikKost (approve)

---

#### 8. Class Komplain

**Atribut:**
- id, penghuni_id, kategori, judul, deskripsi, foto, prioritas, status, assigned_to, created_at, resolved_at

**Method:**
- submit(), updateStatus(), assign(), resolve(), reopen(), addRating()

**Relasi:**
- Many to One dengan Penghuni
- Many to One dengan PemilikKost (handle)

---

#### 9. Class Notifikasi

**Atribut:**
- id, user_id, judul, pesan, tipe, is_read, created_at

**Method:**
- send(), markAsRead(), delete()

**Relasi:**
- Many to One dengan User

---

### Relasi Antar Class

**Inheritance:**
- User ← Penghuni
- User ← PemilikKost

**One to Many:**
- Penghuni (1) → Penghunian (N)
- Kamar (1) → Penghunian (N)
- Penghunian (1) → Tagihan (N)
- Penghuni (1) → Komplain (N)
- User (1) → Notifikasi (N)
- PemilikKost (1) → Pembayaran (N)
- PemilikKost (1) → Komplain (N)

**One to One:**
- Tagihan (1) → Pembayaran (1)

---

## Kesimpulan BAB 2

BAB 2 ini telah menyajikan desain sistem KostKu menggunakan 4 jenis diagram UML:

1. **Use Case Diagram**: Menggambarkan 18 use case dengan 3 aktor
2. **Activity Diagram**: Menggambarkan 3 proses bisnis utama dengan swimlane dan decision point
3. **Sequence Diagram**: Menggambarkan 3 skenario interaksi dengan message passing detail
4. **Class Diagram**: Menggambarkan 9 class dengan relasi lengkap

**Manfaat Desain UML:**
- Dokumentasi sistem yang jelas dan terstruktur
- Blueprint untuk implementasi (coding dan database)
- Komunikasi yang efektif antar stakeholder
- Memudahkan maintenance dan pengembangan

**Karakteristik Desain:**
- Menggunakan best practices OOP (inheritance, encapsulation)
- Relasi yang jelas dan terstruktur
- Proses bisnis yang lengkap dan detail
- Error handling yang comprehensive

---

**Catatan untuk Implementasi:**
- Gunakan framework Laravel untuk implementasi
- Gunakan Eloquent ORM untuk mapping class ke database
- Implement validation di setiap layer
- Gunakan service layer untuk business logic
- Implement queue untuk asynchronous processing
- Gunakan caching untuk improve performance

---

**File Diagram:**
- `diagrams/usecase.puml` - Use Case Diagram
- `diagrams/activity_pendaftaran.puml` - Activity Diagram Pendaftaran
- `diagrams/activity_pembayaran.puml` - Activity Diagram Pembayaran
- `diagrams/activity_komplain.puml` - Activity Diagram Komplain
- `diagrams/sequence_login.puml` - Sequence Diagram Login
- `diagrams/sequence_bayar.puml` - Sequence Diagram Bayar Sewa
- `diagrams/sequence_approve.puml` - Sequence Diagram Approve
- `diagrams/class.puml` - Class Diagram

---

**Lanjut ke BAB 3: UI/UX Design**
