# ✅ INFINITY FREE DEPLOYMENT MASTER CHECKLIST

**Project:** AGANS (Sistem Informasi Sekolah)  
**Target:** Infinity Free Hosting  
**Status:** Ready for Deployment  

---

## 📚 Documentation Files Created

Panduan lengkap telah disiapkan. Baca dalam urutan ini:

1. ✅ **START HERE**: [INFINITY_FREE_QUICK_REF.md](INFINITY_FREE_QUICK_REF.md)
   - Quick reference guide
   - Waktu: 5 menit

2. ✅ **SETUP**: [INFINITY_FREE_SETUP.md](INFINITY_FREE_SETUP.md)
   - Persyaratan hosting
   - Struktur project
   - Langkah setup lengkap
   - Waktu: 15 menit

3. ✅ **CONFIGURATION**: [INFINITY_FREE_CONFIG.md](INFINITY_FREE_CONFIG.md)
   - Setup database
   - Konfigurasi PHP
   - Email setup
   - Waktu: 20 menit

4. ✅ **OPTIMIZATION**: [INFINITY_FREE_OPTIMIZATION.md](INFINITY_FREE_OPTIMIZATION.md)
   - Kurangi ukuran project
   - Optimasi dependencies
   - Tips performance
   - Waktu: 30 menit

5. ✅ **DEPLOYMENT**: [INFINITY_FREE_DEPLOYMENT_GUIDE.md](INFINITY_FREE_DEPLOYMENT_GUIDE.md)
   - Step-by-step deployment
   - Upload via FTP
   - Database migration
   - Testing
   - Waktu: 1-2 jam

6. ✅ **TROUBLESHOOTING**: [INFINITY_FREE_TROUBLESHOOTING.md](INFINITY_FREE_TROUBLESHOOTING.md)
   - Common errors & solutions
   - Diagnostic checklist
   - Support resources
   - Waktu: Reference as needed

---

## 🎯 PHASE 1: PERSIAPAN (Local Machine)

### Step 1.1: Optimize PHP Dependencies
- [ ] Run: `composer install --no-dev --optimize-autoloader`
- [ ] Verify vendor folder reduced
- [ ] Check: No development packages in vendor/

### Step 1.2: Build Frontend Assets
- [ ] Run: `npm install`
- [ ] Run: `npm run production`
- [ ] Verify: `public/css/app.css` exists
- [ ] Verify: `public/js/app.js` exists
- [ ] Check: Assets are minified

### Step 1.3: Clear & Optimize Caches
- [ ] Run: `php artisan cache:clear`
- [ ] Run: `php artisan config:cache`
- [ ] Run: `php artisan route:cache`
- [ ] Run: `php artisan view:cache`
- [ ] Check: `bootstrap/cache/config.php` created
- [ ] Check: `bootstrap/cache/routes-v7.php` created

### Step 1.4: Prepare Environment
- [ ] Copy `.env.infinity-free` to `.env`
- [ ] OR manually update `.env` with production values
- [ ] Set: `APP_ENV=production`
- [ ] Set: `APP_DEBUG=false`
- [ ] Set: `APP_KEY=base64:xxx` (generate if needed)
- [ ] Update: `APP_URL=https://yourdomain.com`

### Step 1.5: Cleanup Project
- [ ] Delete: `node_modules/` folder
- [ ] Delete: `tests/` folder (optional)
- [ ] Delete: `.git/` folder (optional)
- [ ] Delete: `.github/` folder
- [ ] Delete: `phpunit.xml` (if not needed)
- [ ] Delete: `.editorconfig`
- [ ] Keep: All app/ config/ routes/ etc.
- [ ] Keep: composer.json and composer.lock
- [ ] Keep: public/ folder with built assets

### Step 1.6: Verify Local Installation
- [ ] Run: `php artisan serve`
- [ ] Test: http://localhost:8000 loads
- [ ] Test: No 500 errors
- [ ] Check: Homepage renders correctly
- [ ] Stop server: Press Ctrl+C

---

## 🌐 PHASE 2: INFINITY FREE SETUP

### Step 2.1: Create Infinity Free Account
- [ ] Create account at https://www.infinityfree.net/
- [ ] Verify email
- [ ] Login to panel
- [ ] Add domain (or use free domain)
- [ ] Wait for domain activation (15-60 minutes)
- [ ] Note: FTP credentials

### Step 2.2: Configure Infinity Free Control Panel
- [ ] Set PHP version to 8.0 (or 7.4+)
- [ ] Enable mod_rewrite
- [ ] Set document root to: `/public_html/public`
- [ ] Enable SSL/HTTPS (Let's Encrypt auto)
- [ ] Verify HTTPS working

### Step 2.3: Create MySQL Database
- [ ] Go to MySQL Databases section
- [ ] Create new database
- [ ] Note database name (e.g., `user_agans`)
- [ ] Create database user
- [ ] Note username (e.g., `user_agans_user`)
- [ ] Note password
- [ ] Assign user to database with all privileges
- [ ] Test: Login to phpmyadmin with credentials

### Step 2.4: Prepare .env for Production
- [ ] Update: `DB_HOST=localhost`
- [ ] Update: `DB_DATABASE=your_database_name`
- [ ] Update: `DB_USERNAME=your_database_user`
- [ ] Update: `DB_PASSWORD=your_database_password`
- [ ] Update: `APP_URL=https://yourdomain.com`
- [ ] Update: `MAIL_*` settings (Gmail or hosting email)
- [ ] Set: `CACHE_DRIVER=file`
- [ ] Set: `SESSION_DRIVER=file`
- [ ] SAVE .env file locally

---

## 📤 PHASE 3: UPLOAD TO INFINITY FREE

### Step 3.1: Prepare FTP Connection
- [ ] Download FileZilla (if not have): https://filezilla-project.org/
- [ ] Open FileZilla
- [ ] Create new site:
  - Host: `ftp.yourdomain.com`
  - Username: Your FTP username
  - Password: Your FTP password
  - Port: 21
- [ ] Test connection
- [ ] Verify: Connected successfully

### Step 3.2: Upload Project Files
- [ ] Connect via FTP
- [ ] Navigate to: `/public_html/`
- [ ] Upload folders:
  - [ ] `app/`
  - [ ] `bootstrap/`
  - [ ] `config/`
  - [ ] `database/`
  - [ ] `resources/`
  - [ ] `routes/`
  - [ ] `storage/` (all subdirectories)
  - [ ] `vendor/`
  - [ ] `public/`
- [ ] Upload files:
  - [ ] `.env` (production config)
  - [ ] `.htaccess` (root)
  - [ ] `artisan`
  - [ ] `composer.json`
  - [ ] `composer.lock`
  - [ ] `server.php`
- [ ] **SKIP**: `node_modules/`, `tests/`, `.git/`

### Step 3.3: Set File Permissions
- [ ] Via FTP File Manager, set permissions:
  - [ ] `storage/` → 755 (writable)
  - [ ] `bootstrap/cache/` → 755 (writable)
  - [ ] `.env` → 644
  - [ ] `.htaccess` → 644
  - [ ] `public/` → 755
  - [ ] Other folders → 755
  - [ ] Other files → 644

### Step 3.4: Verify .htaccess Files
- [ ] Verify: `.htaccess` exists in `/public_html/`
- [ ] Verify: `.htaccess` exists in `/public_html/public/`
- [ ] Both should be uploaded correctly

### Step 3.5: Verify File Upload
- [ ] Via FTP, check:
  - [ ] `/public_html/.env` exists
  - [ ] `/public_html/public/index.php` exists
  - [ ] `/public_html/vendor/autoload.php` exists
  - [ ] `/public_html/storage/` writable

---

## 🗄️ PHASE 4: DATABASE SETUP

### Step 4.1: Verify Database
- [ ] Go to phpmyadmin in Infinity Free panel
- [ ] Verify database exists
- [ ] Verify database user can access

### Step 4.2: Run Migrations

**Option A: Via SSH (if available)**
```bash
ssh user@host
cd /home/user/public_html
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder (optional)
exit
```

**Option B: Via Web Route (Temporary)**

1. Edit `routes/web.php` and add:
```php
Route::get('/setup', function () {
    if (env('APP_ENV') !== 'production') abort(403);
    
    Artisan::call('migrate', ['--force' => true]);
    return 'Database migrated!';
});
```

2. Upload `routes/web.php` again

3. Visit: `https://yourdomain.com/setup`

4. Should see: "Database migrated!"

5. DELETE this route from `routes/web.php`

6. Re-upload `routes/web.php`

### Step 4.3: Verify Migration
- [ ] Check tables created in phpmyadmin
- [ ] Verify: `users`, `roles`, `permissions` tables exist
- [ ] Verify: No migration errors in logs

---

## ✅ PHASE 5: POST-DEPLOYMENT TESTING

### Step 5.1: Test Homepage
- [ ] Visit: `https://yourdomain.com`
- [ ] Verify: Page loads successfully
- [ ] Verify: No 500 errors
- [ ] Verify: Content displays correctly
- [ ] Check: Browser address bar shows 🔒 HTTPS lock

### Step 5.2: Test Database Connection
Create temporary route and test:

```php
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Database: OK ✓';
    } catch (Exception $e) {
        return 'Database Error: ' . $e->getMessage();
    }
});
```

- [ ] Visit: `https://yourdomain.com/test-db`
- [ ] Should see: "Database: OK ✓"
- [ ] Remove route after testing

### Step 5.3: Test File Storage
Create temporary route:

```php
Route::get('/test-storage', function () {
    try {
        Storage::put('test.txt', 'test content');
        $exists = Storage::exists('test.txt');
        Storage::delete('test.txt');
        return $exists ? 'Storage: OK ✓' : 'Storage: FAILED';
    } catch (Exception $e) {
        return 'Storage Error: ' . $e->getMessage();
    }
});
```

- [ ] Visit: `https://yourdomain.com/test-storage`
- [ ] Should see: "Storage: OK ✓"
- [ ] Remove route after testing

### Step 5.4: Test Logging
Create temporary route:

```php
Route::get('/test-log', function () {
    Log::info('Test log entry');
    return 'Log test - check storage/logs/laravel.log';
});
```

- [ ] Visit: `https://yourdomain.com/test-log`
- [ ] Via FTP, download: `storage/logs/laravel.log`
- [ ] Verify: Log entry exists
- [ ] Remove route after testing

### Step 5.5: Test Assets (CSS/JS)
- [ ] Visit: `https://yourdomain.com`
- [ ] Press F12 (Open Dev Tools)
- [ ] Go to Console tab
- [ ] Verify: No CSS or JS 404 errors
- [ ] Go to Network tab
- [ ] Check: app.css loads with 200 status
- [ ] Check: app.js loads with 200 status

### Step 5.6: Check Error Logs
- [ ] Via FTP download: `storage/logs/laravel.log`
- [ ] Open in text editor
- [ ] Verify: No error entries
- [ ] OR: No unexpected errors

---

## 🔒 PHASE 6: SECURITY & CLEANUP

### Step 6.1: Remove Debug Mode
- [ ] Edit `.env` via FTP
- [ ] Set: `APP_DEBUG=false`
- [ ] Save and upload

### Step 6.2: Remove Temporary Routes
- [ ] Edit `routes/web.php` via FTP
- [ ] Delete: `/test-db`, `/test-storage`, `/test-log`, `/setup` routes
- [ ] Upload updated `routes/web.php`

### Step 6.3: Verify Security
- [ ] Verify `.env` is not accessible
- [ ] Test: `https://yourdomain.com/.env` → Should get 403 or 404
- [ ] Verify: `.htaccess` protecting sensitive files
- [ ] Test: `https://yourdomain.com/.git/` → Should get 403 or 404

### Step 6.4: Set Up Monitoring
- [ ] Setup daily backup (if Infinity Free offers)
- [ ] Note FTP credentials somewhere safe
- [ ] Add to calendar: Check logs weekly
- [ ] Add to calendar: Monitor disk space monthly

---

## 📊 PHASE 7: VERIFICATION CHECKLIST

### General
- [ ] Domain resolves to HTTPS
- [ ] SSL certificate valid (🔒 lock shows)
- [ ] No browser warnings
- [ ] APP_DEBUG=false
- [ ] APP_ENV=production

### Functionality
- [ ] Homepage loads without error
- [ ] Database connection works
- [ ] User can login (if applicable)
- [ ] File storage works
- [ ] Email sending works (if configured)
- [ ] All main features working

### Performance
- [ ] Page load time < 2 seconds
- [ ] No memory exhausted errors
- [ ] No timeout errors
- [ ] Database queries responsive

### Security
- [ ] HTTPS working
- [ ] .env not accessible
- [ ] Sensitive files protected
- [ ] APP_KEY set
- [ ] Permissions correct

### Monitoring
- [ ] Error logs readable
- [ ] Log file not growing too fast
- [ ] Disk space monitored
- [ ] Database backups scheduled

---

## 🎉 FINAL CHECKLIST BEFORE GOING LIVE

- [ ] All documentation read and understood
- [ ] Local testing completed successfully
- [ ] All files uploaded to Infinity Free
- [ ] Permissions set correctly
- [ ] Database created and migrated
- [ ] .env configured for production
- [ ] HTTPS enabled and forced
- [ ] Homepage loads without errors
- [ ] Database connection verified
- [ ] File storage working
- [ ] Logging working
- [ ] Assets loading correctly
- [ ] Debug mode disabled
- [ ] Temporary routes removed
- [ ] Error logs checked
- [ ] .htaccess files in place
- [ ] Security verified
- [ ] Backups setup (if needed)

---

## 📞 REFERENCE & SUPPORT

### Documentation
1. [INFINITY_FREE_QUICK_REF.md](INFINITY_FREE_QUICK_REF.md) - Quick reference
2. [INFINITY_FREE_SETUP.md](INFINITY_FREE_SETUP.md) - Full setup guide
3. [INFINITY_FREE_CONFIG.md](INFINITY_FREE_CONFIG.md) - Configuration details
4. [INFINITY_FREE_OPTIMIZATION.md](INFINITY_FREE_OPTIMIZATION.md) - Performance tips
5. [INFINITY_FREE_DEPLOYMENT_GUIDE.md](INFINITY_FREE_DEPLOYMENT_GUIDE.md) - Deployment steps
6. [INFINITY_FREE_TROUBLESHOOTING.md](INFINITY_FREE_TROUBLESHOOTING.md) - Common issues

### Preparation Scripts
- `prepare-for-infinity-free.sh` (Linux/Mac)
- `prepare-for-infinity-free.bat` (Windows)

### Official Resources
- Infinity Free: https://www.infinityfree.net/
- Infinity Free Docs: https://docs.infinityfree.net/
- Laravel Docs: https://laravel.com/docs/8.x
- PHP Documentation: https://www.php.net/manual/

### Getting Help
1. Check INFINITY_FREE_TROUBLESHOOTING.md
2. Check error logs: storage/logs/laravel.log
3. Set APP_DEBUG=true to see full error
4. Contact Infinity Free support via https://infinityfree.net/
5. Check Laravel documentation

---

## 🚀 YOU'RE READY!

Your Laravel AGANS project is now configured and ready for deployment to Infinity Free hosting!

**Next Step:** Start with Phase 1 - follow the checklist above.

**Estimated Time:** 2-3 hours for complete setup and testing.

**Questions?** Check the troubleshooting guide or contact Infinity Free support.

---

**Version:** 1.0  
**Last Updated:** January 15, 2026  
**Status:** ✅ READY FOR DEPLOYMENT
