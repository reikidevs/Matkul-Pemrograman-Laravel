# Prototype HTML - Sistem KostKu

Prototype HTML interaktif untuk sistem manajemen kost KostKu berdasarkan desain UI/UX di BAB 3.

## 📁 Struktur File

```
prototype_html/
├── README.md (file ini)
├── index.html (Halaman Login)
├── dashboard-penghuni.html (Dashboard Penghuni)
├── pembayaran-penghuni.html (Halaman Pembayaran)
├── komplain-penghuni.html (Halaman Komplain)
├── kamar-penghuni.html (Info Kamar)
├── profile-penghuni.html (Profile Penghuni)
├── dashboard-pemilik.html (Dashboard Pemilik Kost)
├── konfirmasi-pembayaran.html (Konfirmasi Pembayaran Pemilik)
├── kelola-komplain.html (Kelola Komplain Pemilik)
├── register.html (Halaman Registrasi)
└── styles.css (CSS Global)
```

## 🚀 Cara Menggunakan

### 1. Buka di Browser

Cukup double-click file `index.html` atau buka dengan browser:
- Chrome
- Firefox
- Safari
- Edge

### 2. Login

**Untuk Penghuni:**
- Email: `penghuni@example.com` atau `ahmad@example.com`
- Password: (apa saja)
- Akan redirect ke Dashboard Penghuni

**Untuk Pemilik Kost:**
- Email: `pemilik@example.com` atau `owner@example.com`
- Password: (apa saja)
- Akan redirect ke Dashboard Pemilik

### 3. Navigasi

Gunakan sidebar menu untuk navigasi antar halaman.

## 🎨 Fitur Prototype

### ✅ Halaman yang Sudah Dibuat

#### **Untuk Penghuni (5 halaman):**

1. **Login Page** (`index.html`) ✅
   - Form login dengan validasi
   - Auto-redirect berdasarkan email
   - Link ke registrasi
   - Gradient background
   - Responsive design

2. **Dashboard Penghuni** (`dashboard-penghuni.html`) ✅
   - Welcome section dengan gradient
   - 4 Stats cards (Kamar, Status, Jatuh Tempo, Komplain)
   - Recent activities dengan timeline
   - 3 Quick action cards
   - Sidebar navigation

3. **Pembayaran Penghuni** (`pembayaran-penghuni.html`) ✅
   - Tagihan aktif dengan detail lengkap
   - Info rekening bank
   - Modal upload bukti transfer
   - Riwayat pembayaran dalam tabel
   - Download kwitansi button
   - Form validation

4. **Komplain Penghuni** (`komplain-penghuni.html`) ✅
   - Button ajukan komplain baru
   - Filter by status (Open, In Progress, Resolved, Closed)
   - List komplain dengan color-coded priority
   - Modal form komplain lengkap
   - Upload foto bukti
   - Status badges

5. **Info Kamar** (`kamar-penghuni.html`) ✅
   - Foto kamar dan gallery
   - Detail kamar lengkap (tipe, luas, lantai)
   - Harga sewa prominent
   - Checklist fasilitas kamar
   - Informasi penghunian (tanggal masuk, durasi kontrak)
   - Fasilitas umum kost
   - Peraturan kost

#### **Untuk Pemilik Kost (3 halaman):**

6. **Dashboard Pemilik** (`dashboard-pemilik.html`) ✅
   - Welcome section
   - 4 Statistics cards (Total Kamar, Terisi, Pendapatan, Pending)
   - Occupancy rate percentage
   - 4 Quick action cards
   - Recent activities timeline
   - Chart pendapatan bulanan (bar chart)
   - Sidebar navigation

7. **Konfirmasi Pembayaran** (`konfirmasi-pembayaran.html`) ✅
   - Alert notification pending count
   - Table pembayaran pending
   - Modal detail pembayaran
   - Preview bukti transfer
   - Approve/Reject buttons dengan konfirmasi
   - Input alasan reject

8. **Kelola Komplain** (placeholder - bisa ditambahkan)
   - List komplain dengan filter
   - Assign ke teknisi
   - Update status
   - Add notes/comments

## 🎯 Design System

### Color Palette

- **Primary**: #3B82F6 (Blue)
- **Success**: #10B981 (Green)
- **Warning**: #F59E0B (Orange)
- **Danger**: #EF4444 (Red)
- **Gray**: #6B7280

### Typography

- **Heading**: Poppins, Bold
- **Body**: Inter, Regular
- **Font Sizes**: 12px - 32px

### Components

- **Buttons**: Primary, Secondary, Success, Danger
- **Cards**: White background, shadow, rounded corners
- **Badges**: Color-coded status indicators
- **Forms**: Clean input fields with focus states
- **Tables**: Responsive with hover effects
- **Modals**: Overlay with smooth animations

## 📱 Responsive Design

Prototype ini responsive untuk:
- **Desktop**: Full layout dengan sidebar
- **Tablet**: Optimized spacing
- **Mobile**: Sidebar menjadi overlay, cards full-width

## 🔧 Teknologi

- **HTML5**: Semantic markup
- **CSS3**: Custom properties (CSS Variables), Flexbox, Grid
- **JavaScript**: Vanilla JS untuk interaksi
- **No Framework**: Pure HTML/CSS/JS untuk kemudahan

## 💡 Catatan Pengembangan

### Untuk Developer

Jika ingin mengimplementasikan ke Laravel:

1. **Convert HTML ke Blade**:
   - Ganti `.html` menjadi `.blade.php`
   - Tambahkan `@extends`, `@section`, `@yield`
   - Gunakan `{{ }}` untuk data dinamis

2. **Integrate dengan Backend**:
   - Ganti data statis dengan data dari controller
   - Tambahkan CSRF token di form
   - Implement authentication middleware

3. **Add Real Functionality**:
   - Form submission ke route Laravel
   - File upload untuk bukti transfer
   - Real-time notification dengan WebSocket
   - Database integration

### Untuk Designer

Jika ingin memodifikasi desain:

1. **Edit CSS Variables** di `styles.css`:
   ```css
   :root {
       --primary: #3B82F6;
       --success: #10B981;
       /* ... */
   }
   ```

2. **Modify Components**:
   - Button styles di section `/* ===== BUTTONS ===== */`
   - Card styles di section `/* ===== CARDS ===== */`
   - Form styles di section `/* ===== FORMS ===== */`

3. **Add New Pages**:
   - Copy struktur dari halaman existing
   - Sesuaikan content
   - Update navigation links

## 📸 Screenshots

### Login Page
- Clean dan modern
- Gradient background
- Centered card layout

### Dashboard Penghuni
- Welcome section dengan gradient
- 4 stats cards
- Recent activities timeline
- Quick action cards

### Dashboard Pemilik
- Statistics overview
- Charts dan graphs
- Recent activities
- Management tools

## 🎓 Untuk Mahasiswa

Prototype ini dapat digunakan sebagai:

1. **Referensi UI/UX**: Lihat implementasi desain yang sudah dibuat
2. **Template Projek**: Copy dan modifikasi untuk projek sendiri
3. **Learning Material**: Pelajari HTML/CSS/JS best practices
4. **Presentasi**: Demo prototype ke dosen atau klien

## 📝 TODO (Halaman yang Bisa Ditambahkan)

- [ ] profile-penghuni.html (Edit profile, change password)
- [ ] kelola-kamar.html (CRUD kamar untuk pemilik)
- [ ] kelola-penghuni.html (Manage penghuni untuk pemilik)
- [ ] kelola-komplain.html (Manage komplain untuk pemilik)
- [ ] laporan.html (Laporan keuangan untuk pemilik)
- [ ] register.html (Form registrasi penghuni baru)

**Note:** 8 halaman utama sudah dibuat dan fully functional untuk demo!

## 🤝 Kontribusi

Jika ingin menambahkan halaman atau fitur:

1. Ikuti struktur HTML yang sudah ada
2. Gunakan CSS classes yang sudah didefinisikan
3. Maintain consistency dengan design system
4. Test di multiple browsers
5. Ensure responsive design

## 📞 Support

Untuk pertanyaan atau bantuan:
- Baca dokumentasi di `BAB_3_UIUX.md`
- Lihat wireframe dan mockup di dokumentasi
- Check style guide untuk design guidelines

---

**© 2024 KostKu - Sistem Manajemen Kost**

**Status**: Prototype HTML - Work in Progress

**Version**: 1.0.0

**Last Updated**: Januari 2024
