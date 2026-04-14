# Git Push Guide - PBKK Laravel 2026

Panduan untuk push project ke GitHub.

---

## ⚠️ Error yang Terjadi

```
remote: Permission to n5nd5sh0f5015/Matkul-Pemrograman-Laravel.git denied to reikidevs.
fatal: unable to access 'https://github.com/n5nd5sh0f5015/Matkul-Pemrograman-Laravel.git/': The requested URL returned error: 403
```

**Penyebab:** Credentials GitHub tidak sesuai atau expired.

---

## 🔧 Solusi

### Opsi 1: Update Git Credentials (Windows)

#### Step 1: Hapus Credentials Lama

**Via Windows Credential Manager:**
1. Tekan `Windows + R`
2. Ketik `control /name Microsoft.CredentialManager`
3. Klik "Windows Credentials"
4. Cari "git:https://github.com"
5. Klik "Remove"

**Via Command Line:**
```bash
git credential-manager-core erase
host=github.com
protocol=https
```

#### Step 2: Push Ulang (Akan Minta Login)

```bash
git push -u origin main
```

Akan muncul popup untuk login GitHub. Gunakan akun yang benar: **n5nd5sh0f5015**

---

### Opsi 2: Gunakan Personal Access Token (PAT)

#### Step 1: Buat Personal Access Token

1. Buka https://github.com/settings/tokens
2. Klik "Generate new token" → "Generate new token (classic)"
3. Beri nama: "PBKK Laravel 2026"
4. Pilih scope: `repo` (full control)
5. Klik "Generate token"
6. **COPY TOKEN** (hanya muncul sekali!)

#### Step 2: Update Remote URL dengan Token

```bash
git remote set-url origin https://YOUR_TOKEN@github.com/n5nd5sh0f5015/Matkul-Pemrograman-Laravel.git
```

Ganti `YOUR_TOKEN` dengan token yang sudah di-copy.

#### Step 3: Push

```bash
git push -u origin main
```

---

### Opsi 3: Gunakan SSH (Recommended)

#### Step 1: Generate SSH Key

```bash
ssh-keygen -t ed25519 -C "your_email@example.com"
```

Tekan Enter untuk default location.

#### Step 2: Copy Public Key

```bash
cat ~/.ssh/id_ed25519.pub
```

Copy output-nya.

#### Step 3: Add ke GitHub

1. Buka https://github.com/settings/keys
2. Klik "New SSH key"
3. Paste public key
4. Klik "Add SSH key"

#### Step 4: Update Remote URL

```bash
git remote set-url origin git@github.com:n5nd5sh0f5015/Matkul-Pemrograman-Laravel.git
```

#### Step 5: Push

```bash
git push -u origin main
```

---

## 📝 Manual Push Steps

Jika masih error, lakukan manual:

### 1. Cek Status

```bash
git status
```

### 2. Add Files (Jika Ada yang Belum)

```bash
git add .
```

### 3. Commit (Jika Ada Perubahan)

```bash
git commit -m "feat: add praktikum 02, 03, 04 - routing, blade, master template"
```

### 4. Cek Remote

```bash
git remote -v
```

### 5. Push

```bash
git push -u origin main
```

---

## 🎯 Commit Message yang Baik

Gunakan format conventional commits:

```bash
# Praktikum 02
git commit -m "feat(praktikum02): add routing and controller implementation"

# Praktikum 03
git commit -m "feat(praktikum03): add blade template with table display"

# Praktikum 04
git commit -m "feat(praktikum04): add master template with Quixlab Bootstrap"

# All at once
git commit -m "feat: add praktikum 02-04 (routing, blade, master template)

- Praktikum 02: Routing & Controller with MahasiswaController
- Praktikum 03: Blade Template with @foreach and table
- Praktikum 04: Master Template with Quixlab Bootstrap integration
"
```

---

## 🔍 Troubleshooting

### Error: "fatal: refusing to merge unrelated histories"

```bash
git pull origin main --allow-unrelated-histories
git push -u origin main
```

### Error: "Updates were rejected"

```bash
git pull origin main --rebase
git push -u origin main
```

### Error: "Permission denied (publickey)"

Gunakan HTTPS instead of SSH:
```bash
git remote set-url origin https://github.com/n5nd5sh0f5015/Matkul-Pemrograman-Laravel.git
```

---

## ✅ Verification

Setelah push berhasil, cek di GitHub:

1. Buka https://github.com/n5nd5sh0f5015/Matkul-Pemrograman-Laravel
2. Pastikan semua folder muncul:
   - praktikum_01_install/
   - praktikum_02_routing_controller/
   - praktikum_03_blade_template/
   - praktikum_04_master_template/
   - README.md
   - PROGRESS.md
   - dll

---

## 📊 Current Status

**Repository:** https://github.com/n5nd5sh0f5015/Matkul-Pemrograman-Laravel

**Branch:** main

**Praktikum Selesai:**
- ✅ Praktikum 01: Install Laravel
- ✅ Praktikum 02: Routing & Controller
- ✅ Praktikum 03: Blade Template
- ✅ Praktikum 04: Master Template

**Progress:** 40% (4/10+)

---

## 🚀 Quick Fix

Jika ingin cepat, gunakan ini:

```bash
# 1. Hapus credentials lama
git credential-manager-core erase
host=github.com
protocol=https

# 2. Push (akan minta login)
git push -u origin main
```

Pastikan login dengan akun: **n5nd5sh0f5015**

---

## 📞 Butuh Bantuan?

Jika masih error:
1. Screenshot error message
2. Jalankan: `git remote -v`
3. Jalankan: `git status`
4. Tanya di Telegram atau contact support

---

**Good Luck! 🚀**
