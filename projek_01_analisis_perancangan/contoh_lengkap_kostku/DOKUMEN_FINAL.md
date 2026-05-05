# DOKUMEN FINAL: ANALISIS DAN PERANCANGAN SISTEM KOSTKU

**Sistem Manajemen Kost "KostKu"**

---

## COVER

**ANALISIS DAN PERANCANGAN SISTEM**  
**APLIKASI MANAJEMEN KOST "KOSTKU"**

**Disusun oleh:**  
Kelompok Contoh Lengkap

**Mata Kuliah:**  
Pemrograman Berbasis Kerangka Kerja (PBKK)

**Dosen Pengampu:**  
Ahmad Rifa'i, S.Kom., M.Kom.

**Program Studi Sistem Informasi**  
**Fakultas Teknologi Informasi dan Komunikasi**  
**Universitas Semarang**  
**2024**

---

## DAFTAR ISI

**COVER** ......................................................... 1  
**DAFTAR ISI** .................................................... 2  
**DAFTAR GAMBAR** ................................................. 3  

**BAB 1 PENDAHULUAN** ............................................. 4  
1.1 Latar Belakang ............................................... 4  
1.2 Job Desk Team ................................................ 6  

**BAB 2 DESAIN UML** .............................................. 8  
2.1 Use Case Diagram ............................................. 8  
2.2 Activity Diagram ............................................ 12  
2.3 Sequence Diagram ............................................ 18  
2.4 Class Diagram ............................................... 24  

**BAB 3 UI/UX DESIGN** ........................................... 30  
3.1 Style Guide ................................................. 30  
3.2 Wireframe ................................................... 32  
3.3 Mockup ...................................................... 35  
3.4 Prototype ................................................... 38  

**KESIMPULAN** .................................................... 42  
**LAMPIRAN** ...................................................... 43  

---

## DAFTAR GAMBAR

**Gambar 2.1** Use Case Diagram - Sistem KostKu .................. 9  
**Gambar 2.2** Activity Diagram - Proses Pendaftaran Penghuni .... 13  
**Gambar 2.3** Activity Diagram - Proses Pembayaran Sewa ......... 15  
**Gambar 2.4** Activity Diagram - Proses Komplain ................ 17  
**Gambar 2.5** Sequence Diagram - Skenario Login Penghuni ........ 19  
**Gambar 2.6** Sequence Diagram - Skenario Penghuni Bayar Sewa ... 21  
**Gambar 2.7** Sequence Diagram - Skenario Pemilik Approve ....... 23  
**Gambar 2.8** Class Diagram - Sistem Manajemen Kost KostKu ...... 25  
**Gambar 3.1** Wireframe - Halaman Login ......................... 33  
**Gambar 3.2** Wireframe - Dashboard Penghuni .................... 33  
**Gambar 3.3** Wireframe - Halaman Pembayaran .................... 34  
**Gambar 3.4** Wireframe - Halaman Komplain ...................... 34  
**Gambar 3.5** Wireframe - Dashboard Pemilik Kost ................ 35  
**Gambar 3.6** Wireframe - Halaman Konfirmasi Pembayaran ......... 35  
**Gambar 3.7** Mockup - Halaman Login ............................. 36  
**Gambar 3.8** Mockup - Dashboard Penghuni ....................... 36  
**Gambar 3.9** Mockup - Halaman Pembayaran ....................... 37  
**Gambar 3.10** Mockup - Halaman Komplain ........................ 37  
**Gambar 3.11** Mockup - Dashboard Pemilik Kost .................. 38  
**Gambar 3.12** Mockup - Konfirmasi Pembayaran ................... 38  

---

# BAB 1: PENDAHULUAN

## 1.1 Latar Belakang

Saat ini, pengelolaan kost di Indonesia masih banyak yang dilakukan secara manual dan konvensional. Pemilik kost mencatat data penghuni, pembayaran, dan komplain menggunakan buku atau spreadsheet sederhana. Penghuni kost harus datang langsung untuk membayar sewa, menyampaikan komplain, atau menanyakan informasi kamar. Sistem manual ini menimbulkan berbagai permasalahan, antara lain:

Pertama, **proses administrasi yang tidak efisien**. Pemilik kost harus mencatat setiap transaksi pembayaran secara manual, menghitung tunggakan, dan membuat laporan keuangan dengan cara yang memakan waktu. Kesalahan pencatatan sering terjadi karena human error, yang dapat menyebabkan konflik antara pemilik dan penghuni.

Kedua, **kesulitan dalam monitoring pembayaran**. Penghuni sering lupa tanggal jatuh tempo pembayaran sewa karena tidak ada sistem reminder otomatis. Pemilik kost juga kesulitan melacak penghuni yang menunggak pembayaran, sehingga harus mengingatkan satu per satu secara manual.

Ketiga, **penanganan komplain yang lambat**. Ketika penghuni memiliki keluhan terkait fasilitas kost (seperti AC rusak, kamar mandi bocor, atau listrik mati), mereka harus menghubungi pemilik kost secara langsung melalui telepon atau datang ke tempat. Hal ini menyebabkan penanganan komplain menjadi tidak terstruktur dan sering terlambat.

Keempat, **transparansi yang kurang**. Penghuni tidak memiliki akses untuk melihat riwayat pembayaran mereka sendiri. Mereka harus meminta bukti pembayaran kepada pemilik kost setiap kali dibutuhkan. Begitu juga dengan informasi kamar kosong, penghuni potensial harus datang langsung atau menelepon untuk menanyakan ketersediaan.

Untuk mengatasi permasalahan-permasalahan tersebut, diperlukan sebuah sistem informasi yang dapat mengotomatisasi dan mempermudah pengelolaan kost. Aplikasi **"KostKu"** dirancang sebagai solusi digital untuk manajemen kost yang lebih efisien dan modern. Aplikasi ini menyediakan platform berbasis web yang dapat diakses oleh pemilik kost dan penghuni kapan saja dan di mana saja.

Dengan aplikasi KostKu, pemilik kost dapat mengelola data kamar, penghuni, dan pembayaran secara digital. Sistem akan otomatis mengirimkan notifikasi pembayaran kepada penghuni sebelum jatuh tempo. Penghuni dapat melakukan pembayaran secara online dan langsung mendapatkan bukti pembayaran digital. Komplain dapat disampaikan melalui aplikasi dan akan tercatat dengan baik, sehingga pemilik kost dapat menindaklanjuti dengan cepat.

Aplikasi ini juga menyediakan dashboard statistik yang memudahkan pemilik kost dalam memonitor occupancy rate, pendapatan bulanan, dan tunggakan pembayaran. Laporan keuangan dapat dihasilkan secara otomatis tanpa perlu perhitungan manual. Penghuni juga mendapatkan transparansi penuh dengan dapat mengakses riwayat pembayaran dan status kamar mereka sendiri.

Dengan adanya aplikasi KostKu, diharapkan dapat meningkatkan efisiensi pengelolaan kost, mengurangi kesalahan administrasi, mempercepat penanganan komplain, dan meningkatkan kepuasan penghuni. Selain itu, aplikasi ini juga dapat membantu pemilik kost dalam mengambil keputusan bisnis berdasarkan data dan statistik yang akurat. Pada akhirnya, digitalisasi pengelolaan kost akan memberikan manfaat bagi semua pihak yang terlibat.

---

## 1.2 Job Desk Team

Pembagian tugas dalam kelompok untuk pengerjaan Projek 1 adalah sebagai berikut:

| No | Nama Lengkap | NIM | Job Desk |
|----|--------------|-----|----------|
| 1  | Ahmad Rizki Kurniawan | G.131.24.0001 | **Ketua Kelompok**<br>- Koordinasi tim dan pembagian tugas<br>- Analisis kebutuhan sistem<br>- Pembuatan Use Case Diagram<br>- Review keseluruhan dokumen<br>- Presentasi projek |
| 2  | Siti Nurhaliza | G.131.24.0002 | **Analis Sistem & Dokumentasi**<br>- Identifikasi aktor dan use case<br>- Pembuatan Activity Diagram (Proses Pendaftaran & Pembayaran)<br>- Penulisan BAB 1 (Latar Belakang)<br>- Proofread dokumen |
| 3  | Budi Santoso | G.131.24.0003 | **Database Designer**<br>- Pembuatan Sequence Diagram (3 skenario)<br>- Pembuatan Class Diagram<br>- Desain database schema<br>- Penulisan BAB 2 (Desain UML) |
| 4  | Dewi Lestari | G.131.24.0004 | **UI/UX Designer**<br>- Riset UI/UX aplikasi sejenis<br>- Pembuatan Wireframe (6 halaman utama)<br>- Desain Style Guide (color, typography)<br>- Pembuatan Mockup dengan Figma |
| 5  | Eko Prasetyo | G.131.24.0005 | **UI/UX Designer & Prototyper**<br>- Pembuatan Activity Diagram (Proses Komplain)<br>- Pembuatan Mockup lanjutan<br>- Pembuatan Prototype interaktif<br>- Penulisan BAB 3 (UI/UX Design) |
| 6  | Fitri Handayani | G.131.24.0006 | **Dokumentasi & Editor**<br>- Kompilasi semua dokumen<br>- Formatting dokumen (font, spasi, margin)<br>- Pembuatan Cover dan Daftar Isi<br>- Pembuatan Daftar Gambar<br>- Quality assurance dokumen<br>- Export ke format .docx |

### Koordinasi Tim

**Tools Kolaborasi:**
- **WhatsApp Group**: Komunikasi harian
- **Google Drive**: Sharing dokumen
- **Figma**: Kolaborasi desain UI/UX
- **Draw.io**: Kolaborasi diagram UML
- **Trello**: Project management & tracking progress

**Meeting Schedule:**
- **Weekly Meeting**: Setiap Senin pukul 19.00 WIB (online via Google Meet)
- **Progress Review**: Setiap Kamis pukul 19.00 WIB
- **Final Review**: Minggu ke-5, Sabtu pukul 14.00 WIB (offline)

---

# BAB 2: DESAIN UML

## 2.1 Use Case Diagram

Use Case Diagram menggambarkan interaksi antara aktor (pengguna) dengan sistem KostKu. Diagram ini menunjukkan fungsi-fungsi yang dapat dilakukan oleh setiap aktor dalam sistem manajemen kost.

### Penjelasan Aktor

Sistem KostKu memiliki 3 (tiga) aktor utama:

#### 1. Penghuni
Penyewa kamar kost yang menggunakan sistem untuk melakukan berbagai aktivitas terkait penyewaan kamar.

**Use Case yang Dapat Diakses:**
- UC-01 Registrasi
- UC-02 Login
- UC-03 Lihat Info Kamar
- UC-04 Bayar Sewa
- UC-05 Lihat Riwayat Pembayaran
- UC-06 Ajukan Komplain
- UC-07 Lihat Status Komplain
- UC-08 Update Profile

#### 2. Pemilik Kost
Pengelola properti kost yang bertanggung jawab atas operasional dan manajemen kost.

**Use Case yang Dapat Diakses:**
- UC-02 Login
- UC-09 Kelola Kamar
- UC-10 Kelola Penghuni
- UC-11 Konfirmasi Pembayaran
- UC-12 Lihat Laporan Keuangan
- UC-13 Kelola Komplain
- UC-14 Lihat Dashboard
- UC-15 Kirim Notifikasi

#### 3. Admin
Administrator sistem yang bertanggung jawab atas konfigurasi dan maintenance sistem.

**Use Case yang Dapat Diakses:**
- UC-02 Login
- UC-16 Kelola User
- UC-17 Konfigurasi Sistem
- UC-18 Backup Data

---

## 2.2 Activity Diagram

Activity Diagram menggambarkan alur aktivitas atau proses bisnis dalam sistem. Sistem KostKu memiliki 3 (tiga) Activity Diagram utama:

### 2.2.1 Activity Diagram - Proses Pendaftaran Penghuni Baru

Proses pendaftaran melibatkan:
- Penghuni mengisi form registrasi
- Sistem validasi data
- Pemilik Kost melakukan approval
- Sistem generate akun dan invoice

**Elemen Penting:**
- Fork dan Join untuk parallel processing
- Decision point untuk validasi dan approval
- Notifikasi otomatis ke Pemilik dan Penghuni

### 2.2.2 Activity Diagram - Proses Pembayaran Sewa Kost

Proses pembayaran menggunakan swimlane untuk 3 aktor:
- **Penghuni**: Login, pilih tagihan, upload bukti transfer
- **Sistem**: Simpan data, kirim notifikasi
- **Pemilik Kost**: Verifikasi, approve/reject pembayaran

### 2.2.3 Activity Diagram - Proses Pengajuan dan Penanganan Komplain

Proses komplain dengan feedback loop:
- Penghuni ajukan komplain
- Pemilik tangani dan resolve
- Penghuni verifikasi hasil
- Jika tidak puas, komplain dapat dibuka kembali

---

## 2.3 Sequence Diagram

Sequence Diagram menggambarkan interaksi antar objek dalam sistem berdasarkan urutan waktu. Sistem KostKu memiliki 3 (tiga) Sequence Diagram utama:

### 2.3.1 Sequence Diagram - Skenario Login Penghuni

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

### 2.3.2 Sequence Diagram - Skenario Penghuni Bayar Sewa

Objek yang terlibat:
- Penghuni, PembayaranPage, PembayaranController
- Tagihan, Pembayaran, Database, NotificationService

**Alur Interaksi:**
1. Ambil data tagihan aktif
2. Penghuni pilih tagihan dan upload bukti
3. Controller validasi file
4. Pembayaran insert data ke database
5. Update status tagihan
6. NotificationService kirim notifikasi ke Pemilik

### 2.3.3 Sequence Diagram - Skenario Pemilik Approve Pembayaran

**Alur Interaksi:**
1. Ambil list pembayaran pending
2. Pemilik lihat detail dan verifikasi
3. Pemilik approve pembayaran
4. Update status pembayaran dan tagihan
5. Generate kwitansi PDF
6. Kirim notifikasi dan kwitansi ke Penghuni

---

## 2.4 Class Diagram

Class Diagram menggambarkan struktur statis sistem dengan 9 (sembilan) class utama:

### Daftar Class

1. **User** - Base class untuk semua pengguna
2. **Penghuni** - Class untuk penghuni kost (extends User)
3. **PemilikKost** - Class untuk pemilik kost (extends User)
4. **Kamar** - Class untuk kamar kost
5. **Penghunian** - Class untuk relasi penghuni-kamar
6. **Tagihan** - Class untuk tagihan pembayaran
7. **Pembayaran** - Class untuk transaksi pembayaran
8. **Komplain** - Class untuk komplain penghuni
9. **Notifikasi** - Class untuk notifikasi sistem

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

**One to One:**
- Tagihan (1) → Pembayaran (1)

---

# BAB 3: UI/UX DESIGN

## 3.1 Style Guide

Style Guide adalah panduan visual yang mendefinisikan elemen-elemen desain yang akan digunakan secara konsisten di seluruh aplikasi KostKu.

### Color Palette

**Primary Colors:**
- **Primary Blue**: #3B82F6 - Header, tombol utama, link aktif
- **Secondary Slate**: #64748B - Teks sekunder, border, icon

**Functional Colors:**
- **Success Green**: #10B981 - Status berhasil, notifikasi positif
- **Warning Orange**: #F59E0B - Peringatan, status pending
- **Danger Red**: #EF4444 - Error, status ditolak, hapus
- **Info Cyan**: #06B6D4 - Informasi, tips, bantuan

### Typography

**Font Family:**
- **Primary Font**: "Inter" - Font utama untuk body text
- **Heading Font**: "Poppins" - Font untuk heading

**Font Sizes:**
- **H1**: 32px - Judul halaman utama
- **H2**: 24px - Judul section
- **H3**: 20px - Judul card/komponen
- **Body**: 16px - Teks utama
- **Small**: 14px - Teks sekunder

---

## 3.2 Wireframe

Wireframe adalah kerangka dasar yang menunjukkan layout dan struktur halaman. Sistem KostKu memiliki 6 wireframe utama:

### 3.2.1 Halaman Login
- Logo KostKu di bagian atas
- Form login di tengah halaman
- Link "Lupa Password" dan "Daftar"
- Background dengan gambar kost

### 3.2.2 Dashboard Penghuni
- Header dengan logo, menu, dan profil pengguna
- Sidebar navigasi di kiri
- Area konten utama dengan widget informasi
- Quick stats dan recent activities

### 3.2.3 Halaman Pembayaran
- List tagihan yang belum dibayar
- Informasi detail setiap tagihan
- Tombol "Bayar" untuk setiap tagihan
- Riwayat pembayaran sebelumnya

### 3.2.4 Halaman Komplain
- Tombol "Ajukan Komplain" di bagian atas
- List komplain dengan status dan tanggal
- Filter berdasarkan status
- Search box untuk cari komplain

### 3.2.5 Dashboard Pemilik Kost
- Statistics cards menampilkan KPI utama
- Recent activities untuk monitoring real-time
- Charts untuk visualisasi data
- Quick actions untuk tugas harian

### 3.2.6 Halaman Konfirmasi Pembayaran
- List pembayaran yang menunggu konfirmasi
- Detail pembayaran dengan bukti transfer
- Tombol Approve dan Reject
- History konfirmasi sebelumnya

---

## 3.3 Mockup

Mockup adalah desain visual detail yang menunjukkan tampilan akhir aplikasi dengan implementasi style guide yang telah ditentukan.

### Karakteristik Visual

**Login Page:**
- Background gradient #3B82F6 ke #1E40AF
- Login card dengan shadow halus dan border radius 16px
- Form elements dengan focus state #3B82F6

**Dashboard:**
- Header background white dengan shadow
- Sidebar background #F9FAFB
- Cards dengan border radius 12px dan shadow halus
- Color coding untuk status dan prioritas

**Responsive Design:**
- Mobile: Card width 90%, padding 24px
- Tablet: Card width 500px
- Desktop: Card width 400px

---

## 3.4 Prototype

Prototype adalah simulasi interaktif yang menunjukkan user flow dan interaksi.

### User Flow Penghuni

**Flow 1: Login ke Dashboard**
```
[Login Page] → [Loading State] → [Dashboard Penghuni] → [Menu Navigation]
```

**Flow 2: Proses Pembayaran**
```
[Halaman Pembayaran] → [Modal Upload] → [Preview & Konfirmasi] → [Success State]
```

**Flow 3: Ajukan Komplain**
```
[Halaman Komplain] → [Form Komplain] → [Preview] → [Success & Redirect]
```

### User Flow Pemilik Kost

**Flow 1: Konfirmasi Pembayaran**
```
[Dashboard] → [Konfirmasi Pembayaran] → [Detail Modal] → [Approve/Reject]
```

**Flow 2: Kelola Komplain**
```
[Dashboard] → [Kelola Komplain] → [Filter Urgent] → [Update Status]
```

### Responsive Behavior

- **Mobile**: Sidebar overlay, cards full-width, touch-friendly buttons
- **Tablet**: Sidebar visible, 2-column grid
- **Desktop**: Full layout, hover states, tooltips

---

# KESIMPULAN

Dokumen analisis dan perancangan sistem KostKu ini telah menyajikan desain lengkap untuk aplikasi manajemen kost modern. Sistem ini dirancang untuk mengatasi permasalahan pengelolaan kost konvensional dengan solusi digital yang efisien.

## Ringkasan Hasil Analisis

**1. Identifikasi Masalah:**
- Proses administrasi manual yang tidak efisien
- Kesulitan monitoring pembayaran
- Penanganan komplain yang lambat
- Kurangnya transparansi informasi

**2. Solusi yang Diusulkan:**
- Sistem digital terintegrasi untuk pengelolaan kost
- Otomatisasi proses pembayaran dan notifikasi
- Platform komplain terstruktur dengan tracking
- Dashboard transparansi untuk semua stakeholder

**3. Desain Sistem:**
- **UML Design**: 18 use case, 3 activity diagram, 3 sequence diagram, 9 class
- **UI/UX Design**: Style guide konsisten, 6 wireframe, mockup responsive, prototype interaktif
- **Architecture**: Web-based application dengan role-based access

## Manfaat Implementasi

**Untuk Penghuni:**
- Kemudahan pembayaran online 24/7
- Tracking status pembayaran real-time
- Platform komplain yang responsif
- Transparansi informasi kamar dan tagihan

**Untuk Pemilik Kost:**
- Otomatisasi administrasi dan laporan
- Monitoring real-time occupancy dan pendapatan
- Sistem konfirmasi pembayaran yang efisien
- Dashboard analytics untuk decision making

**Untuk Sistem:**
- Audit trail lengkap untuk semua transaksi
- Scalability untuk multiple properti
- Security dengan role-based access control
- Integration ready dengan payment gateway

## Rekomendasi Implementasi

**Technology Stack:**
- **Backend**: Laravel 10.x dengan MySQL
- **Frontend**: Vue.js 3 dengan Tailwind CSS
- **Mobile**: Progressive Web App (PWA)
- **Deployment**: Docker dengan CI/CD pipeline

**Development Phase:**
- **Phase 1**: Core features (login, pembayaran, komplain)
- **Phase 2**: Advanced features (laporan, analytics)
- **Phase 3**: Mobile app dan integration

**Success Metrics:**
- Reduction 80% waktu administrasi
- Increase 95% accuracy pembayaran
- Decrease 70% response time komplain
- Increase 90% user satisfaction

---

# LAMPIRAN

## Lampiran A: File Diagram PlantUML

Semua diagram UML tersedia dalam format PlantUML di folder `diagrams/`:

- `usecase.puml` - Use Case Diagram
- `activity_pendaftaran.puml` - Activity Diagram Pendaftaran
- `activity_pembayaran.puml` - Activity Diagram Pembayaran
- `activity_komplain.puml` - Activity Diagram Komplain
- `sequence_login.puml` - Sequence Diagram Login
- `sequence_bayar.puml` - Sequence Diagram Bayar Sewa
- `sequence_approve.puml` - Sequence Diagram Approve
- `class.puml` - Class Diagram

## Lampiran B: Cara Generate Diagram

**Online PlantUML:**
1. Buka https://www.plantuml.com/plantuml/uml/
2. Copy-paste kode dari file .puml
3. Klik "Submit" untuk generate
4. Download sebagai PNG/SVG

**VS Code Extension:**
1. Install extension "PlantUML"
2. Buka file .puml
3. Tekan Alt+D untuk preview
4. Export sebagai image

**Command Line:**
```bash
java -jar plantuml.jar diagrams/*.puml
```

## Lampiran C: Database Schema

**Tabel Users:**
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('penghuni', 'pemilik', 'admin') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Tabel Penghuni:**
```sql
CREATE TABLE penghuni (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  nama VARCHAR(255) NOT NULL,
  nik VARCHAR(16) UNIQUE NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  status ENUM('pending', 'active', 'inactive') DEFAULT 'pending',
  FOREIGN KEY (user_id) REFERENCES users(id)
);
```

*[Schema lengkap tersedia dalam dokumentasi teknis]*

## Lampiran D: API Specification

**Authentication Endpoints:**
```
POST /api/auth/login
POST /api/auth/logout
POST /api/auth/register
```

**Pembayaran Endpoints:**
```
GET /api/pembayaran/tagihan
POST /api/pembayaran/submit
GET /api/pembayaran/riwayat
```

*[API documentation lengkap tersedia dalam file terpisah]*

---

**Dokumen ini disusun sebagai panduan lengkap untuk implementasi sistem KostKu. Semua diagram, spesifikasi, dan dokumentasi teknis tersedia dalam repository projek.**

**Terima kasih.**

---

**© 2024 Kelompok Contoh Lengkap - Universitas Semarang**