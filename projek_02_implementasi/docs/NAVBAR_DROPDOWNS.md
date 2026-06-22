# Implementasi Navbar Dropdowns

**Tanggal:** 4 Juni 2026  
**Status:** ✅ SELESAI  

---

## 📋 Overview

Dokumentasi implementasi navbar dropdowns untuk notifikasi dan user menu di header aplikasi KostKu.

---

## 🎯 Fitur yang Diimplementasikan

### 1. Notification Dropdown

**Lokasi:** Header kanan (icon bell)

**Fitur:**
- ✅ Toggle dropdown on click
- ✅ Badge merah jika ada notifikasi baru
- ✅ Empty state: "Tidak ada notifikasi baru"
- ✅ Close saat klik outside
- ✅ Close saat press Escape

**HTML Structure:**
```html
<button class="notification-btn" id="notificationBtn">
    <svg>...</svg>
    <span class="notification-badge"></span>
</button>

<div class="notification-dropdown" id="notificationDropdown">
    <div>Notifikasi</div>
    <div class="empty-state">
        Tidak ada notifikasi baru
    </div>
</div>
```

---

### 2. User Menu Dropdown

**Lokasi:** Header kanan (user avatar + nama)

**Menu Items:**
- ✅ Profil Saya (link ke `/profile`)
- ✅ Ubah Password (link ke `/profile/change-password`)
- ✅ Logout (form submit)

**HTML Structure:**
```html
<div class="user-menu" id="userMenuBtn">
    <div class="user-avatar">AN</div>
    <span>Nama User</span>
    <svg>...</svg>
</div>

<div class="user-dropdown" id="userDropdown">
    <a href="/profile">Profil Saya</a>
    <a href="/profile/change-password">Ubah Password</a>
    <div>--- divider ---</div>
    <a href="#" onclick="logout()">Logout</a>
</div>
```

---

## 💻 Implementasi

### CSS (`public/css/custom.css`)

```css
/* Dropdown Base Styles */
.notification-dropdown,
.user-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    min-width: 320px;
    background-color: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: opacity 0.2s, transform 0.2s, visibility 0.2s;
    z-index: 1000;
}

/* Show State */
.notification-dropdown.show,
.user-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* User Dropdown Specific */
.user-dropdown {
    min-width: 200px;
}

.user-dropdown a:hover {
    background-color: var(--gray-50);
}
```

**Penjelasan:**
- `opacity: 0` & `visibility: hidden`: Dropdown tersembunyi by default
- `transform: translateY(-10px)`: Slide animation dari atas
- `transition`: Smooth animation 0.2s
- `.show` class: Toggle visibility dengan JavaScript

---

### JavaScript (`layouts/app.blade.php`)

```javascript
// Notification Dropdown
const notificationBtn = document.getElementById('notificationBtn');
const notificationDropdown = document.getElementById('notificationDropdown');

// User Dropdown
const userMenuBtn = document.getElementById('userMenuBtn');
const userDropdown = document.getElementById('userDropdown');

// Toggle notification dropdown
if (notificationBtn && notificationDropdown) {
    notificationBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('show');
        userDropdown.classList.remove('show'); // Close other dropdown
    });
}

// Toggle user dropdown
if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdown.classList.toggle('show');
        notificationDropdown.classList.remove('show'); // Close other dropdown
    });
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!notificationBtn?.contains(e.target) && !notificationDropdown?.contains(e.target)) {
        notificationDropdown?.classList.remove('show');
    }
    if (!userMenuBtn?.contains(e.target) && !userDropdown?.contains(e.target)) {
        userDropdown?.classList.remove('show');
    }
});

// Close dropdowns on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        notificationDropdown?.classList.remove('show');
        userDropdown?.classList.remove('show');
    }
});
```

**Penjelasan:**
1. **Toggle Logic**: Add/remove class `.show` on click
2. **Mutual Exclusion**: Close other dropdown saat buka yang baru
3. **Outside Click**: Close jika klik di luar dropdown
4. **Escape Key**: Close dengan keyboard
5. **`e.stopPropagation()`**: Prevent event bubbling ke document

---

## 🧪 Testing

### Test Case 1: Toggle Notification

**Steps:**
1. Klik icon bell (notification)
2. Dropdown muncul dengan smooth animation
3. Klik icon bell lagi
4. Dropdown tertutup

**Expected:** ✅ Pass

---

### Test Case 2: Toggle User Menu

**Steps:**
1. Klik user avatar/nama
2. Dropdown muncul dengan 3 menu items
3. Klik user avatar lagi
4. Dropdown tertutup

**Expected:** ✅ Pass

---

### Test Case 3: Close on Outside Click

**Steps:**
1. Buka notification dropdown
2. Klik di area content (di luar dropdown)
3. Dropdown otomatis tertutup

**Expected:** ✅ Pass

---

### Test Case 4: Mutual Exclusion

**Steps:**
1. Buka notification dropdown
2. Klik user menu
3. User menu terbuka, notification dropdown tertutup otomatis

**Expected:** ✅ Pass

---

### Test Case 5: Escape Key

**Steps:**
1. Buka salah satu dropdown
2. Press Escape key
3. Dropdown tertutup

**Expected:** ✅ Pass

---

### Test Case 6: Link Navigation

**Steps:**
1. Buka user menu dropdown
2. Klik "Profil Saya"
3. Navigate ke `/profile`

**Expected:** ✅ Pass

---

## 📱 Responsive Design

### Desktop (> 768px)
- Dropdown position: `absolute` di bawah button
- Width: 320px (notification), 200px (user)

### Mobile (< 768px)
- **TODO:** Perlu adjustment untuk mobile
- Suggestion: Full-width dropdown atau modal

---

## 🎨 Visual Design

### Notification Dropdown

```
┌─────────────────────────────┐
│ Notifikasi              [x] │
├─────────────────────────────┤
│                             │
│     🔔                      │
│  Tidak ada notifikasi baru  │
│                             │
└─────────────────────────────┘
```

### User Menu Dropdown

```
┌───────────────────────┐
│ 👤 Profil Saya        │
│ 🔒 Ubah Password      │
├───────────────────────┤
│ 🚪 Logout             │
└───────────────────────┘
```

---

## 🔮 Future Enhancements

### Notification Dropdown

- [ ] Load notifikasi dari database
- [ ] Badge count (jumlah notif unread)
- [ ] Mark as read functionality
- [ ] Real-time update (WebSocket)
- [ ] Load more / pagination

### User Menu Dropdown

- [ ] Show user role badge
- [ ] Quick stats (kamar, tagihan pending)
- [ ] Dark mode toggle
- [ ] Language selector

---

## 🐛 Troubleshooting

### Issue 1: Dropdown tidak muncul

**Solusi:**
```bash
# Check console untuk error
# Pastikan JavaScript loaded
# Refresh browser (Ctrl+F5)
```

### Issue 2: Animation tidak smooth

**Solusi:**
```css
/* Pastikan transition property ada */
transition: opacity 0.2s, transform 0.2s, visibility 0.2s;
```

### Issue 3: Dropdown tidak close on outside click

**Solusi:**
```javascript
// Pastikan event listener terpasang
document.addEventListener('click', function(e) { ... });
```

---

## 📚 References

- **Layout File:** `resources/views/layouts/app.blade.php`
- **CSS File:** `public/css/custom.css`
- **Icons:** Feather Icons (inline SVG)

---

**Dokumentasi dibuat oleh:** Kiro AI  
**Terakhir update:** 4 Juni 2026, 10:50 WIB
