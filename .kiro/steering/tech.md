# Technology Stack

## Framework & Language

- **Laravel**: 10.x (Laravel Framework)
- **PHP**: 8.1 - 8.4
- **Blade**: Laravel's templating engine

## Key Dependencies

### Production
- `laravel/framework`: ^10.0
- `laravel/sanctum`: ^3.2 (API authentication)
- `laravel/tinker`: ^2.8 (REPL)
- `guzzlehttp/guzzle`: ^7.2 (HTTP client)

### Development
- `phpunit/phpunit`: ^10.0 (Testing)
- `laravel/pint`: ^1.0 (Code style)
- `laravel/sail`: ^1.18 (Docker environment)
- `fakerphp/faker`: ^1.9.1 (Fake data generation)
- `spatie/laravel-ignition`: ^2.0 (Error page)

## Database

- **MySQL**: 8.0+ (Primary database)
- **SQLite**: Supported for testing

## Build Tools

- **Composer**: PHP dependency manager
- **NPM/Yarn**: JavaScript dependencies (optional)

## Common Commands

### Initial Setup
```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Development Server
```bash
# Start development server (default port 8000)
php artisan serve

# Use alternative port
php artisan serve --port=8001
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seed
php artisan migrate:fresh --seed
```

### Code Generation
```bash
# Create controller
php artisan make:controller ControllerName

# Create model
php artisan make:model ModelName

# Create migration
php artisan make:migration create_table_name

# Create seeder
php artisan make:seeder SeederName
```

### Debugging & Maintenance
```bash
# List all routes
php artisan route:list

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerate autoload files
composer dump-autoload
```

### Testing
```bash
# Run PHPUnit tests
php artisan test

# Or use vendor binary
./vendor/bin/phpunit
```

## Environment Configuration

Key `.env` variables:
- `APP_KEY`: Application encryption key (auto-generated)
- `DB_CONNECTION`: Database driver (mysql, sqlite, etc.)
- `DB_HOST`: Database host (127.0.0.1)
- `DB_PORT`: Database port (3306 for MySQL)
- `DB_DATABASE`: Database name
- `DB_USERNAME`: Database username
- `DB_PASSWORD`: Database password

## File Permissions (Linux/Mac)

```bash
# Set proper permissions for storage and cache
chmod -R 775 storage bootstrap/cache
```

## Version Control

Files excluded from Git (per `.gitignore`):
- `/vendor/` - Composer dependencies
- `/node_modules/` - NPM dependencies
- `.env` - Environment configuration (sensitive)
- `/storage/logs/` - Log files
- `/storage/framework/cache/` - Cache files
- `/public/hot` - Vite hot reload file
