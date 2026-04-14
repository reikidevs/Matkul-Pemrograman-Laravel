# Quick Reference - Repository Structure

## 📁 Standard Praktikum Structure

```
praktikum_XX_topic_name/
├── praktikum_laravel/              # Laravel code ONLY
│   ├── app/
│   ├── routes/
│   ├── resources/
│   └── ...
├── docs/                           # Documentation ONLY
│   ├── README.md                   # Main tutorial (required)
│   ├── CHANGELOG.md                # Changes log (required)
│   └── [Other guides]              # Optional guides
└── README.md                       # Brief overview (required)
```

## 🚫 Never Put in praktikum_laravel/

- ❌ Documentation files (*.md)
- ❌ Tutorial guides
- ❌ Screenshots
- ❌ Planning documents
- ❌ Notes or TODO lists

## ✅ Always Put in docs/

- ✅ README.md (detailed tutorial)
- ✅ CHANGELOG.md (version history)
- ✅ SUMMARY.md (implementation summary)
- ✅ TESTING.md (testing guide)
- ✅ TIPS.md (tips and tricks)
- ✅ [TOPIC].md (topic-specific guides)
- ✅ images/ folder (screenshots)

## 📝 File Naming

### Documentation Files
- `README.md` - Main documentation
- `CHANGELOG.md` - Version history
- `SUMMARY.md` - Quick summary
- `TESTING.md` - Testing procedures
- `TIPS.md` - Tips and tricks
- `BLADE_GUIDE.md` - Topic-specific guide
- `TEMPLATE_SETUP.md` - Setup instructions

### Code Files
- Controllers: `PascalCase` + `Controller.php`
  - Example: `MahasiswaController.php`
- Models: `PascalCase`, singular
  - Example: `Mahasiswa.php`
- Views: `lowercase.blade.php`
  - Example: `index.blade.php`
- Migrations: `YYYY_MM_DD_HHMMSS_description.php`

## 🎯 Root README.md Template

```markdown
# Praktikum XX: Topic Name

**Status:** ✅ Selesai

Brief description here...

## 📖 Dokumentasi Lengkap

Baca dokumentasi lengkap di: **[docs/README.md](docs/README.md)**

## 🎯 Tujuan Pembelajaran

- Learning objective 1
- Learning objective 2

## 🚀 Quick Start

\`\`\`bash
cd praktikum_XX/praktikum_laravel
composer install
php artisan serve
\`\`\`

## 📚 File Dokumentasi

- [README.md](docs/README.md) - Tutorial lengkap
- [CHANGELOG.md](docs/CHANGELOG.md) - Perubahan
- [SUMMARY.md](docs/SUMMARY.md) - Ringkasan

---

**Previous:** [Praktikum YY](../praktikum_YY/README.md)  
**Next:** [Praktikum ZZ](../praktikum_ZZ/README.md)
```

## 📋 Checklist Before Commit

- [ ] No .md files in `praktikum_laravel/`
- [ ] All .md files in `docs/` folder
- [ ] Root README.md exists (brief)
- [ ] docs/README.md exists (detailed)
- [ ] docs/CHANGELOG.md exists
- [ ] No temporary files (.tmp, .bak)
- [ ] No vendor/ or node_modules/
- [ ] No .env file (only .env.example)
- [ ] Proper folder structure maintained

## 🔧 Common Commands

### Create New Praktikum
```bash
# Create structure
mkdir -p praktikum_XX_topic/docs

# Copy Laravel code
cp -r praktikum_YY/praktikum_laravel praktikum_XX_topic/

# Create documentation
touch praktikum_XX_topic/README.md
touch praktikum_XX_topic/docs/README.md
touch praktikum_XX_topic/docs/CHANGELOG.md
```

### Verify Structure
```bash
# Check docs folders exist
ls -d praktikum_*/docs/

# Check no .md in Laravel folders
find praktikum_*/praktikum_laravel -name "*.md" -type f

# List all documentation
find praktikum_*/docs -name "*.md"
```

## 🎨 Bahasa Indonesia Guidelines

### Documentation Language
- Use clear, instructional Indonesian
- Include code examples with comments
- Provide clear file paths
- Use consistent terminology

### Code Comments
```php
// ✅ GOOD: Clear Indonesian comments
// Ambil semua data mahasiswa dari database
$mahasiswa = Mahasiswa::all();

// Kirim data ke view
return view('mahasiswa.index', compact('mahasiswa'));
```

## 🚀 Git Commit Format

```
[PraktikumXX] Brief description in Indonesian

Optional detailed description
```

Examples:
```
[Praktikum02] Tambah MahasiswaController dan route /mahasiswa
[Praktikum03] Implementasi tabel HTML dengan Blade @foreach
[Praktikum04] Setup master template dengan @extends
```

## 📖 Quick Links

- [Product Overview](.kiro/steering/product.md)
- [Tech Stack](.kiro/steering/tech.md)
- [Project Structure](.kiro/steering/structure.md)
- [Coding Conventions](.kiro/steering/conventions.md)
- [Contributing Guide](../CONTRIBUTING.md)
