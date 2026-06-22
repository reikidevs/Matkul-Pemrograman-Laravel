# 🟢 Panduan Menjalankan Laravel dengan Laragon & XAMPP (Untuk Pemula Total)

> Panduan ini ditulis **sangat detail** untuk kamu yang **belum pernah sama sekali** memakai Laravel, Laragon, maupun XAMPP.
> Ikuti **langkah demi langkah dari atas ke bawah**, jangan loncat. Setiap langkah ada penjelasan "kenapa".

**Mata Kuliah:** Pemrograman Berbasis Kerangka Kerja (PBKK)
**Versi Laravel:** 10.x &nbsp;•&nbsp; **PHP:** 8.1 – 8.4 &nbsp;•&nbsp; **Database:** MySQL

---

## 🧭 Daftar Isi

| Bagian | Isi |
| ------ | --- |
| [Bagian A](#bagian-a--memahami-dulu-sebelum-mulai) | Memahami dulu (konsep dasar) |
| [Bagian B](#bagian-b--cara-1-pakai-laragon-rekomendasi) | **Cara 1: Pakai Laragon** (Rekomendasi) |
| [Bagian C](#bagian-c--cara-2-pakai-xampp) | **Cara 2: Pakai XAMPP** |
| [Bagian D](#bagian-d--menjalankan-projek-kostku) | Menjalankan Projek Akhir (KostKu) |
| [Bagian E](#bagian-e--troubleshooting-lengkap) | Troubleshooting (kumpulan error) |
| [Bagian F](#bagian-f--glosarium-istilah) | Glosarium istilah |

---

## Bagian A — Memahami Dulu Sebelum Mulai

### A.1 Apa Bedanya Laragon dan XAMPP?

Keduanya adalah **paket software** yang berisi banyak alat sekaligus, supaya kamu tidak perlu install PHP, MySQL, dan Apache satu per satu secara manual.

| | **Laragon** | **XAMPP** |
| --- | --- | --- |
| Berisi | PHP, MySQL, Apache/Nginx, Composer, Node.js | PHP, MySQL (MariaDB), Apache |
| Ukuran | Ringan | Lebih berat |
| Composer | ✅ Sudah termasuk | ❌ Install manual |
| Cocok untuk | Pemula & developer modern | Pemula yang sudah biasa XAMPP |
| Rekomendasi | ⭐ **Sangat disarankan** | Boleh, kalau sudah punya |

> 💡 **Kesimpulan:** Kalau kamu mulai dari nol, **pakai Laragon** (Bagian B). Kalau di laptopmu sudah ada XAMPP dan tidak mau install lagi, pakai XAMPP (Bagian C).

### A.2 Istilah Penting yang Wajib Dimengerti

| Istilah | Arti Sederhana |
| ------- | -------------- |
| **Terminal / CMD** | Tempat mengetik perintah (kotak hitam) |
| **PHP** | Bahasa pemrograman yang dipakai Laravel |
| **Composer** | Pengunduh library PHP (seperti "Play Store" untuk kode PHP) |
| **MySQL** | Tempat menyimpan data (database) |
| **`php artisan`** | Perintah ajaib Laravel untuk banyak hal |
| **`.env`** | File pengaturan rahasia (koneksi database, dll) |
| **migration** | Cetak biru / blueprint tabel database |
| **seeder** | Pengisi data contoh ke database |

### A.3 Yang Akan Kita Capai

Di akhir panduan ini, kamu bisa:
1. ✅ Membuka project Laravel praktikum (01–10)
2. ✅ Menyambungkan ke database MySQL
3. ✅ Menjalankan di browser → `http://localhost:8000`
4. ✅ Menjalankan projek akhir KostKu lengkap dengan login

---

## Bagian B — Cara 1: Pakai Laragon (Rekomendasi)

### B.1 Download & Install Laragon

1. Buka browser, kunjungi: **https://laragon.org/download/**
2. Pilih **Laragon - Full** (versi lengkap, sudah termasuk PHP + MySQL + Node).
3. Jalankan file installer yang terunduh (misal `laragon-wamp.exe`).
4. Klik **Next → Next → Install** sampai selesai (biarkan pengaturan default).
5. Setelah selesai, buka aplikasi **Laragon**.

### B.2 Menyalakan Server

1. Di jendela Laragon, klik tombol besar **Start All** (pojok kanan bawah).
2. Tunggu sampai tombol **Apache** dan **MySQL** berwarna **hijau/menyala**.

> ✅ Kalau Apache & MySQL sudah menyala, artinya PHP dan database sudah siap dipakai.

### B.3 Cek PHP & Composer Sudah Ada

1. Di Laragon, klik tombol **Terminal** (atau klik kanan area kosong → **Terminal**).
   Ini penting: terminal Laragon **sudah otomatis mengenali** PHP, Composer, dan MySQL.
2. Ketik perintah ini satu per satu, tekan Enter setiap baris:

```bash
php --version
```
Harus muncul, contoh: `PHP 8.2.x`

```bash
composer --version
```
Harus muncul versi Composer.

```bash
mysql --version
```
Harus muncul versi MySQL/MariaDB.

> ❗ Kalau salah satu error `command not found`, **tutup terminal biasa** dan pakai **Terminal bawaan Laragon** (langkah B.3 nomor 1). Terminal Laragon sudah disetel otomatis.

### B.4 Letakkan Folder Project

Project praktikum ini ada di laptopmu, misalnya di:
```
E:\Joki Tugas\Program\Matkul Pemrograman Laravel
```

Kamu **tidak wajib** memindahkannya ke folder `www` Laragon, karena kita akan memakai `php artisan serve` (server bawaan Laravel). Jadi cukup buka terminal dan masuk ke foldernya.

### B.5 Masuk ke Folder Praktikum

Di **Terminal Laragon**, ketik (contoh untuk Praktikum 05 yang sudah pakai database):

```bash
cd "E:\Joki Tugas\Program\Matkul Pemrograman Laravel\praktikum_05_migration_model_seeder\praktikum_laravel"
```

> 💡 **Tips:** Tanda kutip `"..."` wajib dipakai karena ada **spasi** di nama folder.

### B.6 Install Dependencies (vendor)

Folder `vendor/` berisi semua library Laravel. Kalau belum ada, install dulu:

```bash
composer install
```

Tunggu sampai selesai (bisa beberapa menit pada pertama kali).

### B.7 Siapkan File `.env`

File `.env` adalah pengaturan. Kita copy dari contohnya:

```bash
copy .env.example .env
```

> Di terminal Laragon (berbasis CMD) gunakan `copy`. Kalau pakai Git Bash/PowerShell gunakan `cp .env.example .env`.

### B.8 Generate Application Key

```bash
php artisan key:generate
```

Perintah ini mengisi `APP_KEY` di file `.env`. Tanpa ini, Laravel akan error "No application encryption key".

### B.9 Buat Database di Laragon

1. Kembali ke jendela **Laragon**, klik tombol **Database** (atau **Menu → MySQL → ...**).
   Ini akan membuka aplikasi database (biasanya **HeidiSQL**).
2. Saat diminta login, biasanya:
   - **Host:** `127.0.0.1` atau `localhost`
   - **User:** `root`
   - **Password:** *(kosongkan)*
   - Klik **Open / Connect**.
3. Klik kanan pada area daftar database (kiri) → **Create new → Database**.
4. Beri nama database: **`akademik`** (untuk praktikum 05–10).
5. Klik **OK**.

> 💡 Nama database `akademik` ini harus **sama** dengan yang ditulis di `.env` (langkah berikutnya).

### B.10 Sambungkan `.env` ke Database

1. Buka file `.env` di VS Code (folder project yang tadi).
2. Cari bagian database, ubah menjadi:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```

3. **Simpan** file (`Ctrl + S`).

> ❗ `DB_PASSWORD` dikosongkan karena default Laragon memang tanpa password untuk user `root`.

### B.11 Jalankan Migration + Seeder

Perintah ini akan **membuat semua tabel** dan **mengisi data contoh**:

```bash
php artisan migrate:fresh --seed
```

Kalau berhasil, kamu akan melihat daftar tabel dibuat (`Migrating...` / `Seeding...`).

### B.12 Jalankan Server Laravel

```bash
php artisan serve
```

Akan muncul:
```
INFO  Server running on [http://127.0.0.1:8000]
```

### B.13 Buka di Browser 🎉

Buka browser, ketik:
```
http://localhost:8000
```

> ✅ Kalau halaman muncul tanpa error, **selamat — kamu berhasil!**
> Untuk berhenti, kembali ke terminal lalu tekan `Ctrl + C`.

---

## Bagian C — Cara 2: Pakai XAMPP

> Pakai bagian ini **hanya kalau** kamu memilih XAMPP, bukan Laragon.

### C.1 Download & Install XAMPP

1. Buka: **https://www.apachefriends.org/download.html**
2. Unduh XAMPP untuk Windows dengan **PHP 8.1 ke atas**.
3. Jalankan installer → **Next** sampai selesai (biarkan lokasi default `C:\xampp`).

> ⚠️ **Penting:** XAMPP **tidak membawa Composer**. Kita akan install Composer terpisah di langkah C.4.

### C.2 Menyalakan Apache & MySQL

1. Buka **XAMPP Control Panel**.
2. Klik tombol **Start** pada baris **Apache**.
3. Klik tombol **Start** pada baris **MySQL**.
4. Pastikan keduanya berubah jadi **hijau** (running).

> ❗ Kalau **Apache gagal start** karena port 80 dipakai, jangan panik — kita tidak memakai Apache untuk Laravel (kita pakai `php artisan serve`). Yang **wajib menyala hanya MySQL**.

### C.3 Daftarkan PHP XAMPP ke PATH (Agar `php` Dikenali)

Secara default, perintah `php` belum dikenali di CMD biasa. Cara termudah:

**Opsi A — Pakai folder PHP XAMPP langsung (paling aman):**
Setiap kali buka CMD, masuk dulu ke folder php, atau tambahkan ke PATH (Opsi B).

**Opsi B — Tambahkan PHP ke PATH (sekali saja, permanen):**
1. Tekan tombol **Windows**, ketik **"environment variables"** → buka **"Edit the system environment variables"**.
2. Klik tombol **Environment Variables...**.
3. Di bagian **System variables**, cari dan pilih **Path** → klik **Edit**.
4. Klik **New**, lalu masukkan: `C:\xampp\php`
5. Klik **OK** di semua jendela.
6. **Tutup semua CMD/terminal**, lalu buka CMD baru.
7. Cek: ketik `php --version` → harus muncul versi PHP.

### C.4 Install Composer

1. Buka: **https://getcomposer.org/download/**
2. Unduh & jalankan **Composer-Setup.exe**.
3. Saat instalasi, jika diminta lokasi PHP, arahkan ke: `C:\xampp\php\php.exe`
4. Klik **Next** sampai selesai.
5. **Tutup CMD lama**, buka CMD baru, cek:

```bash
composer --version
```
Harus muncul versi Composer.

### C.5 Masuk ke Folder Praktikum

Buka **CMD** (tekan Windows → ketik `cmd` → Enter), lalu:

```bash
cd "E:\Joki Tugas\Program\Matkul Pemrograman Laravel\praktikum_05_migration_model_seeder\praktikum_laravel"
```

> 💡 Tanda kutip `"..."` wajib karena nama folder mengandung spasi.

### C.6 Install Dependencies, `.env`, dan Key

Jalankan berurutan:

```bash
composer install
```

```bash
copy .env.example .env
```

```bash
php artisan key:generate
```

### C.7 Buat Database Lewat phpMyAdmin

1. Pastikan **MySQL** di XAMPP Control Panel sudah **hijau**.
2. Buka browser, ketik: **http://localhost/phpmyadmin**
3. Di menu kiri, klik **New**.
4. Pada kolom **Database name**, ketik: **`akademik`**
5. Pilih collation **`utf8mb4_general_ci`** (opsional), lalu klik **Create**.

### C.8 Sambungkan `.env` ke Database

Buka file `.env` di VS Code, sesuaikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=akademik
DB_USERNAME=root
DB_PASSWORD=
```

> ❗ Di XAMPP, user `root` defaultnya **tanpa password**, jadi `DB_PASSWORD` dikosongkan. Simpan file (`Ctrl + S`).

### C.9 Migration + Seeder

```bash
php artisan migrate:fresh --seed
```

### C.10 Jalankan Server & Buka Browser 🎉

```bash
php artisan serve
```

Buka browser:
```
http://localhost:8000
```

> ✅ Berhasil kalau halaman tampil tanpa error. Tekan `Ctrl + C` di terminal untuk berhenti.

---

## Bagian D — Menjalankan Projek KostKu

Projek akhir **KostKu** sedikit berbeda dari praktikum biasa: ia butuh **upload file** (bukti transfer), jadi ada satu langkah tambahan (`storage:link`) dan **nama database berbeda** (`kostku_db`).

### D.1 Masuk ke Folder KostKu

**Laragon (Terminal Laragon) atau XAMPP (CMD):**

```bash
cd "E:\Joki Tugas\Program\Matkul Pemrograman Laravel\projek_02_implementasi\kostku_laravel"
```

### D.2 Install Dependencies

```bash
composer install
```

### D.3 Siapkan `.env` dan Key

```bash
copy .env.example .env
```

```bash
php artisan key:generate
```

### D.4 Buat Database `kostku_db`

- **Laragon:** buka HeidiSQL (tombol **Database**) → klik kanan → Create new → Database → nama **`kostku_db`**.
- **XAMPP:** buka **http://localhost/phpmyadmin** → **New** → nama **`kostku_db`** → **Create**.

### D.5 Sambungkan `.env` ke `kostku_db`

Buka `.env`, ubah bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kostku_db
DB_USERNAME=root
DB_PASSWORD=
```

Simpan (`Ctrl + S`).

### D.6 Buat Storage Link (WAJIB untuk Upload File)

```bash
php artisan storage:link
```

> 💡 Perintah ini membuat "jalan pintas" agar file yang diupload (foto bukti transfer) bisa tampil di browser. **Jangan dilewati** untuk KostKu.

### D.7 Migration + Seeder

```bash
php artisan migrate:fresh --seed
```

Setelah selesai, kamu akan melihat akun contoh:

```
📧 Admin    : admin@kostku.com    / admin123
📧 Pemilik  : pemilik@kostku.com  / pemilik123
📧 Penghuni : ani@test.com        / penghuni123
```

### D.8 Jalankan & Login

```bash
php artisan serve
```

Buka **http://localhost:8000**, lalu login pakai salah satu akun di atas.

> ✅ Coba login sebagai **Pemilik** untuk melihat dashboard kelola kamar, atau sebagai **Penghuni** untuk melihat tagihan.

---

## Bagian E — Troubleshooting Lengkap

Kumpulan error yang **paling sering** dialami pemula, beserta solusinya.

### E.1 `'php' is not recognized` / `command not found`

**Penyebab:** PHP belum dikenali oleh terminal.
- **Laragon:** pakai **Terminal bawaan Laragon**, bukan CMD biasa.
- **XAMPP:** tambahkan `C:\xampp\php` ke PATH (lihat langkah C.3), lalu **tutup dan buka ulang** CMD.

### E.2 `No application encryption key has been specified`

**Solusi:**
```bash
php artisan key:generate
```

### E.3 `SQLSTATE[HY000] [1049] Unknown database 'akademik'`

**Penyebab:** Database belum dibuat.
**Solusi:** Buat database dulu (langkah B.9 untuk Laragon / C.7 untuk XAMPP), pastikan namanya **sama persis** dengan `DB_DATABASE` di `.env`.

### E.4 `SQLSTATE[HY000] [2002] Connection refused`

**Penyebab:** MySQL belum menyala.
**Solusi:** Nyalakan MySQL (Laragon **Start All** / XAMPP klik **Start** pada MySQL).

### E.5 `SQLSTATE[HY000] [1045] Access denied for user 'root'`

**Penyebab:** Password di `.env` salah.
**Solusi:** Untuk Laragon & XAMPP default, kosongkan password:
```env
DB_USERNAME=root
DB_PASSWORD=
```

### E.6 `Class "..." not found`

**Solusi:** Muat ulang autoload:
```bash
composer dump-autoload
```

### E.7 Halaman error / tampilan berantakan setelah ubah kode

**Solusi:** Bersihkan cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### E.8 Port 8000 sudah dipakai

**Solusi:** Jalankan di port lain:
```bash
php artisan serve --port=8001
```
Lalu buka `http://localhost:8001`.

### E.9 Gambar / bukti transfer tidak muncul (KostKu)

**Penyebab:** Belum membuat storage link.
**Solusi:**
```bash
php artisan storage:link
```

### E.10 `vendor` tidak ada / banyak error class Laravel

**Penyebab:** Dependencies belum di-install.
**Solusi:**
```bash
composer install
```

### E.11 Apache di XAMPP gagal start (port 80)

**Tidak masalah.** Kita tidak butuh Apache untuk menjalankan Laravel di sini.
Yang penting **MySQL menyala**. Laravel dijalankan dengan `php artisan serve`.

---

## Bagian F — Glosarium Istilah

| Istilah | Penjelasan |
| ------- | ---------- |
| **Framework** | Kerangka kerja siap pakai untuk membangun aplikasi lebih cepat |
| **Dependency** | Library/paket yang dibutuhkan project agar berjalan |
| **`vendor/`** | Folder berisi semua dependency (dibuat oleh `composer install`) |
| **`.env`** | File pengaturan rahasia (database, key, dll) |
| **`APP_KEY`** | Kunci enkripsi aplikasi (dibuat oleh `php artisan key:generate`) |
| **Migration** | Cetak biru struktur tabel database |
| **Seeder** | Pengisi data contoh ke database |
| **`migrate:fresh --seed`** | Hapus semua tabel, buat ulang, lalu isi data contoh |
| **`storage:link`** | Membuat jalan pintas agar file upload bisa diakses publik |
| **`php artisan serve`** | Menjalankan server pengembangan Laravel |
| **localhost** | Komputer kamu sendiri (server lokal) |
| **Port** | "Pintu" jaringan; Laravel default memakai port 8000 |

---

## ✅ Ringkasan Perintah (Cheat Sheet)

```bash
# 1. Masuk folder project
cd "PATH\KE\praktikum_laravel"

# 2. Install dependency
composer install

# 3. Siapkan .env + key
copy .env.example .env
php artisan key:generate

# 4. (KostKu saja) buat storage link
php artisan storage:link

# 5. Buat tabel + isi data
php artisan migrate:fresh --seed

# 6. Jalankan server
php artisan serve
```

> 🎯 **Ingat urutannya:** install → env → key → database → migrate → serve.
> Kalau bingung di tengah jalan, lihat **Bagian E (Troubleshooting)**.

---

**Selamat belajar! 🚀** Kalau kamu sudah berhasil sampai sini, kamu sudah menguasai dasar menjalankan Laravel di Laragon & XAMPP.


---
