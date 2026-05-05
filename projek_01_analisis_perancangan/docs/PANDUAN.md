# Panduan Lengkap Projek 1

## 📋 Daftar Isi

1. [Pembentukan Kelompok](#pembentukan-kelompok)
2. [Pemilihan Tema](#pemilihan-tema)
3. [Analisis Kebutuhan](#analisis-kebutuhan)
4. [Pembuatan UML](#pembuatan-uml)
5. [Desain UI/UX](#desain-uiux)
6. [Penulisan Dokumentasi](#penulisan-dokumentasi)

---

## Pembentukan Kelompok

### Langkah 1: Tentukan Anggota
- Maksimal 6 orang per kelompok
- Pilih anggota dengan skill yang beragam:
  - Analisis sistem
  - Desain UML
  - Desain UI/UX
  - Dokumentasi

### Langkah 2: Bagi Tugas (Job Desk)

**Contoh Pembagian Tugas:**

| No | Nama | NIM | Job Desk |
|----|------|-----|----------|
| 1 | [Nama] | [NIM] | Ketua, Analisis Sistem, Use Case Diagram |
| 2 | [Nama] | [NIM] | Activity Diagram, Dokumentasi BAB 1 |
| 3 | [Nama] | [NIM] | Sequence Diagram, Class Diagram |
| 4 | [Nama] | [NIM] | Wireframe, Mockup |
| 5 | [Nama] | [NIM] | Prototype, UI/UX Documentation |
| 6 | [Nama] | [NIM] | Dokumentasi BAB 2 & 3, Formatting |

---

## Pemilihan Tema

### Kriteria Tema yang Baik

✅ **Relevan dengan kehidupan sehari-hari**
- Mudah dipahami
- Jelas kebutuhannya

✅ **Scope yang tepat**
- Tidak terlalu sederhana
- Tidak terlalu kompleks
- Fokus pada 5-8 fitur utama

✅ **Memiliki multiple user roles**
- Minimal 2 jenis pengguna
- Contoh: Admin, User, Manager

### Contoh Tema yang Direkomendasikan

#### 1. Sistem Informasi Akademik Kampus

**Deskripsi:**
Aplikasi untuk mengelola data akademik mahasiswa, dosen, dan mata kuliah.

**Fitur Utama:**
- Login (Mahasiswa, Dosen, Admin)
- Manajemen data mahasiswa
- Manajemen mata kuliah
- Pengisian KRS
- Input nilai
- Lihat transkrip nilai
- Jadwal kuliah

**Aktor:**
- Mahasiswa
- Dosen
- Admin Akademik

---

#### 2. E-Commerce Fashion

**Deskripsi:**
Platform jual beli produk fashion online.

**Fitur Utama:**
- Registrasi & Login
- Katalog produk
- Pencarian & filter
- Keranjang belanja
- Checkout & pembayaran
- Tracking pesanan
- Review produk
- Dashboard admin

**Aktor:**
- Customer
- Seller
- Admin

---

#### 3. Sistem Perpustakaan Digital

**Deskripsi:**
Aplikasi manajemen perpustakaan dengan fitur peminjaman online.

**Fitur Utama:**
- Katalog buku digital
- Pencarian buku
- Peminjaman online
- Perpanjangan pinjaman
- Notifikasi jatuh tempo
- Denda otomatis
- Laporan statistik

**Aktor:**
- Anggota perpustakaan
- Pustakawan
- Admin

---

#### 4. Aplikasi Manajemen Kost

**Deskripsi:**
Sistem untuk mengelola kost, penghuni, dan pembayaran.

**Fitur Utama:**
- Pendaftaran penghuni
- Manajemen kamar
- Pembayaran sewa
- Komplain & maintenance
- Notifikasi pembayaran
- Laporan keuangan

**Aktor:**
- Penghuni
- Pemilik kost
- Admin

---

#### 5. Sistem Klinik/Puskesmas

**Deskripsi:**
Aplikasi untuk manajemen pasien dan layanan kesehatan.

**Fitur Utama:**
- Pendaftaran pasien
- Antrian online
- Rekam medis elektronik
- Resep digital
- Jadwal dokter
- Riwayat kunjungan
- Laporan kesehatan

**Aktor:**
- Pasien
- Dokter
- Perawat
- Admin

---

## Analisis Kebutuhan

### Langkah 1: Identifikasi Stakeholder

**Pertanyaan Kunci:**
- Siapa yang akan menggunakan sistem?
- Apa peran masing-masing pengguna?
- Apa kebutuhan setiap pengguna?

**Contoh (Sistem Akademik):**
- **Mahasiswa:** Melihat jadwal, mengisi KRS, melihat nilai
- **Dosen:** Input nilai, melihat jadwal mengajar
- **Admin:** Kelola data mahasiswa, dosen, mata kuliah

### Langkah 2: Identifikasi Kebutuhan Fungsional

**Pertanyaan Kunci:**
- Apa yang harus bisa dilakukan sistem?
- Fitur apa yang dibutuhkan?

**Format:**
```
FR-01: Sistem harus dapat melakukan login
FR-02: Sistem harus dapat menampilkan daftar mahasiswa
FR-03: Sistem harus dapat menginput nilai
...
```

### Langkah 3: Identifikasi Kebutuhan Non-Fungsional

**Contoh:**
- **Performance:** Response time < 3 detik
- **Security:** Enkripsi password, session management
- **Usability:** Interface user-friendly
- **Reliability:** Uptime 99%

---

## Pembuatan UML

### 1. Use Case Diagram

**Tujuan:** Menggambarkan interaksi antara aktor dengan sistem.

**Komponen:**
- **Actor:** Pengguna sistem (stick figure)
- **Use Case:** Fungsi sistem (oval)
- **Relationship:** 
  - Association (garis)
  - Include (<<include>>)
  - Extend (<<extend>>)
  - Generalization (panah)

**Langkah Pembuatan:**

1. **Identifikasi Aktor**
   ```
   - Mahasiswa
   - Dosen
   - Admin
   ```

2. **Identifikasi Use Case**
   ```
   - Login
   - Lihat Jadwal
   - Isi KRS
   - Input Nilai
   - Kelola Data Mahasiswa
   ```

3. **Hubungkan Aktor dengan Use Case**
   - Mahasiswa → Login, Lihat Jadwal, Isi KRS
   - Dosen → Login, Input Nilai
   - Admin → Login, Kelola Data Mahasiswa

**Contoh:**
```
┌─────────┐
│Mahasiswa│
└────┬────┘
     │
     ├──────→ (Login)
     │
     ├──────→ (Lihat Jadwal)
     │
     └──────→ (Isi KRS)
```

---

### 2. Activity Diagram

**Tujuan:** Menggambarkan alur proses bisnis.

**Komponen:**
- **Start Node:** Titik awal (lingkaran hitam)
- **Activity:** Aktivitas (rounded rectangle)
- **Decision:** Percabangan (diamond)
- **Fork/Join:** Parallel process (bar)
- **End Node:** Titik akhir (lingkaran dengan border)

**Langkah Pembuatan:**

1. **Tentukan Proses yang Akan Digambarkan**
   - Contoh: Proses Login

2. **Identifikasi Langkah-Langkah**
   ```
   1. Mulai
   2. Input username & password
   3. Validasi
   4. Jika valid → Dashboard
   5. Jika tidak → Error message
   6. Selesai
   ```

3. **Gambar Diagram**

**Contoh (Proses Login):**
```
(●) Start
  ↓
[Input Username & Password]
  ↓
<Validasi>
  ├─ Valid → [Tampil Dashboard] → (●)
  └─ Invalid → [Tampil Error] → (●)
```

---

### 3. Sequence Diagram

**Tujuan:** Menggambarkan interaksi antar objek berdasarkan waktu.

**Komponen:**
- **Actor:** Pengguna
- **Object:** Komponen sistem (box)
- **Lifeline:** Garis vertikal
- **Message:** Panah horizontal
- **Activation:** Rectangle pada lifeline

**Langkah Pembuatan:**

1. **Tentukan Skenario**
   - Contoh: Mahasiswa Login

2. **Identifikasi Objek yang Terlibat**
   ```
   - Mahasiswa (Actor)
   - LoginPage (Boundary)
   - AuthController (Control)
   - Database (Entity)
   ```

3. **Gambar Interaksi**

**Contoh:**
```
Mahasiswa  LoginPage  AuthController  Database
    |          |            |            |
    |--input-->|            |            |
    |          |--validate->|            |
    |          |            |--query---->|
    |          |            |<--result---|
    |          |<--response-|            |
    |<-display-|            |            |
```

---

### 4. Class Diagram

**Tujuan:** Menggambarkan struktur class dan relasinya.

**Komponen:**
- **Class:** Box dengan 3 bagian (nama, atribut, method)
- **Relationship:**
  - Association (garis)
  - Aggregation (diamond kosong)
  - Composition (diamond penuh)
  - Inheritance (panah kosong)
  - Dependency (panah putus-putus)

**Langkah Pembuatan:**

1. **Identifikasi Class**
   ```
   - User
   - Mahasiswa
   - Dosen
   - MataKuliah
   - KRS
   ```

2. **Tentukan Atribut**
   ```
   User:
   - id: int
   - username: string
   - password: string
   - role: string
   ```

3. **Tentukan Method**
   ```
   User:
   + login()
   + logout()
   + changePassword()
   ```

4. **Tentukan Relasi**
   ```
   - Mahasiswa extends User
   - Mahasiswa has many KRS
   - KRS belongs to MataKuliah
   ```

**Contoh:**
```
┌─────────────────┐
│      User       │
├─────────────────┤
│ - id: int       │
│ - username: str │
│ - password: str │
├─────────────────┤
│ + login()       │
│ + logout()      │
└─────────────────┘
        △
        │ (inheritance)
        │
┌───────┴─────────┐
│   Mahasiswa     │
├─────────────────┤
│ - nim: string   │
│ - nama: string  │
├─────────────────┤
│ + isiKRS()      │
└─────────────────┘
```

---

## Desain UI/UX

### 1. Wireframe

**Tujuan:** Sketsa layout halaman (low-fidelity).

**Karakteristik:**
- Hitam putih / grayscale
- Fokus pada struktur dan layout
- Tidak ada detail visual

**Langkah Pembuatan:**

1. **Identifikasi Halaman Utama**
   ```
   - Login
   - Dashboard
   - List Data
   - Form Input
   - Detail
   ```

2. **Sketsa Layout**
   - Header (logo, menu, user info)
   - Sidebar (navigasi)
   - Content area
   - Footer

3. **Gunakan Placeholder**
   - [Logo]
   - [Button]
   - [Image]
   - Lorem ipsum untuk teks

**Tools:**
- Balsamiq
- Figma (wireframe mode)
- Draw.io
- Kertas & pensil

---

### 2. Mockup

**Tujuan:** Desain visual lengkap (high-fidelity).

**Karakteristik:**
- Full color
- Typography yang jelas
- Icon dan image
- Detail visual

**Langkah Pembuatan:**

1. **Tentukan Style Guide**
   - Color palette (primary, secondary, accent)
   - Typography (font family, size, weight)
   - Spacing (margin, padding)
   - Component style (button, input, card)

2. **Desain Komponen**
   - Button (primary, secondary, danger)
   - Input field
   - Card
   - Navigation
   - Modal

3. **Desain Halaman**
   - Gunakan komponen yang sudah dibuat
   - Konsisten dalam spacing dan alignment
   - Perhatikan hierarchy visual

**Tools:**
- Figma (recommended)
- Adobe XD
- Sketch

---

### 3. Prototype

**Tujuan:** Simulasi interaksi dan navigasi.

**Karakteristik:**
- Clickable
- Menunjukkan flow antar halaman
- Simulasi interaksi (hover, click)

**Langkah Pembuatan:**

1. **Hubungkan Halaman**
   - Login → Dashboard
   - Dashboard → List
   - List → Detail
   - Detail → Edit

2. **Tambahkan Interaksi**
   - Button click
   - Form submit
   - Modal open/close
   - Dropdown

3. **Test Flow**
   - User journey lengkap
   - Edge cases
   - Error handling

**Tools:**
- Figma (prototype mode)
- Adobe XD
- InVision

---

## Penulisan Dokumentasi

### Format Dokumen

**Pengaturan Halaman:**
- **Font:** Times New Roman
- **Size:** 12 pt
- **Line Spacing:** 1.5
- **Margin:** 3 cm (top, bottom, left, right)
- **Alignment:** Justify

### Struktur Dokumen

#### Cover

```
[Logo Universitas]

ANALISIS DAN PERANCANGAN SISTEM
[JUDUL APLIKASI]

Projek 1
Mata Kuliah: Pemrograman Berbasis Kerangka Kerja

Disusun Oleh:
Kelompok [Nomor]
1. [Nama] - [NIM]
2. [Nama] - [NIM]
...

Dosen Pengampu:
Ahmad Rifa'i, S.Kom., M.Kom.

PROGRAM STUDI SISTEM INFORMASI
FAKULTAS TEKNOLOGI INFORMASI DAN KOMUNIKASI
UNIVERSITAS SEMARANG
2026
```

---

#### BAB 1: Pendahuluan

**1.1 Latar Belakang**

Template:
```
[Paragraf 1: Kondisi saat ini / Permasalahan]
Saat ini, [deskripsi kondisi/masalah yang ada]. 
Hal ini menyebabkan [dampak negatif].

[Paragraf 2: Solusi yang ditawarkan]
Untuk mengatasi permasalahan tersebut, diperlukan 
[solusi yang ditawarkan]. Aplikasi [nama aplikasi] 
dirancang untuk [tujuan utama].

[Paragraf 3: Manfaat]
Dengan adanya aplikasi ini, diharapkan dapat 
[manfaat 1], [manfaat 2], dan [manfaat 3].
```

**Contoh:**
```
Saat ini, proses pendaftaran dan peminjaman buku 
di perpustakaan kampus masih dilakukan secara manual. 
Mahasiswa harus datang langsung ke perpustakaan untuk 
mencari dan meminjam buku. Hal ini menyebabkan antrian 
panjang dan membuang waktu mahasiswa.

Untuk mengatasi permasalahan tersebut, diperlukan 
sistem perpustakaan digital yang dapat diakses secara 
online. Aplikasi "DigiLib" dirancang untuk memudahkan 
mahasiswa dalam mencari, meminjam, dan mengembalikan 
buku secara digital.

Dengan adanya aplikasi ini, diharapkan dapat 
meningkatkan efisiensi layanan perpustakaan, 
menghemat waktu mahasiswa, dan meningkatkan 
minat baca di kalangan mahasiswa.
```

---

**1.2 Job Desk Team**

Format tabel:
```
| No | Nama | NIM | Job Desk |
|----|------|-----|----------|
| 1  | [Nama Lengkap] | [NIM] | [Deskripsi tugas] |
| 2  | [Nama Lengkap] | [NIM] | [Deskripsi tugas] |
...
```

**Contoh:**
```
| No | Nama | NIM | Job Desk |
|----|------|-----|----------|
| 1  | Ahmad Rizki | G.131.24.0001 | Ketua kelompok, Analisis sistem, Use Case Diagram |
| 2  | Siti Nurhaliza | G.131.24.0002 | Activity Diagram, Dokumentasi BAB 1 |
| 3  | Budi Santoso | G.131.24.0003 | Sequence Diagram, Class Diagram |
| 4  | Dewi Lestari | G.131.24.0004 | Wireframe, Mockup UI/UX |
| 5  | Eko Prasetyo | G.131.24.0005 | Prototype, Dokumentasi BAB 3 |
| 6  | Fitri Handayani | G.131.24.0006 | Dokumentasi BAB 2, Formatting dokumen |
```

---

#### BAB 2: Desain UML

**2.1 Use Case Diagram**

Template:
```
2.1 Use Case Diagram

Use Case Diagram menggambarkan interaksi antara 
aktor dengan sistem. Berikut adalah Use Case Diagram 
dari aplikasi [nama aplikasi]:

[Gambar Use Case Diagram]
Gambar 2.1 Use Case Diagram

Penjelasan:
- Aktor [nama aktor]: [deskripsi peran]
- Use Case [nama use case]: [deskripsi fungsi]
...
```

---

**2.2 Activity Diagram**

Template:
```
2.2 Activity Diagram

Activity Diagram menggambarkan alur proses bisnis 
dalam sistem. Berikut adalah Activity Diagram untuk 
proses [nama proses]:

[Gambar Activity Diagram]
Gambar 2.2 Activity Diagram - [Nama Proses]

Penjelasan alur:
1. [Langkah 1]
2. [Langkah 2]
...
```

---

**2.3 Sequence Diagram**

Template:
```
2.3 Sequence Diagram

Sequence Diagram menggambarkan interaksi antar objek 
berdasarkan urutan waktu. Berikut adalah Sequence 
Diagram untuk skenario [nama skenario]:

[Gambar Sequence Diagram]
Gambar 2.3 Sequence Diagram - [Nama Skenario]

Objek yang terlibat:
- [Nama objek]: [deskripsi]
...
```

---

**2.4 Class Diagram**

Template:
```
2.4 Class Diagram

Class Diagram menggambarkan struktur class dan 
relasinya dalam sistem. Berikut adalah Class Diagram 
dari aplikasi [nama aplikasi]:

[Gambar Class Diagram]
Gambar 2.4 Class Diagram

Penjelasan class:
- Class [nama]: [deskripsi]
  - Atribut: [list atribut]
  - Method: [list method]
...

Relasi antar class:
- [Class A] [relasi] [Class B]: [penjelasan]
...
```

---

#### BAB 3: UI/UX Design

**3.1 Wireframe**

Template:
```
3.1 Wireframe

Wireframe adalah sketsa layout halaman yang 
menggambarkan struktur dan tata letak elemen 
tanpa detail visual. Berikut adalah wireframe 
dari aplikasi [nama aplikasi]:

3.1.1 Halaman Login
[Gambar Wireframe Login]
Gambar 3.1 Wireframe Halaman Login

3.1.2 Halaman Dashboard
[Gambar Wireframe Dashboard]
Gambar 3.2 Wireframe Halaman Dashboard

...
```

---

**3.2 Mockup**

Template:
```
3.2 Mockup

Mockup adalah desain visual lengkap dengan warna, 
typography, dan detail visual lainnya. Berikut 
adalah mockup dari aplikasi [nama aplikasi]:

3.2.1 Style Guide
- Color Palette:
  - Primary: [kode warna]
  - Secondary: [kode warna]
  - Accent: [kode warna]
- Typography:
  - Heading: [font, size]
  - Body: [font, size]

3.2.2 Halaman Login
[Gambar Mockup Login]
Gambar 3.3 Mockup Halaman Login

...
```

---

**3.3 Prototype**

Template:
```
3.3 Prototype

Prototype adalah simulasi interaksi dan navigasi 
antar halaman. Link prototype dapat diakses di:
[Link Figma/Adobe XD]

Flow navigasi:
1. Login → Dashboard
2. Dashboard → [Halaman]
3. ...

[Screenshot prototype dengan annotation]
Gambar 3.X Prototype Flow
```

---

## Tips Penulisan

### 1. Bahasa

✅ **GOOD:**
- Gunakan bahasa formal
- Kalimat lengkap (S-P-O-K)
- Istilah teknis yang tepat

❌ **BAD:**
- Bahasa informal/gaul
- Kalimat tidak lengkap
- Istilah tidak konsisten

### 2. Gambar

✅ **GOOD:**
- Resolusi tinggi
- Diberi caption dan nomor
- Direferensikan dalam teks

❌ **BAD:**
- Gambar blur
- Tidak ada caption
- Tidak dijelaskan

### 3. Konsistensi

✅ **GOOD:**
- Istilah konsisten (User vs Pengguna)
- Format heading konsisten
- Numbering konsisten

❌ **BAD:**
- Istilah berganti-ganti
- Format tidak konsisten

---

## Checklist Final

### Kelengkapan
- [ ] Cover lengkap
- [ ] BAB 1 lengkap (Latar Belakang, Job Desk)
- [ ] BAB 2 lengkap (4 diagram UML)
- [ ] BAB 3 lengkap (Wireframe, Mockup, Prototype)
- [ ] Semua gambar ada caption dan nomor
- [ ] Daftar Pustaka (jika ada)

### Format
- [ ] Font: Times New Roman 12pt
- [ ] Spasi: 1.5
- [ ] Margin: 3cm semua sisi
- [ ] Alignment: Justify
- [ ] File format: .docx

### Kualitas
- [ ] Diagram jelas dan mudah dibaca
- [ ] Desain UI/UX konsisten
- [ ] Tidak ada typo
- [ ] Bahasa formal dan baku

---

**Selamat mengerjakan!** 🚀
