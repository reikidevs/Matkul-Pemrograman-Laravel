# Coding Conventions & Best Practices

## File Organization Principles

### 1. Separation of Code and Documentation

**CRITICAL RULE: Keep code and documentation completely separate**

```
✅ CORRECT Structure:
praktikum_XX/
├── praktikum_laravel/          # ONLY Laravel code
│   ├── app/
│   ├── routes/
│   └── resources/
├── docs/                       # ALL documentation
│   ├── README.md
│   └── CHANGELOG.md
└── README.md                   # Brief entry point

❌ WRONG Structure:
praktikum_XX/
└── praktikum_laravel/
    ├── app/
    ├── routes/
    ├── README.md              # ❌ NO! Docs don't belong here
    └── TUTORIAL.md            # ❌ NO! Keep docs separate
```

### 2. Clean Laravel Folder

The `praktikum_laravel/` directory must remain clean and contain ONLY:
- Laravel framework files
- Application code (Controllers, Models, Views)
- Configuration files
- Asset files (CSS, JS, images for the app)
- Dependency files (composer.json, package.json)

**Never put these in `praktikum_laravel/`:**
- Documentation files (*.md)
- Tutorial guides
- Screenshots for documentation
- Planning documents
- Notes or TODO lists

### 3. Documentation Folder Structure

All documentation must be in the `docs/` folder:

```
docs/
├── README.md                   # Main tutorial (required)
├── CHANGELOG.md                # Version history (required)
├── SUMMARY.md                  # Quick summary (optional)
├── TESTING.md                  # Testing guide (optional)
├── TIPS.md                     # Tips & tricks (optional)
├── TROUBLESHOOTING.md          # Common issues (optional)
├── BLADE_GUIDE.md              # Topic-specific guide (optional)
└── images/                     # Screenshots folder
    ├── step-1-create-controller.png
    ├── step-2-add-route.png
    └── final-result.png
```

## Naming Conventions

### Files and Folders

**Folders:**
- Praktikum folders: `praktikum_XX_topic_name` (lowercase with underscores)
- Laravel folders: Follow Laravel conventions (`app`, `resources`, `database`)
- Documentation folder: `docs` (lowercase, no plural)
- Image folder: `images` (lowercase, plural)

**Documentation Files:**
- Use UPPERCASE for markdown files: `README.md`, `CHANGELOG.md`, `SUMMARY.md`
- Use descriptive names: `BLADE_GUIDE.md`, `TESTING.md`, `TIPS.md`
- Use hyphens for multi-word topics: `TEMPLATE_SETUP.md`, `IMPORTANT_NOTES.md`

**Code Files:**
- Controllers: `PascalCase` + `Controller.php` → `MahasiswaController.php`
- Models: `PascalCase`, singular → `Mahasiswa.php`, `ProgramStudi.php`
- Views: `lowercase.blade.php` → `index.blade.php`, `create.blade.php`
- Migrations: `YYYY_MM_DD_HHMMSS_description.php`

### Routes and URLs

- Use lowercase with hyphens: `/mahasiswa`, `/program-studi`
- RESTful naming: `/mahasiswa/create`, `/mahasiswa/{id}/edit`
- Avoid underscores in URLs: ❌ `/program_studi` → ✅ `/program-studi`

### Database

- Tables: `lowercase`, plural, `snake_case` → `mahasiswas`, `program_studis`
- Columns: `lowercase`, `snake_case` → `first_name`, `created_at`
- Foreign keys: `singular_id` → `mahasiswa_id`, `prodi_id`

## Code Style

### PHP/Laravel

**Controller Methods:**
```php
// ✅ GOOD: Clear, descriptive method names
public function index()
{
    $mahasiswa = Mahasiswa::all();
    return view('mahasiswa.index', compact('mahasiswa'));
}

// ❌ BAD: Unclear, abbreviated names
public function idx()
{
    $mhs = Mahasiswa::all();
    return view('mahasiswa.index', ['mhs' => $mhs]);
}
```

**Variable Naming:**
```php
// ✅ GOOD: Descriptive Indonesian or English
$mahasiswa = [...];
$dataMahasiswa = [...];
$listMahasiswa = [...];

// ❌ BAD: Abbreviated or unclear
$mhs = [...];
$data = [...];
$arr = [...];
```

**Comments in Bahasa Indonesia:**
```php
// ✅ GOOD: Clear Indonesian comments
// Ambil semua data mahasiswa dari database
$mahasiswa = Mahasiswa::all();

// Kirim data ke view
return view('mahasiswa.index', compact('mahasiswa'));

// ❌ BAD: No comments or unclear
$mahasiswa = Mahasiswa::all();
return view('mahasiswa.index', compact('mahasiswa'));
```

### Blade Templates

**Indentation:**
```blade
{{-- ✅ GOOD: Proper indentation --}}
<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswa as $index => $mhs)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $mhs->nama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- ❌ BAD: No indentation --}}
<table>
<thead>
<tr>
<th>NO</th>
<th>NAMA</th>
</tr>
</thead>
</table>
```

**Blade Directives:**
```blade
{{-- ✅ GOOD: Use Blade directives --}}
@if($mahasiswa->count() > 0)
    <p>Ada {{ $mahasiswa->count() }} mahasiswa</p>
@else
    <p>Tidak ada data</p>
@endif

{{-- ❌ BAD: Use PHP tags --}}
<?php if($mahasiswa->count() > 0): ?>
    <p>Ada <?= $mahasiswa->count() ?> mahasiswa</p>
<?php endif; ?>
```

## Git Commit Messages

**Format:**
```
[PraktikumXX] Brief description in Indonesian

Optional detailed description
```

**Examples:**
```
✅ GOOD:
[Praktikum02] Tambah MahasiswaController dan route /mahasiswa

- Buat controller dengan method index()
- Tambah route GET /mahasiswa
- Buat view mahasiswa/index.blade.php

✅ GOOD:
[Praktikum03] Implementasi tabel HTML dengan Blade @foreach

✅ GOOD:
[Praktikum04] Setup master template dengan @extends dan @section

❌ BAD:
update files

❌ BAD:
add controller

❌ BAD:
fix bug
```

## Documentation Writing Style

### Bahasa Indonesia Guidelines

**Use clear, instructional language:**
```markdown
✅ GOOD:
## Langkah 1: Buat Controller

Jalankan perintah artisan berikut untuk membuat controller:

\`\`\`bash
php artisan make:controller MahasiswaController
\`\`\`

❌ BAD:
## Step 1

Run this:
\`\`\`bash
php artisan make:controller MahasiswaController
\`\`\`
```

**Include code examples:**
```markdown
✅ GOOD:
Edit file `app/Http/Controllers/MahasiswaController.php`:

\`\`\`php
public function index()
{
    // Ambil semua data mahasiswa
    $mahasiswa = Mahasiswa::all();
    
    // Kirim ke view
    return view('mahasiswa.index', compact('mahasiswa'));
}
\`\`\`

❌ BAD:
Edit the controller and add the index method.
```

**Provide clear file paths:**
```markdown
✅ GOOD:
Buat file baru di `resources/views/mahasiswa/index.blade.php`

❌ BAD:
Create a new view file
```

## Folder Cleanliness Checklist

Before committing, verify:
- [ ] No documentation files in `praktikum_laravel/`
- [ ] All `.md` files are in `docs/` folder
- [ ] No temporary files (`.tmp`, `.bak`, `.swp`)
- [ ] No IDE-specific files (`.vscode/`, `.idea/`) unless in `.gitignore`
- [ ] No `vendor/` or `node_modules/` folders
- [ ] No `.env` file (only `.env.example`)
- [ ] Proper folder structure maintained
- [ ] All images in `docs/images/` folder
- [ ] Clear separation between code and documentation

## Quick Reference

**When creating new praktikum:**
1. Create folder: `praktikum_XX_topic_name/`
2. Copy Laravel: `praktikum_laravel/` (code only)
3. Create docs: `docs/` folder
4. Add root `README.md` (brief)
5. Add `docs/README.md` (detailed)
6. Add `docs/CHANGELOG.md`
7. Keep structure clean and organized
