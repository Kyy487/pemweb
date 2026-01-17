# Panduan Deployment Step-by-Step ke Infinity Free

## Phase 1: Persiapan di Local Machine

### Step 1: Optimasi Project
```bash
# Clean install production dependencies
composer install --no-dev --optimize-autoloader --no-scripts

# Build frontend assets
npm install
npm run production

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Step 2: Prepare Environment
```bash
# Copy .env.infinity-free to .env.production.local
cp .env.infinity-free .env.production.local

# Generate app key (if not already set)
php artisan key:generate
```

### Step 3: Verify Local Installation
```bash
# Test serve
php artisan serve

# Test in browser: http://localhost:8000
# Check: Homepage loads, no 500 errors
```

---

## Phase 2: Upload ke Infinity Free

### Option A: FTP Upload (Recommended untuk Infinity Free)

1. **Download FileZilla** (gratis)
   - https://filezilla-project.org/

2. **Get FTP Credentials**
   - Login ke Infinity Free control panel
   - Cari section "FTP Accounts" atau "File Manager"
   - Note: FTP Host, Username, Password

3. **Connect dengan FileZilla**
   - File → Site Manager
   - New Site
   - Protocol: FTP
   - Host: ftp.yourdomain.com
   - User: ftp_username
   - Pass: ftp_password
   - Port: 21
   - Connect

4. **Upload Files**
   ```
   Local (Left)          →  Remote (Right)
   agans/                 →  public_html/
   
   EXCLUDE:
   - node_modules/
   - .git/
   - tests/
   - storage/logs/
   - storage/cache/
   - .env (upload separately!)
   ```

5. **Upload .env Separately**
   - Create .env di remote dengan values production
   - Paste .env.infinity-free content
   - Update DB credentials

6. **Set Permissions**
   - storage/ → 755
   - bootstrap/cache/ → 755
   - .env → 644

### Option B: Upload via Control Panel (Jika tidak ada FTP)

1. Go to control panel
2. File Manager
3. Create folders manually
4. Upload files zip by zip
5. Extract dan organize

### Option C: Git Deploy (Advanced)

```bash
# Di Infinity Free (via SSH jika tersedia)
git clone https://github.com/yourname/agans.git public_html
cd public_html
composer install --no-dev
npm run production
```

---

## Phase 3: Database Setup

### Step 1: Create Database

1. **Di Infinity Free Control Panel:**
   - Go to "MySQL Databases" atau "Database"
   - Create new database
   - Name: `username_dbname` (often auto-prefixed)
   - Note the credentials

2. **Create Database User**
   - Create new user
   - Username: `username_user`
   - Password: (auto-generated, note it)
   - Assign to database

3. **Note Credentials:**
   ```
   Host: localhost
   Database: username_dbname
   User: username_user
   Password: your_password
   ```

### Step 2: Update .env

```bash
# Edit .env di remote server

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_dbname
DB_USERNAME=username_user
DB_PASSWORD=your_password
```

### Step 3: Run Migrations

**Via Command Line (if SSH available):**
```bash
ssh user@host
cd public_html
php artisan migrate --force
php artisan db:seed --force
```

**Via Browser (Temporary Route):**

1. Edit `routes/web.php`:
```php
Route::get('/migrate-db', function () {
    if (! in_array(request()->ip(), ['YOUR_IP'])) {
        abort(403);
    }
    
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    
    return 'Database migrated and seeded!';
});
```

2. Re-upload `routes/web.php`

3. Visit: `https://yourdomain.com/migrate-db`

4. Delete the route afterwards

---

## Phase 4: Configure Web Server

### Step 1: Set Document Root

**In Infinity Free Control Panel:**
1. Go to "Addon Domains" or "Domains"
2. Click on your domain
3. Set Document Root to: `/public_html/public`
   - OR use .htaccess redirect if can't change root

### Step 2: Verify .htaccess

Make sure files exist:
```
/public_html/.htaccess
/public_html/public/.htaccess
```

Both files should already be uploaded.

### Step 3: Enable HTTPS

1. In Infinity Free: Enable SSL (usually auto with Let's Encrypt)
2. Force HTTPS in .htaccess ✓ (already configured)

### Step 4: Check mod_rewrite

Some hosts disable it. Test:
- Visit: `https://yourdomain.com/nonexistent`
- Should get Laravel 404 page (not server 404)
- If server 404, ask support to enable mod_rewrite

---

## Phase 5: Post-Deployment Testing

### Test 1: Check Homepage
```bash
curl https://yourdomain.com
# Should return HTML, no 500 errors
```

### Test 2: Check Database Connection
Create temporary route:

```php
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connected! ✓';
    } catch (\Exception $e) {
        return 'Database error: ' . $e->getMessage();
    }
});
```

Visit: `https://yourdomain.com/test-db`

Expected: "Database connected! ✓"

### Test 3: Check Storage
Create temporary route:

```php
Route::get('/test-storage', function () {
    try {
        \Illuminate\Support\Facades\Storage::put('test.txt', 'test content');
        return 'Storage writable! ✓';
    } catch (\Exception $e) {
        return 'Storage error: ' . $e->getMessage();
    }
});
```

### Test 4: Check Logging
Create temporary route:

```php
Route::get('/test-log', function () {
    \Log::info('Test log message');
    return 'Check storage/logs/laravel.log';
});
```

Visit and check: `storage/logs/laravel.log`

### Test 5: Check Assets
- Visit homepage
- Open Dev Tools (F12)
- Check Resources/Network tab
- CSS, JS should load (200 status)
- No 404 errors

### Test 6: Check Email (if configured)
Send test email:

```php
Route::get('/test-email', function () {
    Mail::raw('Test email', function ($msg) {
        $msg->to('your@email.com')->subject('Test');
    });
    return 'Email sent!';
});
```

---

## Phase 6: Cleanup & Security

### Remove Temporary Routes
Delete all `/test-*` routes dari `routes/web.php`

### Remove Debug Info
Ensure in .env:
```
APP_DEBUG=false
```

### Set Proper Permissions

Via SSH:
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
```

### Remove Sensitive Files
Delete these if exist:
- `phpunit.xml`
- `tests/` folder
- `.git/` folder
- `node_modules/`

---

## Phase 7: Monitoring

### Set up Error Logging
```php
// config/logging.php
'default' => env('LOG_CHANNEL', 'single'),

// In production, use single or daily
'single' => [
    'driver' => 'single',
    'path' => storage_path('logs/laravel.log'),
],
```

### Monitor Storage Space
- Check Infinity Free control panel regularly
- Monitor inode usage
- Keep vendor folder optimized

### Monitor Performance
- Check database for slow queries
- Monitor memory usage
- Profile heavy operations

---

## Troubleshooting Checklist

### Issue: Blank Page / 500 Error
- [ ] Check `storage/logs/laravel.log`
- [ ] Verify `.env` is correct
- [ ] Run `php artisan config:cache` (if SSH available)
- [ ] Check folder permissions
- [ ] Check PHP version compatibility

### Issue: Database Connection Failed
- [ ] Verify DB credentials in `.env`
- [ ] Check DB host is correct (usually `localhost`)
- [ ] Test: Can you login to phpmyadmin?
- [ ] Check firewall rules

### Issue: 404 on Routes
- [ ] Check `.htaccess` exists in `/public`
- [ ] Ask host to enable `mod_rewrite`
- [ ] Check document root is `/public_html/public`
- [ ] Clear browser cache

### Issue: CSS/JS Not Loading
- [ ] Check `npm run production` was run
- [ ] Verify files uploaded to `/public/css/` and `/public/js/`
- [ ] Check browser cache (Ctrl+Shift+Del)
- [ ] Check console for 404 errors

### Issue: File Upload Not Working
- [ ] Check `storage/` folder permissions (755)
- [ ] Check `FILESYSTEM_DISK=local` in `.env`
- [ ] Check upload_max_filesize in php.ini

### Issue: Email Not Sending
- [ ] Verify SMTP credentials in `.env`
- [ ] Check `MAIL_FROM_ADDRESS` is set
- [ ] Test with route above
- [ ] Check spam folder

---

## Final Checklist ✅

- [ ] Project uploaded to public_html
- [ ] .env configured for production
- [ ] Database created and migrated
- [ ] Document root set correctly
- [ ] .htaccess files in place
- [ ] HTTPS working
- [ ] Homepage loads without errors
- [ ] Database connection verified
- [ ] Storage folder writable
- [ ] Logging working
- [ ] No temporary test routes
- [ ] DEBUG mode off
- [ ] Credentials secure
- [ ] Backups scheduled

---

## 🎉 Deployment Complete!

Your Laravel application is now live on Infinity Free!

**Next Steps:**
1. Monitor error logs daily
2. Setup regular backups
3. Keep software updated
4. Monitor resource usage
5. Get SSL certificate renewed (auto on Infinity Free)

---

**Questions? Check `INFINITY_FREE_TROUBLESHOOTING.md`**
