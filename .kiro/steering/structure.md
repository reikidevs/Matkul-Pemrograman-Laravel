# Project Structure

## Repository Organization

This repository uses a **multi-project structure** where each praktikum is a separate, self-contained Laravel installation:

```
pbkk-laravel-2026/
├── praktikum_01_install/
│   ├── praktikum_laravel/          # Complete Laravel project
│   └── README.md                   # Praktikum instructions
├── praktikum_02_routing_controller/
│   ├── praktikum_laravel/          # Complete Laravel project
│   └── README.md
├── praktikum_03_blade_template/
│   ├── praktikum_laravel/
│   └── README.md
├── praktikum_04_master_template/
│   ├── praktikum_laravel/
│   └── README.md
├── praktikum_05_migration_model_seeder/
│   └── README.md
├── .kiro/
│   └── steering/                   # AI assistant guidance
├── README.md                       # Main documentation
├── CONTRIBUTING.md                 # Git workflow guide
├── QUICK_START.md                  # Quick reference
└── PROGRESS.md                     # Progress tracking
```

## Praktikum Folder Pattern

Each praktikum follows this structure:

```
praktikum_XX_topic_name/
├── praktikum_laravel/              # Laravel installation (CODE ONLY)
│   ├── app/                        # Application code
│   ├── routes/                     # Route definitions
│   ├── resources/views/            # Blade templates
│   ├── database/                   # Migrations, seeders, factories
│   ├── config/                     # Configuration files
│   ├── public/                     # Public assets
│   ├── composer.json               # PHP dependencies
│   └── .env.example                # Environment template
├── docs/                           # Documentation folder (SEPARATE)
│   ├── README.md                   # Step-by-step instructions
│   ├── CHANGELOG.md                # Changes from previous praktikum
│   ├── SUMMARY.md                  # Summary of implementation
│   ├── TESTING.md                  # Testing guide (if applicable)
│   └── [Additional guides]         # Optional documentation
└── README.md                       # Main entry point (links to docs/)
```

### CRITICAL: Documentation Separation Rules

**NEVER mix documentation with code:**
- ❌ **WRONG**: `praktikum_laravel/README.md` (inside Laravel folder)
- ✅ **CORRECT**: `praktikum_XX/docs/README.md` (separate docs folder)
- ✅ **CORRECT**: `praktikum_XX/README.md` (root level, brief overview)

**Documentation Structure:**
```
praktikum_XX_topic_name/
├── README.md                       # Brief overview + link to docs/
└── docs/
    ├── README.md                   # Main detailed instructions
    ├── CHANGELOG.md                # What changed from previous praktikum
    ├── SUMMARY.md                  # Implementation summary
    ├── TIPS.md                     # Tips and tricks
    ├── TESTING.md                  # How to test
    └── images/                     # Screenshots (if needed)
        └── screenshot.png
```

**Root README.md Template:**
```markdown
# Praktikum XX: Topic Name

**Status:** ✅ Selesai

Quick overview here...

📖 **[Baca Dokumentasi Lengkap](docs/README.md)**

## Quick Start
```bash
cd praktikum_XX/praktikum_laravel
composer install
php artisan serve
```
```

## Standard Laravel Structure

Within each `praktikum_laravel/` folder:

### Application Layer (`app/`)
```
app/
├── Console/                        # Artisan commands
├── Exceptions/                     # Exception handlers
├── Http/
│   ├── Controllers/                # Request handlers
│   ├── Middleware/                 # HTTP middleware
│   └── Kernel.php                  # HTTP kernel
├── Models/                         # Eloquent models
└── Providers/                      # Service providers
```

### Routes (`routes/`)
```
routes/
├── web.php                         # Web routes (primary)
├── api.php                         # API routes
├── console.php                     # Console commands
└── channels.php                    # Broadcast channels
```

### Views (`resources/views/`)
```
resources/views/
├── welcome.blade.php               # Default homepage
├── mahasiswa/                      # Example: student views
│   └── index.blade.php
└── layouts/                        # Master templates (Praktikum 04+)
    └── master.blade.php
```

### Database (`database/`)
```
database/
├── migrations/                     # Database schema versions
├── seeders/                        # Database seeders
└── factories/                      # Model factories
```

## Naming Conventions

### Controllers
- **Format**: `PascalCase` with `Controller` suffix
- **Location**: `app/Http/Controllers/`
- **Example**: `MahasiswaController.php`

### Models
- **Format**: `PascalCase`, singular noun
- **Location**: `app/Models/`
- **Example**: `Mahasiswa.php`

### Views
- **Format**: `lowercase` with `.blade.php` extension
- **Location**: `resources/views/`
- **Organization**: Group by feature in subdirectories
- **Example**: `mahasiswa/index.blade.php`

### Routes
- **Format**: `lowercase` with hyphens
- **Example**: `/mahasiswa`, `/mahasiswa/create`

### Database Tables
- **Format**: `lowercase`, plural, snake_case
- **Example**: `mahasiswas`, `program_studis`

### Migrations
- **Format**: `YYYY_MM_DD_HHMMSS_description.php`
- **Example**: `2024_04_14_000000_create_mahasiswas_table.php`

## Incremental Development Pattern

Each praktikum is created by:
1. **Copying** the previous praktikum's `praktikum_laravel/` folder
2. **Adding** new features on top of existing code
3. **Documenting** changes in README.md and CHANGELOG.md

This means:
- Praktikum 02 = Praktikum 01 + Routing & Controllers
- Praktikum 03 = Praktikum 02 + Blade Templates
- Praktikum 04 = Praktikum 03 + Master Templates
- And so on...

## Documentation Standards

### README.md Structure
Each praktikum has TWO README files:

**1. Root README.md** (Brief overview):
- Status badge
- Quick description
- Link to full documentation
- Quick start commands

**2. docs/README.md** (Detailed instructions):
1. **Status**: Completion status (✅ Selesai, 🔜 Ready, ⏳ Coming)
2. **Tujuan Pembelajaran**: Learning objectives
3. **Instruksi Praktikum**: Assignment description
4. **Persiapan**: Setup instructions (copy from previous)
5. **Langkah-Langkah**: Step-by-step implementation
6. **Checklist**: Verification checklist
7. **Eksplorasi Tambahan**: Optional exercises
8. **Troubleshooting**: Common issues and solutions

### Documentation File Organization
```
docs/
├── README.md                       # Main tutorial (always required)
├── CHANGELOG.md                    # Version history (always required)
├── SUMMARY.md                      # Quick summary (optional)
├── TESTING.md                      # Testing procedures (optional)
├── TIPS.md                         # Best practices (optional)
├── TROUBLESHOOTING.md              # Common issues (optional)
└── images/                         # Visual aids (optional)
```

### Code Comments
- Use **Bahasa Indonesia** for comments
- Comment complex logic and business rules
- Include inline documentation for learning purposes

## Clean Folder Organization Rules

### 1. Separation of Concerns
- **Code**: Lives in `praktikum_laravel/` only
- **Documentation**: Lives in `docs/` folder only
- **Root files**: Only essential files (README.md, .gitignore)

### 2. No Clutter in Laravel Folder
The `praktikum_laravel/` folder should ONLY contain:
- Laravel framework files
- Application code (controllers, models, views)
- Configuration files
- Dependencies definition (composer.json)

**NEVER put in `praktikum_laravel/`:**
- ❌ Documentation files (README.md, CHANGELOG.md, etc.)
- ❌ Tutorial guides
- ❌ Screenshots or images for documentation
- ❌ Notes or planning documents

### 3. Documentation Folder Structure
```
docs/
├── README.md                       # Main instructions (required)
├── CHANGELOG.md                    # Changes log (required)
├── SUMMARY.md                      # Implementation summary (optional)
├── TESTING.md                      # Testing guide (optional)
├── TIPS.md                         # Tips and tricks (optional)
├── TROUBLESHOOTING.md              # Common issues (optional)
└── images/                         # Screenshots folder
    ├── step1.png
    └── result.png
```

### 4. Root Level Organization
```
praktikum_XX_topic_name/
├── praktikum_laravel/              # Laravel code (clean, no docs)
├── docs/                           # All documentation here
├── README.md                       # Brief entry point
└── .gitkeep                        # Keep empty folders in Git
```

### 5. Naming Consistency
- **Folders**: `lowercase_with_underscores`
- **Documentation**: `UPPERCASE.md` (e.g., README.md, CHANGELOG.md)
- **Code files**: Follow Laravel conventions

## File Exclusions

Never commit to Git:
- `/vendor/` - Regenerated by `composer install`
- `/node_modules/` - Regenerated by `npm install`
- `.env` - Contains sensitive credentials
- `/storage/logs/*.log` - Runtime logs
- `/storage/framework/cache/` - Cache files
- `/docs/images/*.tmp` - Temporary images

Always commit:
- `.env.example` - Template for environment variables
- `composer.json` and `composer.lock` - Dependency definitions
- All source code files
- Migration and seeder files
- All documentation in `docs/` folder
- Screenshots in `docs/images/` (if needed)
