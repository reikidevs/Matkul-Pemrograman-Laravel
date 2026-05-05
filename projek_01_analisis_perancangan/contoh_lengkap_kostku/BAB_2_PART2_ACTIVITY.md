# BAB 2: DESAIN UML (Lanjutan)

## 2.2 Activity Diagram

Activity Diagram menggambarkan alur aktivitas atau proses bisnis dalam sistem. Diagram ini menunjukkan urutan aktivitas dari awal hingga akhir, termasuk decision point, parallel processing, dan swimlane untuk menunjukkan tanggung jawab aktor yang berbeda.

Sistem KostKu memiliki 3 (tiga) Activity Diagram utama yang merepresentasikan proses bisnis kritis:

---

### 2.2.1 Activity Diagram - Proses Pendaftaran Penghuni Baru

**[Gambar 2.2 Activity Diagram - Proses Pendaftaran Penghuni Baru]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_pendaftaran.puml` dan generate menggunakan PlantUML.

#### Deskripsi Proses

Proses pendaftaran penghuni baru adalah alur bisnis yang terjadi ketika calon penghuni ingin menyewa kamar kost. Proses ini melibatkan dua aktor utama: **Penghuni** dan **Pemilik Kost**.

#### Alur Proses Detail

**1. Tahap Pengisian Data (Penghuni)**

Proses dimulai ketika calon penghuni membuka halaman registrasi pada aplikasi KostKu. Penghuni kemudian mengisi form registrasi yang terdiri dari:

- **Data Diri**: Nama lengkap, email, nomor HP, dan NIK
- **Data Kamar**: Memilih kamar yang diminati dari daftar kamar yang tersedia

Setelah semua data diisi, penghuni menekan tombol "Submit" untuk mengirimkan form registrasi.

**2. Tahap Validasi Data (Sistem)**

Sistem melakukan validasi terhadap data yang diinput:

- **Jika data tidak valid** (misalnya: email format salah, NIK tidak lengkap, kamar tidak tersedia):
  - Sistem menampilkan pesan error yang spesifik
  - Penghuni kembali ke form registrasi untuk memperbaiki data
  - Proses berhenti sementara

- **Jika data valid**:
  - Sistem menyimpan data penghuni ke database
  - Sistem membuat akun baru dengan status "pending" (menunggu approval)
  - Sistem mengirimkan notifikasi ke Pemilik Kost
  - Proses berlanjut ke tahap approval

**3. Tahap Approval (Pemilik Kost) - Parallel Processing**

Pada tahap ini terjadi **fork** (parallel processing), di mana sistem menunggu keputusan dari Pemilik Kost:

**a. Pemilik Kost menerima notifikasi:**
- Notifikasi muncul di dashboard Pemilik Kost
- Notifikasi berisi informasi: ada pendaftar baru yang perlu direview

**b. Pemilik Kost melakukan review:**
- Pemilik membuka detail data penghuni
- Pemilik mengecek kelengkapan data (NIK, foto KTP, pekerjaan, dll)
- Pemilik mempertimbangkan apakah menerima atau menolak

**c. Decision Point - Keputusan Pemilik:**

**Skenario 1: Data Penghuni Disetujui (Ya)**

Jika Pemilik Kost menyetujui pendaftaran:

1. Pemilik klik tombol "Approve Pendaftaran"
2. Sistem update status akun menjadi "active"
3. Sistem assign kamar yang dipilih ke penghuni
4. Sistem generate invoice pertama (tagihan bulan pertama)
5. Sistem melakukan **fork** (parallel processing) untuk mengirim 2 email sekaligus:
   - **Email 1**: Email konfirmasi pendaftaran berhasil
   - **Email 2**: Email berisi kredensial login (username dan password)
6. Penghuni menerima kedua email tersebut
7. Penghuni dapat login ke sistem menggunakan kredensial yang diterima
8. Proses selesai dengan sukses

**Skenario 2: Data Penghuni Ditolak (Tidak)**

Jika Pemilik Kost menolak pendaftaran:

1. Pemilik klik tombol "Reject Pendaftaran"
2. Pemilik input alasan penolakan (misalnya: "Data tidak lengkap", "Kamar sudah terisi", dll)
3. Sistem update status akun menjadi "rejected"
4. Sistem mengirim email penolakan beserta alasan ke calon penghuni
5. Penghuni menerima email penolakan
6. Proses selesai (penghuni tidak dapat login)

#### Elemen Penting dalam Diagram

**1. Fork dan Join**

Diagram ini menggunakan **fork** untuk menunjukkan parallel processing:
- Fork pertama: Saat notifikasi dikirim ke Pemilik Kost (proses berjalan paralel)
- Fork kedua: Saat mengirim 2 email sekaligus (email konfirmasi dan kredensial)

**2. Decision Point (Diamond)**

Ada 2 decision point dalam proses ini:
- **Decision 1**: "Data valid?" - Mengecek validitas input data
- **Decision 2**: "Data penghuni disetujui?" - Keputusan approval dari Pemilik

**3. Swimlane (Implisit)**

Meskipun tidak menggunakan swimlane eksplisit, diagram ini menunjukkan perpindahan tanggung jawab:
- Penghuni: Input data
- Sistem: Validasi dan notifikasi
- Pemilik Kost: Review dan approval
- Sistem: Eksekusi hasil keputusan

#### Kondisi dan Aturan Bisnis

**Aturan Validasi:**
- Email harus format valid dan belum terdaftar
- NIK harus 16 digit
- Nomor HP harus format Indonesia (08xx atau +62)
- Kamar yang dipilih harus tersedia (status: available)

**Aturan Approval:**
- Pemilik Kost harus melakukan approval dalam 2x24 jam
- Jika lebih dari 2x24 jam tidak ada approval, sistem otomatis mengirim reminder
- Jika lebih dari 7 hari tidak ada approval, pendaftaran otomatis expired

**Aturan Notifikasi:**
- Notifikasi ke Pemilik dikirim via email dan in-app notification
- Email kredensial hanya dikirim jika approval berhasil
- Password default adalah kombinasi nama + 4 digit random

#### Keuntungan Proses Ini

1. **Kontrol Kualitas**: Pemilik dapat memverifikasi calon penghuni sebelum menerima
2. **Transparansi**: Penghuni mendapat notifikasi jelas tentang status pendaftaran
3. **Otomasi**: Sistem otomatis generate invoice dan kredensial setelah approval
4. **Audit Trail**: Semua proses tercatat (siapa approve, kapan, dll)

---

### 2.2.2 Activity Diagram - Proses Pembayaran Sewa Kost

**[Gambar 2.3 Activity Diagram - Proses Pembayaran Sewa Kost]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_pembayaran.puml` dan generate menggunakan PlantUML.

#### Deskripsi Proses

Proses pembayaran sewa adalah alur bisnis yang terjadi ketika penghuni melakukan pembayaran sewa bulanan. Proses ini melibatkan tiga aktor: **Penghuni**, **Pemilik Kost**, dan **Sistem**.

Diagram ini menggunakan **swimlane** untuk memisahkan tanggung jawab setiap aktor secara visual.

#### Alur Proses Detail dengan Swimlane

**SWIMLANE 1: PENGHUNI**

**1. Login dan Akses Menu Pembayaran**
- Penghuni login ke sistem menggunakan kredensial
- Penghuni membuka menu "Pembayaran" dari dashboard
- Sistem menampilkan daftar tagihan aktif

**2. Decision Point: Ada Tagihan?**

**Skenario A: Tidak Ada Tagihan**
- Sistem menampilkan pesan "Tidak ada tagihan aktif"
- Proses berhenti

**Skenario B: Ada Tagihan (Lanjut ke langkah berikutnya)**

**3. Memilih Tagihan dan Metode Pembayaran**
- Penghuni memilih tagihan yang akan dibayar (jika ada multiple tagihan)
- Penghuni memilih metode pembayaran:
  - **Transfer Bank**: Sistem menampilkan nomor rekening
  - **E-Wallet**: Sistem menampilkan QR Code atau nomor e-wallet

**4. Melakukan Pembayaran**
- Penghuni melakukan transfer melalui mobile banking atau e-wallet
- Penghuni mengambil screenshot bukti transfer

**5. Upload Bukti Pembayaran**
- Penghuni upload file bukti pembayaran (format: JPG, PNG, PDF)
- Penghuni klik tombol "Submit Pembayaran"

---

**SWIMLANE 2: SISTEM**

**6. Menyimpan Data Pembayaran**
- Sistem menerima data pembayaran dari penghuni
- Sistem menyimpan data ke database dengan status "pending"
- Sistem mencatat timestamp submit

**7. Mengirim Notifikasi**
- Sistem mengirim notifikasi ke Pemilik Kost
- Notifikasi berisi: nama penghuni, jumlah pembayaran, tanggal submit

---

**SWIMLANE 3: PEMILIK KOST**

**8. Menerima dan Review Pembayaran**
- Pemilik Kost menerima notifikasi pembayaran baru
- Pemilik membuka menu "Konfirmasi Pembayaran"
- Pemilik melihat detail pembayaran dan bukti transfer

**9. Verifikasi Pembayaran**
- Pemilik membuka aplikasi mobile banking
- Pemilik mengecek apakah transfer benar-benar masuk ke rekening
- Pemilik membandingkan jumlah transfer dengan jumlah tagihan

**10. Decision Point: Pembayaran Valid?**

**Skenario A: Pembayaran Valid (Ya)**

Jika transfer sudah masuk dan jumlahnya sesuai:

**SWIMLANE: PEMILIK KOST**
- Pemilik klik tombol "Approve Pembayaran"

**SWIMLANE: SISTEM**
- Sistem update status pembayaran menjadi "paid"
- Sistem update status tagihan menjadi "lunas"
- Sistem generate receipt/kwitansi dalam format PDF
- Sistem update tanggal jatuh tempo berikutnya (bulan depan)

**Fork - Parallel Processing:**

Sistem melakukan 2 proses paralel:

**Proses 1: Notifikasi ke Penghuni**
- Kirim notifikasi "Pembayaran Anda telah dikonfirmasi"
- Kirim kwitansi digital via email

**Proses 2: Update Dashboard dan Laporan**
- Update dashboard Pemilik (statistik pendapatan)
- Catat transaksi ke laporan keuangan

**SWIMLANE: PENGHUNI**
- Penghuni menerima notifikasi pembayaran berhasil
- Penghuni dapat download kwitansi dari sistem
- Proses selesai

**Skenario B: Pembayaran Tidak Valid (Tidak)**

Jika transfer belum masuk atau jumlahnya tidak sesuai:

**SWIMLANE: PEMILIK KOST**
- Pemilik klik tombol "Reject Pembayaran"
- Pemilik input alasan penolakan (contoh: "Jumlah transfer kurang Rp 50.000", "Transfer belum masuk")

**SWIMLANE: SISTEM**
- Sistem update status pembayaran menjadi "rejected"
- Sistem kirim notifikasi penolakan ke Penghuni

**SWIMLANE: PENGHUNI**
- Penghuni menerima notifikasi penolakan
- Penghuni melihat alasan penolakan
- Penghuni upload ulang bukti pembayaran yang benar
- Kembali ke langkah 5 (Upload Bukti Pembayaran)

#### Elemen Penting dalam Diagram

**1. Swimlane**

Diagram ini menggunakan 3 swimlane untuk memisahkan tanggung jawab:
- **Swimlane Penghuni**: Aktivitas yang dilakukan oleh penghuni
- **Swimlane Sistem**: Proses otomatis yang dilakukan sistem
- **Swimlane Pemilik Kost**: Aktivitas yang dilakukan oleh pemilik

**2. Decision Point**

Ada 2 decision point:
- **"Ada tagihan?"**: Mengecek apakah penghuni memiliki tagihan aktif
- **"Pembayaran valid?"**: Keputusan approval dari Pemilik setelah verifikasi

**3. Fork dan Join**

Fork digunakan saat sistem melakukan 2 proses paralel setelah approval:
- Mengirim notifikasi ke Penghuni
- Update dashboard dan laporan keuangan

**4. Loop (Implisit)**

Jika pembayaran ditolak, penghuni dapat upload ulang (loop kembali ke langkah upload).

#### Kondisi dan Aturan Bisnis

**Aturan Tagihan:**
- Tagihan dibuat otomatis setiap tanggal 1 bulan berjalan
- Jatuh tempo pembayaran: tanggal 10 setiap bulan
- Denda keterlambatan: Rp 50.000 per hari setelah jatuh tempo
- Maksimal keterlambatan: 7 hari (setelah itu kontrak dapat diputus)

**Aturan Upload Bukti:**
- Format file: JPG, PNG, PDF
- Maksimal ukuran file: 2 MB
- Bukti transfer harus jelas (tidak blur)

**Aturan Konfirmasi:**
- Pemilik harus konfirmasi dalam 1x24 jam
- Jika lebih dari 1x24 jam, sistem kirim reminder ke Pemilik
- Jika lebih dari 3 hari tidak dikonfirmasi, penghuni dapat komplain

**Aturan Kwitansi:**
- Kwitansi generate otomatis setelah approval
- Format: PDF dengan nomor unik
- Berisi: nama penghuni, periode sewa, jumlah bayar, tanggal bayar, tanda tangan digital

#### Metode Pembayaran yang Didukung

1. **Transfer Bank**
   - Bank BCA: 1234567890 a.n. PT Kost Sejahtera
   - Bank Mandiri: 9876543210 a.n. PT Kost Sejahtera
   - Bank BNI: 5555666677 a.n. PT Kost Sejahtera

2. **E-Wallet**
   - GoPay: 081234567890
   - OVO: 081234567890
   - Dana: 081234567890

#### Keuntungan Proses Ini

1. **Transparansi**: Penghuni dapat tracking status pembayaran real-time
2. **Efisiensi**: Tidak perlu datang langsung untuk membayar
3. **Bukti Digital**: Kwitansi otomatis tersimpan di sistem
4. **Audit Trail**: Semua transaksi tercatat dengan lengkap
5. **Reminder Otomatis**: Sistem kirim notifikasi sebelum jatuh tempo

---

### 2.2.3 Activity Diagram - Proses Pengajuan dan Penanganan Komplain

**[Gambar 2.4 Activity Diagram - Proses Komplain]**

> **Catatan:** Untuk melihat diagram, buka file `diagrams/activity_komplain.puml` dan generate menggunakan PlantUML.

#### Deskripsi Proses

Proses komplain adalah alur bisnis yang terjadi ketika penghuni mengalami masalah terkait fasilitas, kebersihan, keamanan, atau layanan kost. Proses ini melibatkan dua aktor utama: **Penghuni** dan **Pemilik Kost**.

Diagram ini menggunakan **swimlane** dan menunjukkan alur feedback loop (penghuni dapat membuka kembali komplain jika tidak puas).

#### Alur Proses Detail dengan Swimlane

**SWIMLANE 1: PENGHUNI**

**1. Login dan Akses Menu Komplain**
- Penghuni login ke sistem
- Penghuni membuka menu "Komplain"
- Penghuni klik tombol "Ajukan Komplain Baru"

**2. Mengisi Form Komplain**

Penghuni mengisi form dengan informasi berikut:

**a. Pilih Kategori Komplain:**
- **Fasilitas**: AC rusak, TV tidak berfungsi, kasur rusak, dll
- **Kebersihan**: Kamar kotor, kamar mandi tidak bersih, sampah menumpuk
- **Keamanan**: Kunci rusak, CCTV mati, pencahayaan kurang
- **Lainnya**: Komplain yang tidak masuk kategori di atas

**b. Input Detail Komplain:**
- **Judul**: Ringkasan masalah (contoh: "AC Kamar 201 Tidak Dingin")
- **Deskripsi**: Penjelasan detail masalah yang dialami
- **Upload Foto**: Foto bukti masalah (opsional, maksimal 3 foto)

**3. Submit Komplain**
- Penghuni klik tombol "Submit Komplain"

---

**SWIMLANE 2: SISTEM**

**4. Menyimpan Data Komplain**
- Sistem menyimpan data komplain ke database
- Sistem set status komplain: "open" (baru dibuka)
- Sistem generate nomor tiket unik (contoh: KMP-2024-001)

**5. Fork - Mengirim Notifikasi Paralel**

Sistem melakukan 2 proses paralel:

**Proses 1: Notifikasi ke Pemilik Kost**
- Kirim notifikasi ke dashboard Pemilik
- Notifikasi berisi: nomor tiket, kategori, judul komplain

**Proses 2: Email Konfirmasi ke Penghuni**
- Kirim email konfirmasi ke Penghuni
- Email berisi: nomor tiket, estimasi penanganan

---

**SWIMLANE 3: PEMILIK KOST**

**6. Menerima dan Review Komplain**
- Pemilik Kost menerima notifikasi komplain baru
- Pemilik membuka menu "Kelola Komplain"
- Pemilik melihat detail komplain (deskripsi, foto, dll)

**7. Analisis Masalah**
- Pemilik menganalisis tingkat urgensi masalah
- Pemilik menentukan apakah perlu tindakan segera

**8. Decision Point: Perlu Tindakan Segera?**

**Skenario A: Ya (Urgent)**

Jika masalah urgent (contoh: kebocoran air, listrik mati, keamanan terancam):

**SWIMLANE: PEMILIK KOST**
- Pemilik ubah prioritas komplain menjadi "Urgent"

**SWIMLANE: SISTEM**
- Sistem update prioritas komplain
- Sistem kirim notifikasi urgent ke teknisi/staff
- Sistem kirim notifikasi ke Penghuni bahwa komplain diprioritaskan

**Skenario B: Tidak (Normal)**

Jika masalah tidak urgent, lanjut ke langkah berikutnya.

**9. Assign Komplain**
- Pemilik assign komplain ke teknisi atau staff maintenance (jika perlu)
- Jika tidak perlu assign, Pemilik tangani sendiri

**10. Update Status Komplain**
- Pemilik update status komplain menjadi "in progress" (sedang ditangani)

---

**SWIMLANE: SISTEM**

**11. Kirim Notifikasi Update**
- Sistem kirim notifikasi ke Penghuni
- Notifikasi: "Komplain Anda sedang ditangani"

---

**SWIMLANE: PENGHUNI**

**12. Menerima Notifikasi**
- Penghuni menerima notifikasi update status
- Penghuni dapat tracking progress komplain di aplikasi

---

**SWIMLANE: PEMILIK KOST**

**13. Melakukan Perbaikan/Penanganan**
- Pemilik atau teknisi melakukan perbaikan
- Contoh: Memperbaiki AC, membersihkan kamar, mengganti kunci

**14. Dokumentasi Hasil Perbaikan**
- Pemilik upload foto hasil perbaikan
- Pemilik input catatan penyelesaian (apa yang sudah dilakukan)

**15. Update Status Resolved**
- Pemilik update status komplain menjadi "resolved" (sudah diselesaikan)

---

**SWIMLANE: SISTEM**

**16. Kirim Notifikasi Penyelesaian**
- Sistem kirim notifikasi ke Penghuni
- Notifikasi: "Komplain Anda telah diselesaikan"

---

**SWIMLANE: PENGHUNI**

**17. Verifikasi Hasil Perbaikan**
- Penghuni menerima notifikasi penyelesaian
- Penghuni melihat detail penyelesaian (foto, catatan)
- Penghuni mengecek langsung hasil perbaikan di kamar

**18. Decision Point: Puas dengan Penanganan?**

**Skenario A: Ya (Puas)**

Jika penghuni puas dengan hasil perbaikan:

**SWIMLANE: PENGHUNI**
- Penghuni beri rating (1-5 bintang)
- Penghuni beri feedback/komentar (opsional)
- Penghuni klik "Close Komplain"

**SWIMLANE: SISTEM**
- Sistem update status komplain menjadi "closed" (selesai)
- Sistem simpan rating dan feedback
- Proses selesai

**Skenario B: Tidak (Tidak Puas)**

Jika penghuni tidak puas (masalah belum selesai atau perbaikan tidak memuaskan):

**SWIMLANE: PENGHUNI**
- Penghuni klik "Buka Kembali Komplain"
- Penghuni tambah komentar (jelaskan kenapa tidak puas)

**SWIMLANE: SISTEM**
- Sistem update status komplain menjadi "reopened" (dibuka kembali)
- Sistem kirim notifikasi ke Pemilik Kost

**SWIMLANE: PEMILIK KOST**
- Pemilik menerima notifikasi komplain dibuka kembali
- Pemilik baca komentar penghuni
- Pemilik lakukan tindak lanjut ulang
- Kembali ke langkah 13 (Melakukan Perbaikan)

#### Elemen Penting dalam Diagram

**1. Swimlane**

Diagram ini menggunakan 3 swimlane:
- **Swimlane Penghuni**: Pengajuan dan verifikasi komplain
- **Swimlane Sistem**: Notifikasi dan update status otomatis
- **Swimlane Pemilik Kost**: Review, penanganan, dan resolusi

**2. Decision Point**

Ada 2 decision point:
- **"Perlu tindakan segera?"**: Menentukan prioritas komplain
- **"Puas dengan penanganan?"**: Feedback dari penghuni

**3. Fork dan Join**

Fork digunakan saat sistem mengirim notifikasi paralel:
- Notifikasi ke Pemilik Kost
- Email konfirmasi ke Penghuni

**4. Loop (Feedback Loop)**

Jika penghuni tidak puas, komplain dapat dibuka kembali (loop kembali ke proses perbaikan).

#### Kondisi dan Aturan Bisnis

**Kategori Komplain:**
1. **Fasilitas**: Masalah terkait peralatan dan furniture
2. **Kebersihan**: Masalah terkait sanitasi dan kebersihan
3. **Keamanan**: Masalah terkait keamanan dan keselamatan
4. **Lainnya**: Komplain umum lainnya

**Prioritas Komplain:**
- **Urgent**: Harus ditangani dalam 2 jam (keamanan, listrik, air)
- **High**: Harus ditangani dalam 24 jam (AC rusak, TV rusak)
- **Medium**: Harus ditangani dalam 3 hari (kebersihan, minor issues)
- **Low**: Harus ditangani dalam 7 hari (request tambahan fasilitas)

**Aturan Penanganan:**
- Pemilik harus response dalam 2 jam setelah komplain masuk
- Pemilik harus update progress minimal 1x sehari
- Komplain harus diselesaikan sesuai SLA berdasarkan prioritas
- Jika komplain dibuka kembali lebih dari 2x, escalate ke manajemen

**Aturan Rating:**
- Rating wajib diberikan sebelum close komplain
- Rating 1-2 bintang: Sistem otomatis escalate ke manajemen
- Rating 3 bintang: Perlu improvement
- Rating 4-5 bintang: Penanganan memuaskan

#### SLA (Service Level Agreement)

| Prioritas | Response Time | Resolution Time | Escalation |
|-----------|---------------|-----------------|------------|
| Urgent | 30 menit | 2 jam | 1 jam |
| High | 2 jam | 24 jam | 12 jam |
| Medium | 6 jam | 3 hari | 2 hari |
| Low | 24 jam | 7 hari | 5 hari |

#### Keuntungan Proses Ini

1. **Tracking Real-time**: Penghuni dapat tracking status komplain kapan saja
2. **Transparansi**: Semua proses penanganan terdokumentasi
3. **Accountability**: Jelas siapa yang bertanggung jawab menangani
4. **Feedback Loop**: Penghuni dapat memberikan feedback dan rating
5. **Escalation**: Komplain yang tidak terselesaikan otomatis escalate
6. **Dokumentasi**: Foto sebelum dan sesudah perbaikan tersimpan

---

### Kesimpulan Activity Diagram

Ketiga Activity Diagram di atas menggambarkan proses bisnis utama dalam sistem KostKu:

1. **Proses Pendaftaran**: Menunjukkan alur dari registrasi hingga approval dengan parallel processing
2. **Proses Pembayaran**: Menunjukkan alur pembayaran dengan swimlane yang jelas untuk setiap aktor
3. **Proses Komplain**: Menunjukkan alur komplain dengan feedback loop dan prioritas

**Karakteristik Umum:**
- Menggunakan decision point untuk menunjukkan percabangan logika
- Menggunakan fork/join untuk parallel processing
- Menggunakan swimlane untuk memisahkan tanggung jawab aktor
- Menunjukkan loop untuk proses yang dapat diulang

**Manfaat untuk Implementasi:**
- Developer dapat memahami alur bisnis dengan jelas
- Tester dapat membuat test case berdasarkan skenario
- Stakeholder dapat memvalidasi proses bisnis
- Dokumentasi yang lengkap untuk maintenance

---

**Catatan Implementasi:**
- Semua notifikasi harus real-time menggunakan WebSocket atau Firebase
- Semua status change harus tercatat dalam audit log
- Semua upload file harus divalidasi (format, ukuran, virus scan)
- Semua email harus menggunakan template yang konsisten
