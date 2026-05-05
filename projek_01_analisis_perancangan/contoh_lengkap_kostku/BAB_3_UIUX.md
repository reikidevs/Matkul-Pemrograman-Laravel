# BAB 3: UI/UX DESIGN

## Pendahuluan

BAB 3 ini membahas desain antarmuka pengguna (UI) dan pengalaman pengguna (UX) untuk sistem KostKu. Desain UI/UX yang baik sangat penting untuk memastikan aplikasi mudah digunakan, menarik, dan memberikan pengalaman yang memuaskan bagi pengguna.

Dalam BAB ini, kami menyajikan:

1. **Style Guide** - Panduan gaya visual aplikasi
2. **Wireframe** - Kerangka dasar layout halaman
3. **Mockup** - Desain visual detail
4. **Prototype** - Simulasi interaksi pengguna

---

## 3.1 Style Guide

Style Guide adalah panduan visual yang mendefinisikan elemen-elemen desain yang akan digunakan secara konsisten di seluruh aplikasi KostKu.

### 3.1.1 Color Palette (Palet Warna)

**Primary Colors (Warna Utama):**

- **Primary Blue**: #3B82F6
  - Penggunaan: Header, tombol utama, link aktif
  - Makna: Kepercayaan, profesional, teknologi

- **Secondary Slate**: #64748B
  - Penggunaan: Teks sekunder, border, icon
  - Makna: Netral, elegan, modern

**Functional Colors (Warna Fungsional):**

- **Success Green**: #10B981
  - Penggunaan: Status berhasil, notifikasi positif
  - Contoh: "Pembayaran berhasil", "Komplain resolved"

- **Warning Orange**: #F59E0B
  - Penggunaan: Peringatan, status pending
  - Contoh: "Menunggu konfirmasi", "Jatuh tempo besok"

- **Danger Red**: #EF4444
  - Penggunaan: Error, status ditolak, hapus
  - Contoh: "Pembayaran ditolak", "Komplain urgent"

- **Info Cyan**: #06B6D4
  - Penggunaan: Informasi, tips, bantuan
  - Contoh: Tooltip, info kamar

**Neutral Colors (Warna Netral):**

- **White**: #FFFFFF - Background utama
- **Gray 50**: #F9FAFB - Background sekunder
- **Gray 100**: #F3F4F6 - Background card
- **Gray 200**: #E5E7EB - Border
- **Gray 500**: #6B7280 - Teks sekunder
- **Gray 900**: #111827 - Teks utama

### 3.1.2 Typography (Tipografi)

**Font Family:**

- **Primary Font**: "Inter" - Font utama untuk body text
  - Karakteristik: Modern, readable, web-friendly
  - Penggunaan: Paragraf, form input, tabel

- **Heading Font**: "Poppins" - Font untuk heading
  - Karakteristik: Bold, friendly, attention-grabbing
  - Penggunaan: Judul halaman, card title, button text

**Font Sizes:**

- **H1**: 32px (2rem) - Judul halaman utama
- **H2**: 24px (1.5rem) - Judul section
- **H3**: 20px (1.25rem) - Judul card/komponen
- **H4**: 18px (1.125rem) - Sub-judul
- **Body Large**: 16px (1rem) - Teks utama
- **Body**: 14px (0.875rem) - Teks sekunder
- **Small**: 12px (0.75rem) - Caption, label kecil

**Font Weights:**

- **Light**: 300 - Teks ringan (jarang digunakan)
- **Regular**: 400 - Teks normal
- **Medium**: 500 - Teks penting
- **Semibold**: 600 - Sub-heading
- **Bold**: 700 - Heading, button

### 3.1.3 Spacing (Jarak)

Menggunakan sistem spacing 8px sebagai base unit:

- **xs**: 4px (0.25rem) - Jarak sangat kecil
- **sm**: 8px (0.5rem) - Jarak kecil
- **md**: 16px (1rem) - Jarak standar
- **lg**: 24px (1.5rem) - Jarak besar
- **xl**: 32px (2rem) - Jarak sangat besar
- **2xl**: 48px (3rem) - Jarak extra besar

### 3.1.4 Components (Komponen)

**Buttons (Tombol):**

- **Primary Button**: Background #3B82F6, text white, rounded 8px
- **Secondary Button**: Border #3B82F6, text #3B82F6, background white
- **Danger Button**: Background #EF4444, text white
- **Success Button**: Background #10B981, text white

**Cards:**

- Background: White
- Border: 1px solid #E5E7EB
- Border radius: 12px
- Shadow: 0 1px 3px rgba(0,0,0,0.1)
- Padding: 24px

**Forms:**

- Input height: 44px
- Border: 1px solid #D1D5DB
- Border radius: 8px
- Focus border: #3B82F6
- Padding: 12px 16px

---

## 3.2 Wireframe

Wireframe adalah kerangka dasar yang menunjukkan layout dan struktur halaman tanpa detail visual. Wireframe fokus pada penempatan elemen dan alur navigasi.

### 3.2.1 Halaman Login

**Layout Structure:**

```
+----------------------------------+
|            HEADER                |
|         [LOGO KOSTKU]            |
+----------------------------------+
|                                  |
|        LOGIN FORM                |
|    +------------------------+    |
|    |     Email Address      |    |
|    +------------------------+    |
|    |      Password          |    |
|    +------------------------+    |
|    |    [LOGIN BUTTON]      |    |
|    +------------------------+    |
|    |   Forgot Password?     |    |
|    |   Register Here        |    |
|    +------------------------+    |
|                                  |
+----------------------------------+
|            FOOTER                |
+----------------------------------+
```

**Elemen Utama:**
- Logo KostKu di bagian atas
- Form login di tengah halaman
- Link "Lupa Password" dan "Daftar"
- Background dengan gambar kost (subtle)

**Navigasi:**
- Setelah login berhasil → Dashboard sesuai role
- Link "Daftar" → Halaman Registrasi
- Link "Lupa Password" → Halaman Reset Password

---

### 3.2.2 Dashboard Penghuni

**Layout Structure:**

```
+----------------------------------+
|  HEADER: Logo | Menu | Profile    |
+----------------------------------+
|  SIDEBAR  |    MAIN CONTENT      |
|           |                      |
| - Dashboard|  WELCOME SECTION     |
| - Kamar    |  +----------------+  |
| - Tagihan  |  | Selamat datang |  |
| - Bayar    |  | Ahmad Rizki    |  |
| - Komplain |  +----------------+  |
| - Profile  |                      |
|           |  QUICK STATS         |
|           |  +------+------+     |
|           |  |Kamar |Status|     |
|           |  | 201  |Aktif |     |
|           |  +------+------+     |
|           |                      |
|           |  RECENT ACTIVITIES   |
|           |  +----------------+  |
|           |  | Pembayaran Jan |  |
|           |  | Komplain AC    |  |
|           |  +----------------+  |
+----------------------------------+
```

**Elemen Utama:**
- Header dengan logo, menu, dan profil pengguna
- Sidebar navigasi di kiri
- Area konten utama dengan widget informasi
- Quick stats menampilkan info kamar dan status
- Recent activities menampilkan aktivitas terbaru

**Navigasi:**
- Sidebar menu untuk akses fitur utama
- Profile dropdown untuk logout dan edit profil
- Quick action buttons untuk fitur sering digunakan

---

### 3.2.3 Halaman Pembayaran

**Layout Structure:**

```
+----------------------------------+
|  HEADER: Logo | Menu | Profile    |
+----------------------------------+
|  SIDEBAR  |    MAIN CONTENT      |
|           |                      |
|           |  PAGE TITLE          |
|           |  "Pembayaran Sewa"   |
|           |                      |
|           |  TAGIHAN LIST        |
|           |  +----------------+  |
|           |  | Jan 2024       |  |
|           |  | Rp 1.500.000   |  |
|           |  | Jatuh tempo:   |  |
|           |  | 10 Jan 2024    |  |
|           |  | [BAYAR BUTTON] |  |
|           |  +----------------+  |
|           |                      |
|           |  RIWAYAT PEMBAYARAN  |
|           |  +----------------+  |
|           |  | Des 2023 - Lunas| |
|           |  | Nov 2023 - Lunas| |
|           |  +----------------+  |
+----------------------------------+
```

**Elemen Utama:**
- List tagihan yang belum dibayar
- Informasi detail setiap tagihan (periode, jumlah, jatuh tempo)
- Tombol "Bayar" untuk setiap tagihan
- Riwayat pembayaran sebelumnya
- Status pembayaran (Lunas, Pending, Ditolak)

**Interaksi:**
- Klik "Bayar" → Modal upload bukti transfer
- Filter riwayat berdasarkan periode
- Download kwitansi untuk pembayaran yang sudah lunas

---

### 3.2.4 Halaman Komplain

**Layout Structure:**

```
+----------------------------------+
|  HEADER: Logo | Menu | Profile    |
+----------------------------------+
|  SIDEBAR  |    MAIN CONTENT      |
|           |                      |
|           |  PAGE TITLE          |
|           |  "Komplain"          |
|           |  [+ AJUKAN KOMPLAIN] |
|           |                      |
|           |  KOMPLAIN LIST       |
|           |  +----------------+  |
|           |  | #KMP-001       |  |
|           |  | AC Tidak Dingin|  |
|           |  | Status: Open   |  |
|           |  | 5 Jan 2024     |  |
|           |  +----------------+  |
|           |  +----------------+  |
|           |  | #KMP-002       |  |
|           |  | Kamar Mandi    |  |
|           |  | Status: Resolved|  |
|           |  | 3 Jan 2024     |  |
|           |  +----------------+  |
+----------------------------------+
```

**Elemen Utama:**
- Tombol "Ajukan Komplain" di bagian atas
- List komplain dengan nomor tiket, judul, status, tanggal
- Filter berdasarkan status (Open, In Progress, Resolved, Closed)
- Search box untuk cari komplain

**Interaksi:**
- Klik "Ajukan Komplain" → Form komplain baru
- Klik komplain → Detail komplain dan chat
- Filter dan search untuk navigasi

---

### 3.2.5 Dashboard Pemilik Kost

**Layout Structure:**

```
+----------------------------------+
|  HEADER: Logo | Menu | Profile    |
+----------------------------------+
|  SIDEBAR  |    MAIN CONTENT      |
|           |                      |
| - Dashboard|  STATISTICS CARDS    |
| - Kamar    |  +----+----+----+   |
| - Penghuni |  |Total|Occu|Pend|   |
| - Pembayaran| |Kamar|pied|apat|   |
| - Komplain |  | 20  | 18 |5.4M|   |
| - Laporan  |  +----+----+----+   |
|           |                      |
|           |  RECENT ACTIVITIES   |
|           |  +----------------+  |
|           |  | Pembayaran baru|  |
|           |  | Komplain urgent|  |
|           |  | Penghuni baru  |  |
|           |  +----------------+  |
|           |                      |
|           |  CHARTS              |
|           |  +----------------+  |
|           |  | Pendapatan     |  |
|           |  | Bulanan        |  |
|           |  +----------------+  |
+----------------------------------+
```

**Elemen Utama:**
- Statistics cards menampilkan KPI utama
- Recent activities untuk monitoring real-time
- Charts untuk visualisasi data
- Quick actions untuk tugas harian

**Navigasi:**
- Sidebar untuk akses semua fitur manajemen
- Notification badge untuk alert penting
- Quick filters untuk data dashboard

---

### 3.2.6 Halaman Konfirmasi Pembayaran (Pemilik)

**Layout Structure:**

```
+----------------------------------+
|  HEADER: Logo | Menu | Profile    |
+----------------------------------+
|  SIDEBAR  |    MAIN CONTENT      |
|           |                      |
|           |  PAGE TITLE          |
|           |  "Konfirmasi Pembayaran"|
|           |                      |
|           |  PENDING LIST        |
|           |  +----------------+  |
|           |  | Ahmad Rizki    |  |
|           |  | Kamar 201      |  |
|           |  | Rp 1.500.000   |  |
|           |  | 5 Jan 2024     |  |
|           |  | [LIHAT DETAIL] |  |
|           |  +----------------+  |
|           |                      |
|           |  DETAIL MODAL        |
|           |  +----------------+  |
|           |  | Bukti Transfer |  |
|           |  | [IMAGE]        |  |
|           |  | [APPROVE]      |  |
|           |  | [REJECT]       |  |
|           |  +----------------+  |
+----------------------------------+
```

**Elemen Utama:**
- List pembayaran yang menunggu konfirmasi
- Detail pembayaran dengan bukti transfer
- Tombol Approve dan Reject
- History konfirmasi sebelumnya

**Interaksi:**
- Klik "Lihat Detail" → Modal dengan bukti transfer
- Approve → Update status dan kirim notifikasi
- Reject → Form alasan penolakan

---

## 3.3 Mockup

Mockup adalah desain visual detail yang menunjukkan tampilan akhir aplikasi dengan warna, typography, dan elemen visual yang sebenarnya.

### 3.3.1 Mockup Halaman Login

**Visual Design:**

- **Background**: Gradient dari #3B82F6 ke #1E40AF dengan overlay gambar kost
- **Login Card**: 
  - Background: White dengan shadow halus
  - Border radius: 16px
  - Width: 400px, centered
  - Padding: 40px

- **Logo**: 
  - "KostKu" dengan font Poppins Bold 28px
  - Color: #3B82F6
  - Icon rumah di sebelah kiri

- **Form Elements**:
  - Input fields: Height 48px, border #E5E7EB, focus border #3B82F6
  - Labels: Font Inter Medium 14px, color #374151
  - Login button: Background #3B82F6, text white, height 48px, full width

- **Links**:
  - "Lupa Password?": Color #3B82F6, font size 14px
  - "Belum punya akun? Daftar di sini": Color #6B7280, font size 14px

**Responsive Design**:
- Mobile: Card width 90%, padding 24px
- Tablet: Card width 500px
- Desktop: Card width 400px

---

### 3.3.2 Mockup Dashboard Penghuni

**Header Design**:
- Background: White dengan border bottom #E5E7EB
- Height: 64px
- Logo di kiri, menu hamburger (mobile), profile dropdown di kanan
- Shadow: 0 1px 3px rgba(0,0,0,0.1)

**Sidebar Design**:
- Background: #F9FAFB
- Width: 256px (desktop), overlay (mobile)
- Menu items dengan icon dan text
- Active state: Background #3B82F6, text white

**Main Content**:
- Background: #F9FAFB
- Padding: 24px

**Welcome Section**:
- Background: Linear gradient #3B82F6 to #1E40AF
- Text: White
- Border radius: 12px
- Padding: 32px
- "Selamat datang, Ahmad Rizki" - Font Poppins Semibold 24px

**Stats Cards**:
- Background: White
- Border radius: 12px
- Shadow: 0 1px 3px rgba(0,0,0,0.1)
- Padding: 24px
- Grid layout: 2 columns (mobile), 4 columns (desktop)

**Recent Activities**:
- Background: White card
- List items dengan icon, title, dan timestamp
- Hover effect: Background #F3F4F6

---

### 3.3.3 Mockup Halaman Pembayaran

**Page Header**:
- Title: "Pembayaran Sewa" - Font Poppins Semibold 28px
- Breadcrumb: Dashboard > Pembayaran

**Tagihan Cards**:
- Background: White
- Border: 1px solid #E5E7EB (default), #F59E0B (jatuh tempo), #EF4444 (overdue)
- Border radius: 12px
- Padding: 24px

**Tagihan Content**:
- Periode: Font Poppins Medium 18px
- Jumlah: Font Inter Bold 24px, color #111827
- Jatuh tempo: Font Inter Regular 14px, color #6B7280
- Status badge dengan warna sesuai status

**Bayar Button**:
- Background: #3B82F6
- Text: White, font Poppins Medium 16px
- Height: 44px
- Border radius: 8px
- Full width pada mobile

**Upload Modal**:
- Overlay: rgba(0,0,0,0.5)
- Modal: White, border radius 16px, max-width 500px
- Drag & drop area dengan border dashed #D1D5DB
- Preview image setelah upload

---

### 3.3.4 Mockup Halaman Komplain

**Add Komplain Button**:
- Background: #10B981
- Icon: Plus
- Text: "Ajukan Komplain Baru"
- Position: Top right

**Komplain Cards**:
- Background: White
- Border left: 4px solid (color sesuai prioritas)
  - Low: #6B7280
  - Medium: #F59E0B  
  - High: #EF4444
  - Urgent: #DC2626 dengan animasi pulse

**Komplain Content**:
- Nomor tiket: Font Inter Medium 14px, color #6B7280
- Judul: Font Poppins Medium 16px, color #111827
- Status badge dengan background color sesuai status
- Tanggal: Font Inter Regular 12px, color #9CA3AF

**Status Colors**:
- Open: #3B82F6
- In Progress: #F59E0B
- Resolved: #10B981
- Closed: #6B7280
- Reopened: #EF4444

---

### 3.3.5 Mockup Dashboard Pemilik

**Statistics Cards**:
- Grid layout: 4 cards
- Background: White dengan gradient accent
- Icon dengan background color sesuai metric
- Number: Font Poppins Bold 32px
- Label: Font Inter Medium 14px

**Chart Section**:
- Background: White card
- Title: "Pendapatan Bulanan"
- Chart: Line chart dengan color #3B82F6
- Responsive: Stacked pada mobile

**Recent Activities**:
- Timeline design dengan line connector
- Icon sesuai jenis aktivitas
- Timestamp relative (2 jam yang lalu)

**Quick Actions**:
- Floating action buttons
- Background: #3B82F6
- Icon: White
- Shadow: 0 4px 12px rgba(59,130,246,0.4)

---

### 3.3.6 Mockup Konfirmasi Pembayaran

**Pending List**:
- Table layout (desktop), card layout (mobile)
- Columns: Penghuni, Kamar, Jumlah, Tanggal, Aksi
- Hover effect pada row
- Badge "NEW" untuk pembayaran baru

**Detail Modal**:
- Large modal: 800px width
- Left side: Bukti transfer image dengan zoom
- Right side: Detail pembayaran dan action buttons
- Approve button: #10B981
- Reject button: #EF4444

**Image Viewer**:
- Full screen overlay
- Zoom in/out controls
- Navigation arrows jika multiple images

---

## 3.4 Prototype

Prototype adalah simulasi interaktif yang menunjukkan bagaimana pengguna berinteraksi dengan aplikasi. Prototype menggabungkan wireframe dan mockup dengan alur navigasi yang dapat diklik.

### 3.4.1 User Flow Penghuni

**Flow 1: Login ke Dashboard**

```
[Login Page] 
    ↓ (input email/password, klik Login)
[Loading State] 
    ↓ (validasi berhasil)
[Dashboard Penghuni]
    ↓ (klik menu Pembayaran)
[Halaman Pembayaran]
```

**Interaksi Detail:**
1. **Login Page**: 
   - Input validation real-time
   - Error message jika kredensial salah
   - Loading spinner saat proses login

2. **Dashboard**: 
   - Animasi fade-in saat load
   - Hover effect pada cards
   - Notification badge jika ada update

3. **Navigation**:
   - Smooth transition antar halaman
   - Breadcrumb untuk orientasi
   - Active state pada menu

---

**Flow 2: Proses Pembayaran**

```
[Halaman Pembayaran]
    ↓ (klik tombol Bayar pada tagihan)
[Modal Upload Bukti]
    ↓ (drag & drop atau browse file)
[Preview & Konfirmasi]
    ↓ (klik Submit)
[Success State]
    ↓ (auto redirect setelah 3 detik)
[Halaman Pembayaran - Updated]
```

**Interaksi Detail:**
1. **Tagihan Card**:
   - Hover effect dengan shadow
   - Disable state jika sudah dibayar
   - Badge status dengan color coding

2. **Upload Modal**:
   - Drag & drop area dengan visual feedback
   - File validation dengan error message
   - Image preview sebelum submit

3. **Success State**:
   - Success animation (checkmark)
   - Auto-close modal dengan countdown
   - Toast notification

---

**Flow 3: Ajukan Komplain**

```
[Halaman Komplain]
    ↓ (klik Ajukan Komplain Baru)
[Form Komplain]
    ↓ (isi form, upload foto)
[Preview Komplain]
    ↓ (klik Submit)
[Success & Redirect]
    ↓ (kembali ke list komplain)
[Halaman Komplain - Updated]
```

**Interaksi Detail:**
1. **Form Komplain**:
   - Multi-step form dengan progress indicator
   - Real-time character count
   - Photo upload dengan preview

2. **Validation**:
   - Field validation saat blur
   - Form validation sebelum submit
   - Error highlighting

3. **Success Flow**:
   - Generate nomor tiket
   - Email confirmation
   - Update list komplain

---

### 3.4.2 User Flow Pemilik Kost

**Flow 1: Dashboard ke Konfirmasi Pembayaran**

```
[Dashboard Pemilik]
    ↓ (lihat notification badge "5 pembayaran pending")
[Halaman Konfirmasi Pembayaran]
    ↓ (klik Lihat Detail pada pembayaran)
[Modal Detail Pembayaran]
    ↓ (klik Approve)
[Konfirmasi Approve]
    ↓ (klik Ya, Approve)
[Success State]
```

**Interaksi Detail:**
1. **Dashboard Notifications**:
   - Real-time update notification badge
   - Hover tooltip dengan preview
   - Click to navigate

2. **Detail Modal**:
   - Image zoom functionality
   - Side-by-side comparison (bukti vs data)
   - Action buttons dengan confirmation

3. **Approve Process**:
   - Confirmation dialog
   - Loading state saat process
   - Success feedback dengan auto-refresh

---

**Flow 2: Kelola Komplain**

```
[Dashboard Pemilik]
    ↓ (klik menu Komplain)
[Halaman Kelola Komplain]
    ↓ (filter by "Urgent")
[List Komplain Urgent]
    ↓ (klik komplain)
[Detail Komplain]
    ↓ (update status ke "In Progress")
[Status Updated]
```

**Interaksi Detail:**
1. **Filter & Search**:
   - Real-time filtering
   - Search dengan debounce
   - Clear filters option

2. **Komplain Management**:
   - Status update dengan dropdown
   - Assign to staff functionality
   - Add notes/comments

3. **Real-time Updates**:
   - WebSocket untuk live updates
   - Notification ke penghuni
   - Activity log

---

### 3.4.3 Responsive Behavior

**Mobile (< 768px)**:
- Sidebar menjadi overlay drawer
- Cards menjadi full-width
- Table menjadi card layout
- Touch-friendly button sizes (min 44px)

**Tablet (768px - 1024px)**:
- Sidebar tetap visible
- Grid layout 2 columns
- Optimized spacing

**Desktop (> 1024px)**:
- Full sidebar navigation
- Multi-column layouts
- Hover states dan tooltips

---

### 3.4.4 Micro-interactions

**Button Interactions**:
- Hover: Scale 1.02, shadow increase
- Active: Scale 0.98
- Loading: Spinner dengan disable state

**Form Interactions**:
- Focus: Border color change, subtle glow
- Error: Shake animation, red border
- Success: Green checkmark animation

**Navigation**:
- Page transitions: Slide atau fade
- Menu hover: Background color change
- Active state: Border atau background highlight

**Notifications**:
- Toast: Slide in from top
- Modal: Fade in dengan backdrop
- Success: Checkmark animation

---

### 3.4.5 Accessibility Features

**Keyboard Navigation**:
- Tab order yang logical
- Focus indicators yang jelas
- Keyboard shortcuts untuk aksi utama

**Screen Reader Support**:
- Alt text untuk images
- ARIA labels untuk interactive elements
- Semantic HTML structure

**Color & Contrast**:
- Minimum contrast ratio 4.5:1
- Color tidak sebagai satu-satunya indikator
- High contrast mode support

---

## Kesimpulan BAB 3

BAB 3 ini telah menyajikan desain UI/UX lengkap untuk sistem KostKu:

1. **Style Guide**: Panduan visual konsisten dengan color palette, typography, dan components
2. **Wireframe**: Struktur layout 6 halaman utama
3. **Mockup**: Desain visual detail dengan implementasi style guide
4. **Prototype**: Simulasi interaksi dan user flow

**Karakteristik Desain:**
- Modern dan clean dengan fokus pada usability
- Responsive design untuk semua device
- Consistent visual language
- Accessibility-friendly
- User-centered design approach

**Manfaat untuk Implementasi:**
- Panduan lengkap untuk developer frontend
- Spesifikasi detail untuk setiap komponen
- User flow yang jelas untuk testing
- Style guide untuk maintenance consistency

**Tools yang Direkomendasikan:**
- **Design**: Figma untuk mockup dan prototype
- **Development**: Tailwind CSS untuk implementasi
- **Icons**: Heroicons atau Feather Icons
- **Charts**: Chart.js atau Recharts
- **Animations**: Framer Motion atau CSS animations

---

**Lanjut ke: Dokumen Final dan Kompilasi**