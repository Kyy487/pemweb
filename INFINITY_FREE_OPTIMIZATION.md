# Optimasi Project untuk Infinity Free

## 📊 Analisis Ukuran Saat Ini

Infinity Free memiliki batasan file (~30,000 inode). Mari kita optimalkan:

```
vendor/           → 50-100MB, ~5000+ files
node_modules/     → 300-500MB, ~10000+ files (DON'T UPLOAD)
storage/logs/     → Clean regularly
```

---

## 🛠️ Step 1: Kurangi Dependencies

### Audit Packages
```bash
# List all packages
composer show

# Check unused packages
composer suggests
```

### Remove Unnecessary Packages

**Common packages to remove:**
- `laravel/sail` (development only)
- `laravel/dusk` (testing only)
- `laravel/breeze` (scaffolding only)
- Development packages

**Update composer.json:**
```bash
composer remove laravel/sail --no-scripts
composer remove laravel/dusk --dev
```

### Optimize require-dev

Keep only what's needed for testing, remove rest:

```json
"require-dev": {
    "phpunit/phpunit": "^9.5",
    "laravel/tinker": "^2.5"
}
```

---

## 📦 Step 2: Build Assets for Production

### Pre-compile CSS & JavaScript

```bash
# Install dependencies
npm install

# Build for production (minify, optimize)
npm run production

# Verify output
ls -la public/css/
ls -la public/js/

# Result: small .js and .css files, no maps
```

### Remove Source Files

```bash
# After build, remove source maps (optional)
rm public/js/*.map
rm public/css/*.map
```

---

## 💾 Step 3: Optimize Vendor Folder

### Remove Unused Files

```bash
# Via Composer
composer install --no-dev --optimize-autoloader

# Remove unnecessary vendor files
cd vendor
find . -name "*.md" -delete        # Remove README files
find . -name "*.txt" -delete       # Remove txt files
find . -name "tests" -type d -exec rm -rf {} +   # Remove test folders
find . -name "examples" -type d -exec rm -rf {} +
find . -name "docs" -type d -exec rm -rf {} +
cd ..
```

### Remove Unnecessary Packages

```bash
# Create a minimal composer.json for production
composer install --no-dev --no-dev --ignore-platform-reqs --no-interaction
```

---

## 🧹 Step 4: Clean Up Project Structure

### Files to REMOVE before upload:

```bash
# Version control
rm -rf .git

# Package managers
rm -rf node_modules/
rm -rf .npmrc

# Testing
rm -rf tests/
rm phpunit.xml

# IDE files
rm -rf .vscode/
rm -rf .idea/
rm .editorconfig

# Git files
rm .gitignore
rm .gitattributes

# CI/CD
rm -rf .github/
rm -rf .gitlab-ci.yml

# Temporary/Log files
rm -rf storage/logs/*
rm storage/framework/cache/*

# OS files
rm -rf .DS_Store
rm -rf Thumbs.db
```

### Keep important files:

```
✓ .env (production config)
✓ .htaccess (URL rewriting)
✓ composer.json (for reference)
✓ package.json (for reference)
✓ config/
✓ app/
✓ routes/
✓ database/
```

---

## 📋 Step 5: Optimize Configuration

### config/app.php

```php
// Change to production values
'debug' => false,
'env' => 'production',

// Cache config (file-based for Infinity Free)
'cache' => env('CACHE_DRIVER', 'file'),
```

### config/database.php

```php
// Use single connection
'default' => env('DB_CONNECTION', 'mysql'),

'connections' => [
    'mysql' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', 'localhost'),
        // ... keep only one connection type
    ]
]
```

### config/logging.php

```php
// Use file logging only
'default' => env('LOG_CHANNEL', 'single'),

'channels' => [
    'single' => [
        'driver' => 'single',
        'path' => storage_path('logs/laravel.log'),
        'level' => env('LOG_LEVEL', 'error'),
    ],
]
```

---

## 🔒 Step 6: Security Optimization

### Hide Sensitive Files

Add to `.htaccess`:

```apache
# Deny access to sensitive files
<FilesMatch "^\.env|^\.git|composer\.(json|lock)$|package\.json$|\.md$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

### Disable Directory Listing

```apache
<Directory />
    Options -Indexes
</Directory>
```

---

## 📈 Step 7: Performance Optimization

### Enable Caching

```php
// config/cache.php
'default' => env('CACHE_DRIVER', 'file'),

'stores' => [
    'file' => [
        'driver' => 'file',
        'path' => storage_path('framework/cache/data'),
    ],
]
```

### Query Optimization

In your models:

```php
// Use select() to limit columns
Model::select('id', 'name', 'email')->get();

// Use eager loading
$users = User::with('posts', 'comments')->get();

// Use chunking for large datasets
Model::chunk(100, function($users) {
    // Process batch
});
```

### Database Indexing

Add to migrations:

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('email')->unique()->index();
    $table->string('name')->index();
    $table->timestamps();
});
```

---

## 🚀 Step 8: Final Optimization Commands

```bash
# 1. Clear cache
php artisan cache:clear

# 2. Optimize configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 3. Dump autoloader (optimized)
composer dump-autoload --optimize

# 4. Build assets
npm run production

# 5. Verify vendor size
du -sh vendor/
du -sh public/

# 6. List all files (for upload)
find . -type f ! -path './node_modules/*' ! -path './.git/*' | wc -l
```

---

## 📦 Checklist Before Upload

- [ ] `composer install --no-dev --optimize-autoloader`
- [ ] `npm run production`
- [ ] `rm -rf node_modules/`
- [ ] `rm -rf tests/`
- [ ] `php artisan cache:clear`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] Remove `.git/` folder
- [ ] Remove unnecessary vendor files
- [ ] Verify `.env` is correct
- [ ] Check vendor size < 100MB
- [ ] Verify total files < 10,000

---

## 💡 Monitoring After Deployment

### Watch Disk Space
```bash
# SSH (if available)
df -h
du -sh *
```

### Watch Inode Usage
```bash
# Check inode count
find . -type f | wc -l
```

### Clear Logs Regularly
```bash
# Via scheduled task or manual
php artisan tinker
# Then:
Storage::deleteDirectory('logs');
Storage::makeDirectory('logs');
```

---

## Result Sizes After Optimization

| Item | Before | After | Savings |
|------|--------|-------|---------|
| vendor/ | ~100MB | ~50MB | 50% |
| node_modules/ | ~500MB | 0MB | 100% |
| Total files | ~20,000 | ~5,000 | 75% |
| Disk usage | ~650MB | ~100MB | 85% |

---

## 🎯 Optimization Summary

✅ Removed dev dependencies  
✅ Pre-compiled assets  
✅ Cleaned vendor folder  
✅ Removed unnecessary files  
✅ Optimized configuration  
✅ Secured sensitive files  
✅ Optimized queries  

Your project is now **lightweight and ready for Infinity Free!** 🚀
