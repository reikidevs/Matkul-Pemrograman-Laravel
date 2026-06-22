# 🧪 Panduan Testing KostKu

**Status:** ✅ Siap untuk Testing  
**Server:** http://127.0.0.1:8000  
**Database:** kostku_db (MySQL)

---

## 📋 Checklist Testing

### ✅ Wajib di-Test & Screenshot

1. [ ] **Upload Bukti Transfer** (Penghuni)
2. [ ] **View Bukti Transfer** (Pemilik)
3. [ ] **Navbar Dropdowns** (Notification & User Menu)
4. [ ] **Approve/Reject Pembayaran** (Pemilik)
5. [ ] **CRUD Kamar** (Pemilik)
6. [ ] **CRUD Penghuni** (Pemilik)
7. [ ] **Dashboard** (Pemilik & Penghuni)

---

## 🔑 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| **Pemilik Kost** | pemilik@kostku.com | pemilik123 |
| **Penghuni** | ani@test.com | penghuni123 |

---

## 🎯 Test Case 1: Upload Bukti Transfer (Penghuni)

### Langkah-langkah:

1. **Login sebagai Penghuni**
   ```
   Email: ani@test.com
   Password: penghuni123
   ```

2. **Menu: Tagihan Saya**
   - Lihat daftar tagihan
   - Cari tagihan dengan status "Belum Lunas" (badge merah)

3. **Klik tombol "Bayar"**
   - Form pembayaran tampil

4. **Isi Form:**
   - Jumlah Bayar: (sudah otomatis terisi)
   - Tanggal Transfer: Pilih tanggal hari ini
   - Metode Pembayaran: Pilih "Transfer Bank" atau "E-Wallet"
   - **Upload Bukti Transfer:** Klik "Choose File"
     - Pilih file: JPG, PNG, atau PDF
     - Max 2MB
   - Catatan: (opsional) "Transfer dari BCA a.n. Ani Lestari"

5. **Preview Image**
   - Setelah pilih file, preview muncul otomatis
   - Jika tidak sesuai, klik tombol "X" untuk hapus dan upload ulang

6. **Klik "Submit Pembayaran"**
   - Success message muncul: "Pembayaran berhasil disubmit"
   - Redirect ke halaman Tagihan
   - Status berubah: "Pending" (badge kuning)

### 📸 Screenshot yang Diperlukan:
- [ ] Form bayar dengan upload file
- [ ] Preview image setelah upload
- [ ] Success message
- [ ] Status "Pending" di list tagihan

---

## 🎯 Test Case 2: View Bukti Transfer (Pemilik)

### Langkah-langkah:

1. **Logout dari akun Penghuni**
   - Klik user avatar → Logout

2. **Login sebagai Pemilik**
   ```
   Email: pemilik@kostku.com
   Password: pemilik123
   ```

3. **Menu: Konfirmasi Pembayaran**
   - Lihat daftar pembayaran
   - Cari pembayaran dengan status "Pending" (badge kuning)

4. **Klik tombol "Lihat Bukti"**
   - Modal fullscreen tampil
   - Bukti transfer tampil dengan jelas
   - Bisa zoom in dengan right click → Open Image in New Tab

5. **Review Bukti Transfer**
   - Cek nominal transfer
   - Cek tanggal transfer
   - Cek nama pengirim (jika ada)

6. **Verifikasi di Mobile Banking** (Simulasi)
   - Cek apakah transfer benar masuk ke rekening
   - Cocokkan nominal

7. **Keputusan:**

   **Jika VALID (Transfer Sesuai):**
   - Klik tombol "X" untuk tutup modal
   - Klik tombol "Approve"
   - Konfirmasi approval
   - Success message: "Pembayaran berhasil disetujui"
   - Status berubah: "Approved" (badge hijau)

   **Jika TIDAK VALID (Transfer Tidak Sesuai):**
   - Klik tombol "X" untuk tutup modal
   - Klik tombol "Reject"
   - Modal reject muncul
   - Isi alasan: "Nominal transfer kurang Rp 50.000"
   - Klik "Tolak Pembayaran"
   - Success message: "Pembayaran ditolak"
   - Status berubah: "Rejected" (badge merah)

### 📸 Screenshot yang Diperlukan:
- [ ] Tabel pembayaran dengan tombol "Lihat Bukti"
- [ ] Modal fullscreen dengan bukti transfer
- [ ] Modal reject dengan form alasan
- [ ] Status "Approved" atau "Rejected"

---

## 🎯 Test Case 3: Navbar Dropdowns

### Langkah-langkah:

1. **Login dengan user apapun**

2. **Test Notification Dropdown:**
   - Klik icon bell (🔔) di header kanan atas
   - Dropdown notification muncul dengan smooth animation
   - Isi: "Tidak ada notifikasi baru"
   - Klik di luar dropdown → Dropdown tertutup otomatis

3. **Test User Menu Dropdown:**
   - Klik user avatar + nama di header kanan atas
   - Dropdown user menu muncul
   - Notification dropdown otomatis tertutup
   - Menu:
     - Profil Saya (👤)
     - Ubah Password (🔒)
     - Logout (🚪)

4. **Test Navigation:**
   - Klik "Profil Saya" → Navigate ke halaman profil
   - Back ke dashboard

5. **Test Outside Click:**
   - Buka dropdown apapun
   - Klik di area content (di luar dropdown)
   - Dropdown tertutup otomatis

6. **Test Escape Key:**
   - Buka dropdown apapun
   - Tekan tombol Escape
   - Dropdown tertutup otomatis

### 📸 Screenshot yang Diperlukan:
- [ ] Notification dropdown open
- [ ] User menu dropdown open
- [ ] Halaman profil

---

## 🎯 Test Case 4: CRUD Kamar (Pemilik)

### Langkah-langkah:

1. **Login sebagai Pemilik**

2. **Menu: Kelola Kamar**

3. **Test List Kamar:**
   - Lihat daftar kamar
   - Filter by status: Semua / Tersedia / Terisi / Maintenance

4. **Test Tambah Kamar:**
   - Klik "Tambah Kamar"
   - Isi form:
     - Nomor Kamar: K-301
     - Tipe: Standard
     - Harga: 1500000
     - Luas: 3x4 m
     - Fasilitas: Kasur, lemari, AC, Wi-Fi
     - Status: Tersedia
   - Klik "Simpan"
   - Success message muncul
   - Kamar baru muncul di list

5. **Test Edit Kamar:**
   - Klik "Edit" pada kamar
   - Ubah harga: 1600000
   - Klik "Update"
   - Success message muncul

6. **Test Hapus Kamar:**
   - Klik "Hapus" pada kamar
   - Konfirmasi hapus
   - Success message: "Kamar berhasil dihapus"
   - Kamar hilang dari list

### 📸 Screenshot yang Diperlukan:
- [ ] List kamar dengan filter
- [ ] Form tambah kamar
- [ ] Form edit kamar
- [ ] Konfirmasi hapus

---

## 🎯 Test Case 5: Dashboard

### Pemilik Dashboard:

1. **Login sebagai Pemilik**
2. **Dashboard tampil:**
   - Card statistik:
     - Total Kamar
     - Total Penghuni
     - Tingkat Hunian (%)
     - Pendapatan Bulan Ini
   - Alert pembayaran pending (jika ada)
   - Alert komplain open (jika ada)

### Penghuni Dashboard:

1. **Login sebagai Penghuni**
2. **Dashboard tampil:**
   - Card info kamar:
     - Nomor Kamar
     - Tipe Kamar
     - Harga Sewa
     - Tanggal Masuk
   - Info tagihan terbaru
   - Info komplain aktif

### 📸 Screenshot yang Diperlukan:
- [ ] Dashboard Pemilik (dengan statistik)
- [ ] Dashboard Penghuni (dengan info kamar)

---

## 🎯 Test Case 6: Profil Management

### Langkah-langkah:

1. **Login dengan user apapun**

2. **Menu: Profil Saya** (atau klik avatar → Profil Saya)

3. **Test View Profil:**
   - Lihat data profil lengkap

4. **Test Edit Profil:**
   - Klik "Edit Profil"
   - Ubah nama: Ani Lestari (Updated)
   - Ubah nomor HP: 081234567890
   - Klik "Simpan"
   - Success message: "Profil berhasil diperbarui"

5. **Test Change Password:**
   - Klik tab "Ubah Password"
   - Isi form:
     - Password Lama: penghuni123
     - Password Baru: penghuni456
     - Konfirmasi Password: penghuni456
   - Klik "Ubah Password"
   - Success message: "Password berhasil diubah"
   - Logout & login dengan password baru

### 📸 Screenshot yang Diperlukan:
- [ ] Halaman view profil
- [ ] Form edit profil
- [ ] Form change password
- [ ] Success message

---

## 🎯 Test Case 7: Komplain (Penghuni)

### Langkah-langkah:

1. **Login sebagai Penghuni**

2. **Menu: Komplain**

3. **Test List Komplain:**
   - Lihat daftar komplain yang pernah diajukan

4. **Test Ajukan Komplain Baru:**
   - Klik "Ajukan Komplain"
   - Isi form:
     - Kategori: Pilih "Fasilitas"
     - Judul: AC Tidak Dingin
     - Deskripsi: AC di kamar tidak dingin sejak 2 hari yang lalu
     - Upload Foto: (opsional) Upload foto AC
   - Klik "Ajukan Komplain"
   - Success message: "Komplain berhasil diajukan"
   - Komplain baru muncul dengan status "Open"

### 📸 Screenshot yang Diperlukan:
- [ ] List komplain
- [ ] Form ajukan komplain
- [ ] Komplain baru dengan status "Open"

---

## 📊 Informasi Tambahan untuk Testing

### Rekening Transfer (untuk simulasi):

**Bank Transfer:**
- **BCA:** 1234567890 a.n. PT Kost Sejahtera
- **Mandiri:** 9876543210 a.n. PT Kost Sejahtera
- **BNI:** 5555666677 a.n. PT Kost Sejahtera

**E-Wallet:**
- **GoPay/OVO/Dana:** 081234567890

### Sample File untuk Upload:

1. **Bukti Transfer:** Screenshot/foto transfer bank (JPG/PNG)
2. **Format:** JPG, PNG, atau PDF
3. **Max Size:** 2MB
4. **Recommendation:** Gunakan screenshot asli dari mobile banking untuk realistis

---

## ⚠️ Catatan Penting

### Jika Upload File Error:

```bash
# Jalankan command ini di terminal:
cd projek_02_implementasi/kostku_laravel
php artisan storage:link
```

### Jika Server Mati:

```bash
php artisan serve
```

### Jika Data Hilang/Corrupt:

```bash
# Reset database dengan data fresh:
php artisan migrate:fresh --seed
```

---

## 📸 Lokasi Menyimpan Screenshot

Simpan semua screenshot di:
```
projek_02_implementasi/docs/screenshots/
```

Penamaan file:
- `01-penghuni-dashboard.png`
- `02-form-bayar-tagihan.png`
- `03-preview-upload-bukti.png`
- `04-pemilik-view-bukti-modal.png`
- `05-notification-dropdown.png`
- `06-user-menu-dropdown.png`
- dst...

---

## ✅ Checklist Akhir

Sebelum submit tugas, pastikan sudah:

- [ ] Test semua fitur berfungsi dengan baik
- [ ] Screenshot semua halaman penting
- [ ] Screenshot fitur baru (upload, view bukti, dropdowns)
- [ ] Dokumentasi lengkap tersedia
- [ ] Database seeded dengan data lengkap
- [ ] Server berjalan tanpa error

---

**Selamat Testing!** 🚀

**Jika ada pertanyaan atau error, cek dokumentasi:**
- [README.md](README.md)
- [docs/PAYMENT_FLOW_IMPLEMENTATION.md](docs/PAYMENT_FLOW_IMPLEMENTATION.md)
- [docs/NAVBAR_DROPDOWNS.md](docs/NAVBAR_DROPDOWNS.md)
