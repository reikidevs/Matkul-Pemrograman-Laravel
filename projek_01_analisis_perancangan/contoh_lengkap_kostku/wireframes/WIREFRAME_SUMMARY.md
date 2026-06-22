# Wireframe Summary - Sistem KostKu

## 📋 Overview

Dokumen ini merangkum wireframe yang telah dibuat untuk sistem KostKu. Wireframe adalah kerangka dasar yang menunjukkan layout dan struktur halaman tanpa detail visual, fokus pada penempatan elemen dan alur navigasi.

---

## 🎨 Karakteristik Wireframe

### Visual Style
- **Color Scheme**: Grayscale (hitam, putih, abu-abu)
- **Typography**: Arial/Sans-serif, ukuran standar
- **Borders**: Solid 2px untuk struktur utama
- **Spacing**: Konsisten menggunakan sistem 8px base unit

### Design Principles
1. **Simplicity**: Fokus pada struktur, bukan detail visual
2. **Clarity**: Layout yang jelas dan mudah dipahami
3. **Consistency**: Pola layout yang konsisten antar halaman
4. **Functionality**: Menunjukkan alur interaksi pengguna

---

## 📱 Daftar Wireframe

### 1. Halaman Login

**File:**
- PlantUML: `plantuml/login.puml`
- HTML: `html/login.html`

**Elemen Utama:**
- Logo KostKu di bagian atas
- Form login (email, password)
- Checkbox "Ingat Saya"
- Link "Lupa Password" dan "Daftar"
- Footer copyright

**Layout:**
- Centered layout dengan card
- Background subtle
- Form width: 400px (desktop)

**Navigasi:**
- Login berhasil → Dashboard (sesuai role)
- Link "Daftar" → Halaman Registrasi
- Link "Lupa Password" → Reset Password

---

### 2. Dashboard Penghuni

**File:**
- PlantUML: `plantuml/dashboard-penghuni.puml`
- HTML: `html/dashboard-penghuni.html`

**Elemen Utama:**
- Header dengan logo, menu, dan profile dropdown
- Sidebar navigasi (Dashboard, Kamar, Pembayaran, Komplain, Profile)
- Welcome section dengan info penghuni
- Quick stats (4 cards): Kamar, Status, Tagihan, Komplain
- Recent activities list
- Pengumuman section

**Layout:**
- Header: Fixed top, full width
- Sidebar: 250px width (desktop), overlay (mobile)
- Content: Flex-grow, padding 30px
- Grid: 4 columns untuk stats cards

**Interaksi:**
- Sidebar menu untuk navigasi
- Profile dropdown untuk logout
- Click pada stats untuk detail

---

### 3. Halaman Pembayaran

**File:**
- PlantUML: `plantuml/pembayaran.puml`
- HTML: `html/pembayaran.html`

**Elemen Utama:**
- Page header dengan breadcrumb
- Tagihan belum dibayar (highlighted)
- Tombol "Bayar Sekarang"
- Riwayat pembayaran (table)
- Modal upload bukti transfer

**Layout:**
- Same header & sidebar structure
- Tagihan card dengan border merah (overdue)
- Table responsive untuk riwayat
- Modal centered overlay

**Interaksi:**
- Click "Bayar" → Modal upload
- Upload file → Preview
- Submit → Success notification
- Download kwitansi untuk pembayaran lunas

---

### 4. Halaman Komplain

**File:**
- PlantUML: `plantuml/komplain.puml`
- HTML: `html/komplain.html`

**Elemen Utama:**
- Button "Ajukan Komplain Baru" (top right)
- Filter dan search box
- List komplain dengan:
  - Nomor tiket
  - Judul
  - Status badge
  - Prioritas (border color)
  - Tanggal
- Modal form komplain baru

**Layout:**
- Same header & sidebar
- Filter bar di atas list
- Komplain cards dengan border-left color coding:
  - Urgent: Red (#c00)
  - Medium: Orange (#999)
  - Low: Gray (#666)

**Interaksi:**
- Click "Ajukan Komplain" → Modal form
- Fill form → Submit → Success
- Click komplain → Detail view
- Filter by status

---

### 5. Dashboard Pemilik

**File:**
- PlantUML: `plantuml/dashboard-pemilik.puml`
- HTML: `html/dashboard-pemilik.html`

**Elemen Utama:**
- Header dengan notification badge
- Sidebar dengan badge count
- Statistics cards (4): Total Kamar, Terisi, Pendapatan, Komplain
- Two-column layout:
  - Left: Recent activities
  - Right: Pembayaran pending
- Chart area untuk pendapatan bulanan

**Layout:**
- Same structure dengan dashboard penghuni
- Stats cards dengan larger numbers
- Grid 2 columns untuk activities & pending
- Chart placeholder full width

**Interaksi:**
- Notification badge → Navigate to section
- Click pending payment → Detail modal
- Chart interactive (hover, tooltip)

---

### 6. Konfirmasi Pembayaran (Pemilik)

**File:**
- PlantUML: `plantuml/konfirmasi-pembayaran.puml`
- HTML: `html/konfirmasi-pembayaran.html`

**Elemen Utama:**
- Tabs: Pending, Approved, Rejected
- Table pembayaran pending
- Modal detail dengan:
  - Left: Bukti transfer image
  - Right: Info pembayaran & actions
- Buttons: Approve (green), Reject (red)

**Layout:**
- Tabs navigation
- Table responsive
- Large modal (800px) dengan 2 columns
- Image viewer dengan zoom

**Interaksi:**
- Click "Lihat Detail" → Modal
- View image → Zoom functionality
- Approve → Confirmation → Update status
- Reject → Input reason → Update status

---

## 🎯 Layout Patterns

### Header Pattern
```
+--------------------------------------------------+
| [Logo]  [Menu Items...]         [User Profile ▼] |
+--------------------------------------------------+
```

### Sidebar + Content Pattern
```
+----------+---------------------------------------+
| Sidebar  | Content Area                         |
| Menu     | - Page Header                        |
| Items    | - Main Content                       |
|          | - Cards/Tables                       |
+----------+---------------------------------------+
```

### Card Pattern
```
+------------------------------------------+
| Card Header                              |
+------------------------------------------+
| Card Body                                |
| - Content                                |
| - Elements                               |
+------------------------------------------+
```

### Modal Pattern
```
+------------------------------------------+
| Modal Header                      [X]    |
+------------------------------------------+
| Modal Body                               |
| - Form/Content                           |
+------------------------------------------+
| [Cancel]                    [Submit]     |
+------------------------------------------+
```

---

## 📐 Grid System

### Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

### Container
- Max-width: 1400px
- Margin: Auto center
- Padding: 20px

### Columns
- 12-column grid system
- Gutter: 24px
- Common layouts:
  - 1 column (mobile)
  - 2 columns (tablet)
  - 3-4 columns (desktop)

---

## 🎨 Component Library

### Buttons
- **Primary**: Black background, white text
- **Secondary**: White background, black border
- **Success**: Dark gray background
- **Danger**: Medium gray background
- Height: 44px (touch-friendly)
- Padding: 10px 20px

### Forms
- Input height: 44px
- Border: 2px solid #999
- Focus border: #333
- Label: Bold, 14px
- Spacing: 20px between fields

### Cards
- Background: White
- Border: 2px solid #333
- Border-radius: 0 (sharp corners)
- Padding: 20px
- Shadow: Subtle on hover

### Tables
- Border: 2px solid #333
- Header: Gray background (#e0e0e0)
- Rows: Alternating background
- Cell padding: 12px

### Badges
- Inline-block
- Padding: 4px 12px
- Border: 1px solid
- Font-size: 12px
- Bold text

---

## 🔄 User Flows

### Flow 1: Login → Dashboard
```
[Login Page]
    ↓ (input credentials)
[Validation]
    ↓ (success)
[Dashboard] (role-based)
```

### Flow 2: Pembayaran
```
[Dashboard]
    ↓ (click Pembayaran menu)
[Halaman Pembayaran]
    ↓ (click Bayar)
[Modal Upload]
    ↓ (upload & submit)
[Success Notification]
    ↓ (auto close)
[Updated Pembayaran Page]
```

### Flow 3: Komplain
```
[Dashboard]
    ↓ (click Komplain menu)
[Halaman Komplain]
    ↓ (click Ajukan Komplain)
[Modal Form]
    ↓ (fill & submit)
[Success Notification]
    ↓ (redirect)
[Updated Komplain List]
```

### Flow 4: Konfirmasi Pembayaran (Pemilik)
```
[Dashboard Pemilik]
    ↓ (notification badge)
[Konfirmasi Pembayaran]
    ↓ (click Lihat Detail)
[Modal Detail]
    ↓ (view image & info)
[Approve/Reject]
    ↓ (confirmation)
[Success & Update]
```

---

## 📱 Responsive Behavior

### Mobile (< 768px)
- Sidebar → Overlay drawer (hamburger menu)
- Grid → Single column
- Table → Card layout
- Stats → Stacked vertically
- Modal → Full screen

### Tablet (768px - 1024px)
- Sidebar → Visible
- Grid → 2 columns
- Table → Scrollable
- Stats → 2x2 grid

### Desktop (> 1024px)
- Full layout
- Multi-column grids
- Hover states
- Tooltips visible

---

## 🎯 Accessibility Features

### Keyboard Navigation
- Tab order logical
- Focus indicators visible
- Keyboard shortcuts for main actions

### Screen Reader
- Alt text for images
- ARIA labels for interactive elements
- Semantic HTML structure

### Visual
- High contrast (black on white)
- Clear borders and spacing
- Large touch targets (44px min)

---

## 📊 Wireframe vs Mockup vs Prototype

### Wireframe (Current)
- **Focus**: Structure & layout
- **Detail**: Low fidelity
- **Color**: Grayscale
- **Purpose**: Planning & discussion

### Mockup (Next Step)
- **Focus**: Visual design
- **Detail**: High fidelity
- **Color**: Full color palette
- **Purpose**: Design approval

### Prototype (Final)
- **Focus**: Interaction
- **Detail**: High fidelity + interaction
- **Color**: Full color + animations
- **Purpose**: User testing

---

## 🚀 Next Steps

### 1. Review & Feedback
- [ ] Review wireframes dengan stakeholder
- [ ] Gather feedback on layout
- [ ] Identify missing screens
- [ ] Validate user flows

### 2. Create Mockups
- [ ] Apply style guide (colors, typography)
- [ ] Add visual details
- [ ] Create high-fidelity designs
- [ ] Design icons and illustrations

### 3. Build Prototype
- [ ] Add interactions and animations
- [ ] Create clickable prototype
- [ ] Conduct user testing
- [ ] Iterate based on feedback

### 4. Development Handoff
- [ ] Export assets
- [ ] Document components
- [ ] Provide design specs
- [ ] Support development team

---

## 📚 Tools & Resources

### Design Tools
- **Figma**: Recommended for mockups & prototypes
- **PlantUML**: For diagram-based wireframes
- **HTML/CSS**: For interactive wireframes

### Icon Libraries
- Heroicons
- Feather Icons
- Font Awesome

### CSS Frameworks
- Tailwind CSS (recommended)
- Bootstrap
- Custom CSS

### Chart Libraries
- Chart.js
- Recharts
- ApexCharts

---

## 📝 Notes

### Design Decisions
1. **Grayscale**: Fokus pada struktur, bukan warna
2. **Sharp Corners**: Memberikan kesan profesional
3. **Bold Borders**: Memperjelas struktur layout
4. **Consistent Spacing**: Menggunakan 8px base unit
5. **Touch-Friendly**: Minimum 44px untuk interactive elements

### Assumptions
- Users familiar dengan web applications
- Desktop-first approach (responsive untuk mobile)
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Internet connection available

### Constraints
- Budget: Limited (open-source tools preferred)
- Timeline: 2 weeks for wireframes
- Team: 1 designer, 2 developers
- Technology: Laravel + Blade templates

---

## 📞 Contact & Support

**Project**: Sistem KostKu  
**Course**: PBKK (Pemrograman Berbasis Kerangka Kerja)  
**Institution**: Universitas Semarang  
**Instructor**: Ahmad Rifa'i, S.Kom., M.Kom.

**Documentation**:
- [BAB_3_UIUX.md](../BAB_3_UIUX.md) - Full UI/UX documentation
- [README.md](README.md) - Wireframe folder overview
- [Prototype HTML](../prototype_html/) - Interactive prototypes

---

**Last Updated**: Januari 2024  
**Version**: 1.0  
**Status**: ✅ Complete
