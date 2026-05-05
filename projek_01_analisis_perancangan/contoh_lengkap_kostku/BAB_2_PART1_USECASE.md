# BAB 2: DESAIN UML

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

### Relasi Antar Use Case

Sistem KostKu menggunakan beberapa jenis relasi antar use case:

#### 1. Include Relationship

**Include** digunakan ketika suatu use case selalu memerlukan use case lain untuk dieksekusi.

**Contoh dalam sistem:**

- **UC-04 (Bayar Sewa) <<include>> UC-02 (Login)**
  - Penjelasan: Untuk melakukan pembayaran, penghuni harus login terlebih dahulu
  - Alasan: Sistem perlu mengidentifikasi penghuni yang melakukan pembayaran

- **UC-06 (Ajukan Komplain) <<include>> UC-02 (Login)**
  - Penjelasan: Untuk mengajukan komplain, penghuni harus login terlebih dahulu
  - Alasan: Sistem perlu mencatat siapa yang mengajukan komplain

- **UC-11 (Konfirmasi Pembayaran) <<include>> UC-14 (Lihat Dashboard)**
  - Penjelasan: Konfirmasi pembayaran dilakukan melalui dashboard pemilik
  - Alasan: Dashboard menyediakan interface untuk konfirmasi

#### 2. Extend Relationship

**Extend** digunakan ketika suatu use case merupakan ekstensi opsional dari use case lain.

**Contoh dalam sistem:**

- **UC-15 (Kirim Notifikasi) <<extend>> UC-11 (Konfirmasi Pembayaran)**
  - Penjelasan: Setelah konfirmasi pembayaran, sistem dapat mengirim notifikasi (opsional)
  - Alasan: Notifikasi adalah fitur tambahan yang tidak selalu dijalankan

#### 3. Generalization Relationship

**Generalization** digunakan untuk menunjukkan hubungan parent-child antar use case.

**Contoh dalam sistem:**

- **UC-09 (Kelola Kamar)** dapat di-generalisasi menjadi:
  - Tambah Kamar
  - Edit Kamar
  - Hapus Kamar
  - Lihat Kamar

---

### Skenario Use Case Detail

Berikut adalah skenario detail untuk beberapa use case utama:

#### UC-04: Bayar Sewa

**Aktor:** Penghuni  
**Precondition:** Penghuni sudah login dan memiliki tagihan aktif  
**Postcondition:** Pembayaran tercatat dalam sistem dengan status pending

**Main Flow:**
1. Penghuni membuka menu Pembayaran
2. Sistem menampilkan daftar tagihan yang belum dibayar
3. Penghuni memilih tagihan yang akan dibayar
4. Sistem menampilkan detail tagihan dan informasi rekening
5. Penghuni melakukan transfer melalui mobile banking
6. Penghuni upload bukti transfer
7. Penghuni submit pembayaran
8. Sistem menyimpan data pembayaran dengan status "pending"
9. Sistem mengirim notifikasi ke Pemilik Kost
10. Sistem menampilkan pesan konfirmasi kepada Penghuni

**Alternative Flow:**
- 2a. Jika tidak ada tagihan aktif:
  - Sistem menampilkan pesan "Tidak ada tagihan yang perlu dibayar"
  - Use case berakhir

- 6a. Jika file bukti transfer tidak valid:
  - Sistem menampilkan pesan error
  - Kembali ke step 6

**Exception Flow:**
- Jika terjadi error saat upload:
  - Sistem menampilkan pesan error
  - Penghuni dapat mencoba upload ulang

---

#### UC-11: Konfirmasi Pembayaran

**Aktor:** Pemilik Kost  
**Precondition:** Pemilik sudah login dan ada pembayaran pending  
**Postcondition:** Status pembayaran berubah menjadi approved/rejected

**Main Flow:**
1. Pemilik membuka Dashboard
2. Sistem menampilkan notifikasi pembayaran pending
3. Pemilik membuka menu Konfirmasi Pembayaran
4. Sistem menampilkan list pembayaran yang menunggu konfirmasi
5. Pemilik memilih pembayaran yang akan dikonfirmasi
6. Sistem menampilkan detail pembayaran dan bukti transfer
7. Pemilik mengecek rekening bank
8. Pemilik klik tombol "Approve"
9. Sistem update status pembayaran menjadi "approved"
10. Sistem update status tagihan menjadi "paid"
11. Sistem generate kwitansi digital
12. Sistem kirim notifikasi dan kwitansi ke Penghuni
13. Sistem menampilkan pesan sukses

**Alternative Flow:**
- 8a. Jika pembayaran tidak valid:
  - Pemilik klik tombol "Reject"
  - Pemilik input alasan penolakan
  - Sistem update status menjadi "rejected"
  - Sistem kirim notifikasi penolakan ke Penghuni

---

### Kesimpulan Use Case Diagram

Use Case Diagram sistem KostKu menggambarkan 18 use case yang melibatkan 3 aktor utama. Diagram ini memberikan gambaran umum tentang fungsionalitas sistem dan interaksi antar aktor. Use case dirancang untuk memenuhi kebutuhan pengelolaan kost modern yang efisien dan user-friendly.

**Fitur Utama:**
- Self-service untuk penghuni (registrasi, pembayaran, komplain)
- Dashboard dan laporan untuk pemilik kost
- Sistem notifikasi otomatis
- Manajemen user dan konfigurasi untuk admin

---

**Catatan Implementasi:**
- Semua use case yang memerlukan autentikasi harus include UC-02 (Login)
- Validasi input harus dilakukan di setiap use case
- Error handling harus comprehensive
- Logging aktivitas user untuk audit trail
