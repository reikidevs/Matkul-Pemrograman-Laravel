# Wireframes - Sistem KostKu

Folder ini berisi wireframe visual untuk sistem KostKu dalam berbagai format.

## 📁 Struktur File

```
wireframes/
├── README.md                           # File ini
├── plantuml/                           # Wireframe dalam format PlantUML
│   ├── login.puml
│   ├── dashboard-penghuni.puml
│   ├── pembayaran.puml
│   ├── komplain.puml
│   ├── dashboard-pemilik.puml
│   └── konfirmasi-pembayaran.puml
├── html/                               # Wireframe interaktif HTML
│   ├── login.html
│   ├── dashboard-penghuni.html
│   ├── pembayaran.html
│   ├── komplain.html
│   ├── dashboard-pemilik.html
│   └── konfirmasi-pembayaran.html
└── images/                             # Screenshot wireframe (PNG)
    ├── login.png
    ├── dashboard-penghuni.png
    ├── pembayaran.png
    ├── komplain.png
    ├── dashboard-pemilik.png
    └── konfirmasi-pembayaran.png
```

## 🎨 Format Wireframe

### 1. PlantUML Wireframes
- Format: `.puml`
- Kegunaan: Diagram yang bisa di-render menjadi gambar
- Tools: PlantUML, VS Code PlantUML extension
- Cara render: `plantuml wireframe.puml` atau gunakan online editor

### 2. HTML Wireframes
- Format: `.html`
- Kegunaan: Wireframe interaktif yang bisa dibuka di browser
- Fitur: Clickable, responsive preview
- Cara buka: Double-click file HTML atau buka di browser

### 3. Image Wireframes
- Format: `.png`
- Kegunaan: Screenshot untuk dokumentasi
- Resolusi: 1920x1080 (desktop), 375x812 (mobile)

## 📱 Halaman yang Tersedia

### Untuk Penghuni:
1. **Login** - Halaman autentikasi
2. **Dashboard Penghuni** - Overview informasi penghuni
3. **Pembayaran** - Kelola tagihan dan pembayaran
4. **Komplain** - Ajukan dan tracking komplain

### Untuk Pemilik Kost:
1. **Dashboard Pemilik** - Overview statistik dan aktivitas
2. **Konfirmasi Pembayaran** - Approve/reject pembayaran

## 🚀 Cara Menggunakan

### Melihat PlantUML Wireframes:
```bash
# Install PlantUML (jika belum)
npm install -g node-plantuml

# Render wireframe
plantuml wireframes/plantuml/login.puml

# Atau gunakan online editor
# https://www.plantuml.com/plantuml/uml/
```

### Melihat HTML Wireframes:
```bash
# Buka di browser
start wireframes/html/login.html

# Atau gunakan live server
cd wireframes/html
python -m http.server 8080
```

## 📐 Spesifikasi Desain

### Grid System:
- Container: 1200px max-width
- Columns: 12 columns
- Gutter: 24px
- Margin: 16px (mobile), 24px (tablet), 32px (desktop)

### Breakpoints:
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

### Spacing:
- xs: 4px
- sm: 8px
- md: 16px
- lg: 24px
- xl: 32px
- 2xl: 48px

## 🎯 Catatan Penting

1. **Wireframe bukan Mockup**: Wireframe fokus pada struktur dan layout, bukan detail visual
2. **Grayscale**: Wireframe menggunakan warna abu-abu untuk fokus pada struktur
3. **Placeholder**: Text dan image menggunakan placeholder
4. **Interaktif**: HTML wireframe memiliki basic interaction untuk demo flow

## 📚 Referensi

- [BAB_3_UIUX.md](../BAB_3_UIUX.md) - Dokumentasi lengkap UI/UX
- [Style Guide](../BAB_3_UIUX.md#31-style-guide) - Panduan visual
- [Prototype HTML](../prototype_html/) - Prototype dengan styling lengkap

---

**Dibuat untuk**: Projek Analisis & Perancangan - Sistem KostKu  
**Mata Kuliah**: PBKK (Pemrograman Berbasis Kerangka Kerja)  
**Universitas**: Universitas Semarang
