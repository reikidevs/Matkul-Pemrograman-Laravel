# BAB 2: DESAIN UML (Lanjutan)

## 2.3 Sequence Diagram

Sequence Diagram menggambarkan interaksi antar objek dalam sistem berdasarkan urutan waktu. Diagram ini menunjukkan bagaimana objek-objek berkomunikasi satu sama lain melalui message passing untuk menyelesaikan suatu fungsi atau use case tertentu.

Sistem KostKu memiliki 3 (tiga) Sequence Diagram utama yang merepresentasikan skenario interaksi penting:

---

### 2.3.1 Sequence Diagram - Skenario Login Penghuni

**[Gambar 2.5 Sequence Diagram - Skenario Login Penghuni]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_login.puml` dan generate menggunakan PlantUML.

#### Deskripsi Skenario

Skenario ini menggambarkan proses autentikasi ketika penghuni melakukan login ke sistem KostKu. Proses ini melibatkan validasi kredensial, verifikasi password, dan pembuatan session.

#### Aktor dan Objek yang Terlibat

**Aktor:**
- **Penghuni**: User yang akan login ke sistem

**Objek/Komponen:**
- **LoginPage**: Halaman interface login
- **AuthController**: Controller yang menangani autentikasi
- **User**: Model yang merepresentasikan data user
- **Database**: Database sistem
- **Session**: Komponen yang mengelola session user

#### Alur Interaksi Detail

**1. Membuka Halaman Login**

```
Penghuni -> LoginPage: Buka halaman login
LoginPage -> Penghuni: Tampilkan form login
```

- Penghuni mengakses URL `/login`
- LoginPage menampilkan form dengan field email dan password

**2. Input Kredensial**

```
Penghuni -> LoginPage: Input email & password
Penghuni -> LoginPage: Klik tombol "Login"
```

- Penghuni mengisi email: `ahmad@example.com`
- Penghuni mengisi password: `password123`
- Penghuni klik tombol "Login"

**3. Submit Login**

```
LoginPage -> AuthController: submitLogin(email, password)
```

- LoginPage mengirim request ke AuthController
- Data dikirim via POST request
- Data: `{email: "ahmad@example.com", password: "password123"}`

**4. Validasi Input**

```
AuthController -> AuthController: Validasi input
```

AuthController melakukan validasi:
- **Cek email format**: Apakah format email valid?
- **Cek password tidak kosong**: Apakah password diisi?

**5. Alternative Flow - Input Tidak Valid**

```
alt Input tidak valid
    AuthController -> LoginPage: return error("Input tidak valid")
    LoginPage -> Penghuni: Tampilkan pesan error
```

Jika validasi gagal:
- AuthController return error message
- LoginPage tampilkan error di form
- Proses berhenti, penghuni harus input ulang

**6. Alternative Flow - Input Valid (Lanjut)**

```
else Input valid
    AuthController -> User: findByEmail(email)
```

Jika validasi berhasil:
- AuthController memanggil method `findByEmail()` pada model User
- Parameter: email yang diinput penghuni

**7. Query Database**

```
User -> Database: SELECT * FROM users WHERE email = ?
Database -> User: return userData
```

- Model User melakukan query ke database
- Query: `SELECT * FROM users WHERE email = 'ahmad@example.com'`
- Database return data user (jika ditemukan)

**8. Alternative Flow - User Tidak Ditemukan**

```
alt User tidak ditemukan
    User -> AuthController: return null
    AuthController -> LoginPage: return error("Email tidak terdaftar")
    LoginPage -> Penghuni: Tampilkan pesan error
```

Jika email tidak ditemukan di database:
- User return `null` ke AuthController
- AuthController return error "Email tidak terdaftar"
- LoginPage tampilkan error ke penghuni
- Proses berhenti

**9. Alternative Flow - User Ditemukan (Lanjut)**

```
else User ditemukan
    User -> AuthController: return userData
```

Jika user ditemukan:
- User return data user ke AuthController
- Data berisi: id, email, password (hashed), role, dll

**10. Verifikasi Password**

```
AuthController -> AuthController: verifyPassword(password, userData.password)
```

AuthController melakukan verifikasi password:
- Password input: `password123`
- Password database (hashed): `$2y$10$abcdef...`
- Menggunakan bcrypt untuk compare

**11. Alternative Flow - Password Salah**

```
alt Password salah
    AuthController -> LoginPage: return error("Password salah")
    LoginPage -> Penghuni: Tampilkan pesan error
```

Jika password tidak cocok:
- AuthController return error "Password salah"
- LoginPage tampilkan error ke penghuni
- Proses berhenti

**12. Alternative Flow - Password Benar (Lanjut)**

```
else Password benar
    AuthController -> Session: createSession(userData)
```

Jika password cocok:
- AuthController memanggil method `createSession()` pada komponen Session
- Parameter: data user yang sudah terverifikasi

**13. Generate Session Token**

```
Session -> Session: Generate session token
```

Session component generate token:
- Generate random string (contoh: `abc123def456...`)
- Token akan digunakan untuk autentikasi request selanjutnya

**14. Simpan Session ke Database**

```
Session -> Database: INSERT INTO sessions
Database -> Session: return success
```

- Session menyimpan data session ke database
- Data: user_id, token, expired_at, created_at
- Database return success

**15. Return Session Token**

```
Session -> AuthController: return sessionToken
```

- Session return token ke AuthController
- Token: `abc123def456...`

**16. Return Success ke LoginPage**

```
AuthController -> LoginPage: return success(sessionToken, userData)
```

- AuthController return response success
- Response berisi: sessionToken dan userData (tanpa password)

**17. Simpan Token di Client**

```
LoginPage -> LoginPage: Simpan token di cookie/localStorage
```

- LoginPage menyimpan token di browser
- Bisa menggunakan cookie atau localStorage
- Token akan digunakan untuk request selanjutnya

**18. Redirect ke Dashboard**

```
LoginPage -> Penghuni: Redirect ke Dashboard
```

- LoginPage redirect penghuni ke halaman Dashboard
- URL: `/dashboard`

**19. Akses Dashboard**

```
Penghuni -> LoginPage: Akses Dashboard
LoginPage -> Penghuni: Tampilkan Dashboard
```

- Penghuni berhasil masuk ke Dashboard
- Dashboard menampilkan data penghuni (nama, kamar, tagihan, dll)

#### Elemen Penting dalam Diagram

**1. Lifeline**

Setiap objek memiliki lifeline (garis vertikal putus-putus) yang menunjukkan keberadaan objek selama interaksi.

**2. Activation Bar**

Kotak vertikal pada lifeline menunjukkan objek sedang aktif (sedang memproses).

**3. Message**

Panah horizontal menunjukkan message/method call antar objek:
- **Synchronous message**: Panah solid (→)
- **Return message**: Panah putus-putus (⇢)

**4. Alt Fragment**

Kotak `alt` menunjukkan alternative flow (if-else):
- **alt**: Kondisi pertama
- **else**: Kondisi alternatif

**5. Self-call**

Panah yang kembali ke objek sendiri menunjukkan internal method call.

#### Kondisi dan Aturan Bisnis

**Validasi Input:**
- Email harus format valid (mengandung @)
- Password minimal 8 karakter
- Email dan password tidak boleh kosong

**Keamanan:**
- Password disimpan dalam bentuk hash (bcrypt)
- Session token random dan unik
- Session expired setelah 24 jam (atau sesuai konfigurasi)
- Maksimal 3x login gagal dalam 15 menit (rate limiting)

**Session Management:**
- Satu user dapat memiliki multiple session (login di multiple device)
- Session dapat di-revoke (logout)
- Session otomatis expired jika tidak ada aktivitas selama 2 jam

#### Response Format

**Success Response:**
```json
{
  "status": "success",
  "message": "Login berhasil",
  "data": {
    "token": "abc123def456...",
    "user": {
      "id": 1,
      "email": "ahmad@example.com",
      "nama": "Ahmad Rizki",
      "role": "penghuni"
    }
  }
}
```

**Error Response:**
```json
{
  "status": "error",
  "message": "Email tidak terdaftar",
  "errors": {
    "email": ["Email tidak ditemukan dalam sistem"]
  }
}
```

---

### 2.3.2 Sequence Diagram - Skenario Penghuni Bayar Sewa

**[Gambar 2.6 Sequence Diagram - Skenario Penghuni Bayar Sewa]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_bayar.puml` dan generate menggunakan PlantUML.

#### Deskripsi Skenario

Skenario ini menggambarkan proses ketika penghuni melakukan pembayaran sewa bulanan. Proses ini melibatkan pengambilan data tagihan, upload bukti transfer, dan pengiriman notifikasi ke pemilik kost.

#### Aktor dan Objek yang Terlibat

**Aktor:**
- **Penghuni**: User yang akan melakukan pembayaran

**Objek/Komponen:**
- **PembayaranPage**: Halaman interface pembayaran
- **PembayaranController**: Controller yang menangani pembayaran
- **Tagihan**: Model yang merepresentasikan tagihan
- **Pembayaran**: Model yang merepresentasikan pembayaran
- **Database**: Database sistem
- **NotificationService**: Service untuk mengirim notifikasi

#### Alur Interaksi Detail

**1. Membuka Menu Pembayaran**

```
Penghuni -> PembayaranPage: Buka menu Pembayaran
PembayaranPage -> PembayaranController: getTagihanAktif(penghuniId)
```

- Penghuni klik menu "Pembayaran" di dashboard
- PembayaranPage request data tagihan aktif ke controller
- Parameter: penghuniId (dari session)

**2. Ambil Data Tagihan dari Database**

```
PembayaranController -> Tagihan: findByPenghuni(penghuniId, status='unpaid')
Tagihan -> Database: SELECT * FROM tagihans WHERE penghuni_id = ? AND status = 'unpaid'
Database -> Tagihan: return tagihanData
```

- Controller memanggil method `findByPenghuni()` pada model Tagihan
- Tagihan query ke database untuk ambil tagihan yang belum dibayar
- Database return list tagihan

**3. Return Data Tagihan**

```
Tagihan -> PembayaranController: return listTagihan
PembayaranController -> PembayaranPage: return listTagihan
PembayaranPage -> Penghuni: Tampilkan daftar tagihan
```

- Tagihan return data ke Controller
- Controller return data ke Page
- Page tampilkan list tagihan ke penghuni

**4. Pilih Tagihan**

```
Penghuni -> PembayaranPage: Pilih tagihan
PembayaranPage -> Penghuni: Tampilkan detail tagihan
```

- Penghuni pilih tagihan yang akan dibayar
- Page tampilkan detail:
  - Periode: Januari 2024
  - Jumlah: Rp 1.500.000
  - Jatuh tempo: 10 Januari 2024
  - Denda: Rp 0 (jika belum telat)

**5. Pilih Metode Pembayaran**

```
Penghuni -> PembayaranPage: Pilih metode pembayaran (Transfer Bank)
PembayaranPage -> Penghuni: Tampilkan info rekening
```

- Penghuni pilih metode: Transfer Bank
- Page tampilkan info rekening:
  - Bank BCA: 1234567890
  - a.n. PT Kost Sejahtera

**6. Lakukan Transfer (External)**

```
Penghuni -> Penghuni: Lakukan transfer via mobile banking
```

- Penghuni buka aplikasi mobile banking
- Penghuni transfer Rp 1.500.000 ke rekening yang ditampilkan
- Penghuni screenshot bukti transfer

**7. Upload Bukti Transfer**

```
Penghuni -> PembayaranPage: Upload bukti transfer
Penghuni -> PembayaranPage: Klik "Submit Pembayaran"
```

- Penghuni upload file screenshot (JPG/PNG)
- Penghuni klik tombol "Submit Pembayaran"

**8. Submit Pembayaran**

```
PembayaranPage -> PembayaranController: submitPembayaran(tagihanId, buktiTransfer)
PembayaranController -> PembayaranController: Validasi file upload
```

- Page kirim data ke Controller
- Controller validasi file:
  - Format: JPG, PNG, PDF
  - Ukuran: maksimal 2 MB
  - File tidak corrupt

**9. Alternative Flow - File Tidak Valid**

```
alt File tidak valid
    PembayaranController -> PembayaranPage: return error("File tidak valid")
    PembayaranPage -> Penghuni: Tampilkan pesan error
```

Jika file tidak valid:
- Controller return error
- Page tampilkan error ke penghuni
- Proses berhenti

**10. Alternative Flow - File Valid (Lanjut)**

```
else File valid
    PembayaranController -> Pembayaran: create(tagihanId, buktiTransfer)
```

Jika file valid:
- Controller memanggil method `create()` pada model Pembayaran
- Parameter: tagihanId, buktiTransfer (file path)

**11. Insert Data Pembayaran**

```
Pembayaran -> Database: INSERT INTO pembayarans (tagihan_id, bukti_transfer, status, created_at)
Database -> Pembayaran: return pembayaranId
```

- Pembayaran insert data ke database
- Data:
  - tagihan_id: 123
  - bukti_transfer: `/uploads/bukti_123.jpg`
  - status: `pending_confirmation`
  - created_at: `2024-01-05 10:30:00`
- Database return ID pembayaran yang baru dibuat

**12. Return Data Pembayaran**

```
Pembayaran -> PembayaranController: return pembayaranData
```

- Pembayaran return data ke Controller

**13. Update Status Tagihan**

```
PembayaranController -> Tagihan: updateStatus(tagihanId, 'pending_confirmation')
Tagihan -> Database: UPDATE tagihans SET status = 'pending_confirmation'
Database -> Tagihan: return success
```

- Controller update status tagihan
- Status berubah dari `unpaid` menjadi `pending_confirmation`
- Ini menandakan tagihan sedang menunggu konfirmasi

**14. Kirim Notifikasi ke Pemilik**

```
PembayaranController -> NotificationService: sendToPemilik(pembayaranData)
NotificationService -> NotificationService: Compose notification message
```

- Controller memanggil NotificationService
- Service compose message notifikasi:
  - Judul: "Pembayaran Baru"
  - Pesan: "Ahmad Rizki telah submit pembayaran Rp 1.500.000"

**15. Simpan Notifikasi ke Database**

```
NotificationService -> Database: INSERT INTO notifications
Database -> NotificationService: return success
```

- Service simpan notifikasi ke database
- Notifikasi akan muncul di dashboard Pemilik

**16. Kirim Email ke Pemilik**

```
NotificationService -> NotificationService: Send email to Pemilik
NotificationService -> PembayaranController: return success
```

- Service kirim email ke Pemilik Kost
- Email berisi link untuk konfirmasi pembayaran

**17. Return Success**

```
PembayaranController -> PembayaranPage: return success("Pembayaran berhasil disubmit")
PembayaranPage -> Penghuni: Tampilkan pesan sukses\n"Pembayaran Anda sedang diverifikasi"
```

- Controller return success ke Page
- Page tampilkan pesan sukses ke penghuni
- Pesan: "Pembayaran Anda berhasil disubmit dan sedang diverifikasi oleh Pemilik Kost"

#### Elemen Penting dalam Diagram

**1. Sequential Flow**

Diagram menunjukkan urutan interaksi yang jelas dari awal hingga akhir.

**2. Database Transaction**

Setiap operasi database (INSERT, UPDATE) ditunjukkan dengan jelas.

**3. External Process**

Proses transfer via mobile banking ditunjukkan sebagai self-call pada aktor Penghuni (proses eksternal).

**4. Service Layer**

NotificationService menunjukkan penggunaan service layer untuk logic yang kompleks.

**5. Alternative Flow**

Menggunakan `alt` fragment untuk menunjukkan validasi file.

#### Kondisi dan Aturan Bisnis

**Validasi Upload:**
- Format file: JPG, PNG, PDF
- Ukuran maksimal: 2 MB
- File harus readable (tidak corrupt)

**Status Pembayaran:**
- `pending_confirmation`: Menunggu konfirmasi Pemilik
- `approved`: Disetujui Pemilik
- `rejected`: Ditolak Pemilik

**Notifikasi:**
- Notifikasi in-app: Real-time via WebSocket
- Email: Dikirim asynchronous via queue
- Push notification: Jika Pemilik install mobile app

#### Data yang Disimpan

**Tabel pembayarans:**
```sql
INSERT INTO pembayarans (
  tagihan_id,
  tanggal_bayar,
  jumlah_bayar,
  metode_pembayaran,
  bukti_transfer,
  status,
  created_at
) VALUES (
  123,
  '2024-01-05 10:30:00',
  1500000,
  'transfer_bank',
  '/uploads/bukti_123.jpg',
  'pending_confirmation',
  '2024-01-05 10:30:00'
);
```

---

### 2.3.3 Sequence Diagram - Skenario Pemilik Approve Pembayaran

**[Gambar 2.7 Sequence Diagram - Skenario Pemilik Approve Pembayaran]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/sequence_approve.puml` dan generate menggunakan PlantUML.

#### Deskripsi Skenario

Skenario ini menggambarkan proses ketika Pemilik Kost melakukan konfirmasi (approve) pembayaran yang telah disubmit oleh penghuni. Proses ini melibatkan verifikasi pembayaran, update status, generate kwitansi, dan pengiriman notifikasi.

#### Aktor dan Objek yang Terlibat

**Aktor:**
- **Pemilik Kost**: User yang akan mengkonfirmasi pembayaran

**Objek/Komponen:**
- **DashboardPage**: Halaman dashboard Pemilik
- **PembayaranController**: Controller yang menangani pembayaran
- **Pembayaran**: Model pembayaran
- **Tagihan**: Model tagihan
- **Kwitansi**: Model kwitansi
- **Database**: Database sistem
- **NotificationService**: Service untuk notifikasi

#### Alur Interaksi Detail

**1. Login dan Buka Dashboard**

```
Pemilik -> DashboardPage: Login dan buka Dashboard
DashboardPage -> PembayaranController: getPembayaranPending()
```

- Pemilik Kost login ke sistem
- Dashboard otomatis request data pembayaran pending

**2. Ambil Data Pembayaran Pending**

```
PembayaranController -> Pembayaran: findByStatus('pending_confirmation')
Pembayaran -> Database: SELECT * FROM pembayarans WHERE status = 'pending_confirmation'
Database -> Pembayaran: return listPembayaran
```

- Controller query pembayaran dengan status pending
- Database return list pembayaran yang menunggu konfirmasi

**3. Return Data Pembayaran**

```
Pembayaran -> PembayaranController: return listPembayaran
PembayaranController -> DashboardPage: return listPembayaran
DashboardPage -> Pemilik: Tampilkan notifikasi badge\n"5 pembayaran menunggu konfirmasi"
```

- Data pembayaran dikirim ke Dashboard
- Dashboard tampilkan badge notifikasi
- Badge menunjukkan jumlah pembayaran pending

**4. Klik Menu Konfirmasi Pembayaran**

```
Pemilik -> DashboardPage: Klik menu "Konfirmasi Pembayaran"
DashboardPage -> Pemilik: Tampilkan list pembayaran pending
```

- Pemilik klik menu "Konfirmasi Pembayaran"
- Dashboard tampilkan list pembayaran dalam bentuk tabel

**5. Klik Detail Pembayaran**

```
Pemilik -> DashboardPage: Klik detail pembayaran
DashboardPage -> PembayaranController: getPembayaranDetail(pembayaranId)
```

- Pemilik klik salah satu pembayaran untuk lihat detail
- Dashboard request detail pembayaran ke Controller

**6. Ambil Detail Pembayaran**

```
PembayaranController -> Pembayaran: findById(pembayaranId)
Pembayaran -> Database: SELECT * FROM pembayarans WHERE id = ?
Database -> Pembayaran: return pembayaranData
```

- Controller query detail pembayaran
- Database return data lengkap pembayaran

**7. Return Detail Pembayaran**

```
Pembayaran -> PembayaranController: return pembayaranData
PembayaranController -> DashboardPage: return pembayaranData
DashboardPage -> Pemilik: Tampilkan detail pembayaran\n(Jumlah, Tanggal, Bukti Transfer)
```

- Data detail dikirim ke Dashboard
- Dashboard tampilkan:
  - Nama Penghuni: Ahmad Rizki
  - Kamar: 201
  - Periode: Januari 2024
  - Jumlah: Rp 1.500.000
  - Tanggal Submit: 05 Januari 2024
  - Bukti Transfer: (gambar)

**8. Verifikasi Transfer (External)**

```
Pemilik -> Pemilik: Cek rekening bank\nVerifikasi transfer masuk
```

- Pemilik buka aplikasi mobile banking
- Pemilik cek apakah transfer Rp 1.500.000 sudah masuk
- Pemilik cocokkan jumlah dan tanggal

**9. Klik Approve Pembayaran**

```
Pemilik -> DashboardPage: Klik "Approve Pembayaran"
DashboardPage -> PembayaranController: approvePembayaran(pembayaranId)
```

- Pemilik klik tombol "Approve Pembayaran"
- Dashboard kirim request approve ke Controller

**10. Update Status Pembayaran**

```
PembayaranController -> Pembayaran: updateStatus(pembayaranId, 'approved')
Pembayaran -> Database: UPDATE pembayarans SET status = 'approved', approved_at = NOW()
Database -> Pembayaran: return success
```

- Controller update status pembayaran
- Status berubah dari `pending_confirmation` menjadi `approved`
- Catat waktu approval (`approved_at`)

**11. Update Status Tagihan**

```
PembayaranController -> Tagihan: updateStatus(tagihanId, 'paid')
Tagihan -> Database: UPDATE tagihans SET status = 'paid', paid_at = NOW()
Database -> Tagihan: return success
```

- Controller update status tagihan
- Status berubah dari `pending_confirmation` menjadi `paid`
- Catat waktu pembayaran (`paid_at`)

**12. Generate Kwitansi**

```
PembayaranController -> Kwitansi: generate(pembayaranId)
Kwitansi -> Kwitansi: Create PDF kwitansi
```

- Controller memanggil method `generate()` pada model Kwitansi
- Kwitansi create PDF dengan data:
  - Nomor Kwitansi: KWT-2024-001
  - Nama Penghuni: Ahmad Rizki
  - Periode: Januari 2024
  - Jumlah: Rp 1.500.000
  - Tanggal Bayar: 05 Januari 2024
  - Tanda tangan digital

**13. Simpan Kwitansi ke Database**

```
Kwitansi -> Database: INSERT INTO kwitansis (pembayaran_id, file_path)
Database -> Kwitansi: return kwitansiId
```

- Kwitansi simpan data ke database
- Data:
  - pembayaran_id: 456
  - file_path: `/uploads/kwitansi/KWT-2024-001.pdf`
  - created_at: `2024-01-05 14:00:00`

**14. Return Data Kwitansi**

```
Kwitansi -> PembayaranController: return kwitansiData
```

- Kwitansi return data ke Controller

**15. Kirim Notifikasi ke Penghuni**

```
PembayaranController -> NotificationService: sendToPenghuni(pembayaranData, kwitansiData)
NotificationService -> Database: INSERT INTO notifications
Database -> NotificationService: return success
```

- Controller kirim data ke NotificationService
- Service simpan notifikasi ke database
- Notifikasi akan muncul di dashboard Penghuni

**16. Kirim Email dengan Kwitansi**

```
NotificationService -> NotificationService: Send email dengan attachment kwitansi
NotificationService -> PembayaranController: return success
```

- Service kirim email ke Penghuni
- Email berisi:
  - Subject: "Pembayaran Anda Telah Dikonfirmasi"
  - Body: Informasi pembayaran
  - Attachment: Kwitansi PDF

**17. Return Success**

```
PembayaranController -> DashboardPage: return success("Pembayaran berhasil diapprove")
DashboardPage -> Pemilik: Tampilkan pesan sukses\nUpdate list pembayaran
```

- Controller return success ke Dashboard
- Dashboard tampilkan pesan sukses
- Dashboard update list pembayaran (pembayaran yang di-approve hilang dari list pending)

#### Elemen Penting dalam Diagram

**1. Multiple Database Operations**

Diagram menunjukkan multiple update ke database:
- Update pembayaran
- Update tagihan
- Insert kwitansi
- Insert notifikasi

**2. PDF Generation**

Proses generate PDF kwitansi ditunjukkan sebagai internal process pada objek Kwitansi.

**3. Email with Attachment**

Pengiriman email dengan attachment kwitansi ditunjukkan dengan jelas.

**4. Cascade Update**

Update status pembayaran memicu cascade update ke tagihan.

#### Kondisi dan Aturan Bisnis

**Approval Rules:**
- Hanya Pemilik Kost yang dapat approve
- Approval harus dilakukan dalam 1x24 jam
- Setelah approve, tidak dapat di-undo (harus reject manual jika salah)

**Kwitansi Rules:**
- Nomor kwitansi auto-increment: KWT-YYYY-XXX
- Format PDF dengan template standar
- Disimpan di server dan dikirim via email
- Berlaku sebagai bukti pembayaran resmi

**Notifikasi Rules:**
- Notifikasi in-app: Real-time
- Email: Dengan attachment kwitansi
- Push notification: Jika penghuni install mobile app

#### Data yang Diupdate

**Tabel pembayarans:**
```sql
UPDATE pembayarans SET
  status = 'approved',
  approved_by = 1,
  approved_at = '2024-01-05 14:00:00'
WHERE id = 456;
```

**Tabel tagihans:**
```sql
UPDATE tagihans SET
  status = 'paid',
  paid_at = '2024-01-05 14:00:00'
WHERE id = 123;
```

**Tabel kwitansis:**
```sql
INSERT INTO kwitansis (
  pembayaran_id,
  nomor_kwitansi,
  file_path,
  created_at
) VALUES (
  456,
  'KWT-2024-001',
  '/uploads/kwitansi/KWT-2024-001.pdf',
  '2024-01-05 14:00:00'
);
```

---

### Kesimpulan Sequence Diagram

Ketiga Sequence Diagram di atas menggambarkan interaksi detail antar objek dalam sistem KostKu:

1. **Skenario Login**: Menunjukkan proses autentikasi dengan validasi bertingkat
2. **Skenario Bayar Sewa**: Menunjukkan proses submit pembayaran dengan upload file
3. **Skenario Approve**: Menunjukkan proses konfirmasi dengan multiple database operations

**Karakteristik Umum:**
- Menunjukkan urutan message passing yang jelas
- Menggunakan alternative flow untuk error handling
- Menunjukkan interaksi dengan database
- Menunjukkan penggunaan service layer (NotificationService)

**Manfaat untuk Implementasi:**
- Developer dapat memahami flow logic dengan detail
- Dapat mengidentifikasi method yang perlu dibuat
- Dapat mengidentifikasi database operations yang diperlukan
- Dapat memahami error handling yang perlu diimplementasikan

**Best Practices yang Diterapkan:**
- Separation of concerns (Controller, Model, Service)
- Validasi input di setiap layer
- Error handling yang comprehensive
- Logging dan audit trail
- Asynchronous processing untuk email

---

**Catatan Implementasi:**
- Gunakan transaction untuk multiple database operations
- Implement retry mechanism untuk email sending
- Gunakan queue untuk asynchronous processing
- Implement rate limiting untuk prevent abuse
- Gunakan caching untuk improve performance
