# Infinity Free - Konfigurasi Database & Hosting

## 📝 Database Configuration di Infinity Free

### Step 1: Create Database via Control Panel

1. **Login ke Infinity Free:**
   - https://panel.infinityfree.net/

2. **Navigate to MySQL Databases:**
   - Look for "MySQL Databases" atau "Database"

3. **Create New Database:**
   ```
   Database Name: username_databasename
   (usually auto-prefixed with your username)
   
   Example: user123_agans
   ```

4. **Create Database User:**
   ```
   Username: username_user
   Password: (auto-generated or set your own)
   Host: localhost (default)
   
   Example:
   User: user123_agans_user
   Password: abc123!@#
   ```

5. **Assign User to Database:**
   - Select the database
   - Click "Add User"
   - Select the user
   - Grant all privileges

### Step 2: Configure Laravel .env

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_databasename
DB_USERNAME=username_user
DB_PASSWORD=your_generated_password
```

**Example:**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=user123_agans
DB_USERNAME=user123_agans_user
DB_PASSWORD=abc123!@#
```

### Step 3: Verify Connection

**Via Laravel Tinker:**
```bash
php artisan tinker
> DB::connection()->getPdo();
# Should return PDOStatement without error
```

**Via Test Route:**
```php
Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection OK! ✓';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

---

## 🌐 Domain & Hosting Configuration

### Step 1: Set Document Root

**Option A: Use Control Panel (Recommended)**

1. Go to "Addon Domains" or "Domains" section
2. Find your domain
3. Click "Manage"
4. Set "Document Root" to: `/public_html/public`
5. Save

**Option B: Use .htaccess Redirect (if can't change root)**

If you can't change the document root:

Create `.htaccess` in `/public_html/`:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Step 2: Enable HTTPS/SSL

1. In Control Panel → "SSL/TLS Certificates"
2. Click "Auto-install Let's Encrypt"
3. Select your domain
4. Click "Install"
5. Wait 5-10 minutes
6. Verify: https://yourdomain.com (should show 🔒 lock)

### Step 3: Force HTTPS

In `.htaccess` (already configured):
```apache
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

Or in Laravel `.env`:
```env
APP_URL=https://yourdomain.com
```

---

## ⚙️ PHP Configuration for Infinity Free

### Step 1: Select PHP Version

1. Control Panel → "PHP Configuration" or "Settings"
2. Select PHP version: **8.0 recommended** (or 7.4)
3. Save changes

### Step 2: Adjust PHP Limits (if needed)

**Via .htaccess:**
```apache
# Root .htaccess (in /public_html/):
<IfModule mod_php8.c>
    php_value upload_max_filesize 128M
    php_value post_max_size 128M
    php_value memory_limit 256M
    php_value max_execution_time 300
</IfModule>

<IfModule mod_php7.c>
    php_value upload_max_filesize 128M
    php_value post_max_size 128M
    php_value memory_limit 256M
    php_value max_execution_time 300
</IfModule>
```

**Common Limits:**
```
upload_max_filesize  = 128M
post_max_size        = 128M
memory_limit         = 256M
max_execution_time   = 300
default_charset      = UTF-8
```

### Step 3: Verify PHP Extensions

Required extensions (usually pre-installed):
- `php_pdo` ✓
- `php_pdo_mysql` ✓
- `php_mbstring` ✓
- `php_json` ✓
- `php_openssl` ✓
- `php_curl` ✓
- `php_gd` ✓
- `php_zip` ✓

**Via Test Route:**
```php
Route::get('/php-info', function () {
    return [
        'version' => phpversion(),
        'pdo' => extension_loaded('pdo') ? 'Loaded' : 'Missing',
        'pdo_mysql' => extension_loaded('pdo_mysql') ? 'Loaded' : 'Missing',
        'mbstring' => extension_loaded('mbstring') ? 'Loaded' : 'Missing',
    ];
});
```

---

## 📧 Email Configuration

### Option 1: Using Gmail SMTP

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app_password_from_google
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="AGANS"
```

**Setup Gmail App Password:**
1. Go to: https://myaccount.google.com/apppasswords
2. Select Mail and Windows Computer (or your device)
3. Generate password
4. Use the 16-character password (without spaces) in `.env`

### Option 2: Using Infinity Free Email

```env
MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="AGANS"
```

**Setup Email Account:**
1. Control Panel → Email Accounts
2. Create new account: noreply@yourdomain.com
3. Set strong password
4. Use above credentials in `.env`

### Test Email

```php
Route::get('/test-email', function () {
    try {
        Mail::raw('Test email from AGANS', function ($msg) {
            $msg->to('recipient@example.com')
                ->subject('Test Email');
        });
        return 'Email sent successfully! ✓';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

---

## 🗄️ File Storage Configuration

### Option 1: Local Storage (Recommended)

```env
FILESYSTEM_DISK=local
```

**Location:**
- Files stored in: `storage/app/`
- Access via: `Storage::put()`, `Storage::get()`

**Setup:**
```bash
# Create storage symlink (if available)
php artisan storage:link

# Make directory writable
chmod -R 755 storage/
```

### Option 2: Public Storage

For user-downloadable files:

```env
FILESYSTEM_DISK=public
```

**Access:**
```php
// Store file
Storage::disk('public')->put('uploads/file.pdf', $content);

// Get URL
$url = Storage::disk('public')->url('uploads/file.pdf');
// Returns: /storage/uploads/file.pdf
```

---

## 🔐 Security Configuration

### Step 1: Set Proper Permissions

```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
chmod 644 .htaccess
```

### Step 2: Secure Sensitive Files

Add to root `.htaccess`:
```apache
# Protect sensitive files
<FilesMatch "^\.env|composer\.(json|lock)|package\.json|\.git">
    Order allow,deny
    Deny from all
</FilesMatch>

# Hide error files
<Files "error.log">
    Order allow,deny
    Deny from all
</Files>
```

### Step 3: Set Security Headers

Already configured in public `.htaccess`:
```apache
Header set X-Content-Type-Options "nosniff"
Header set X-Frame-Options "SAMEORIGIN"
Header set X-XSS-Protection "1; mode=block"
```

### Step 4: App Key

Generate strong app key:
```bash
php artisan key:generate
# Outputs: base64:XXXXXXXXXXXX

# Add to .env:
APP_KEY=base64:XXXXXXXXXXXX
```

---

## 🎯 Configuration Checklist

### Database
- [ ] MySQL database created
- [ ] Database user created
- [ ] User assigned to database
- [ ] DB_* values in .env correct
- [ ] Can connect via Tinker

### Domain & Hosting
- [ ] Document root set to /public
- [ ] Domain points to Infinity Free
- [ ] HTTPS/SSL enabled
- [ ] HTTPS forced in .htaccess
- [ ] .htaccess files uploaded

### PHP
- [ ] PHP 8.0 (or 7.4) selected
- [ ] mod_rewrite enabled
- [ ] Required extensions loaded
- [ ] Memory limit 256M+
- [ ] Upload limit 128M+

### Security
- [ ] APP_KEY set
- [ ] APP_DEBUG=false
- [ ] .env permissions 644
- [ ] storage/ permissions 755
- [ ] Sensitive files protected

### Email
- [ ] MAIL_* configured in .env
- [ ] Email credentials correct
- [ ] SMTP connection tested
- [ ] Test email sent successfully

### Files
- [ ] All files uploaded
- [ ] node_modules/ excluded
- [ ] .git/ excluded
- [ ] Permissions set correctly
- [ ] .htaccess in both locations

### Testing
- [ ] Homepage loads
- [ ] Database connects
- [ ] Storage writable
- [ ] Logs working
- [ ] Email sends
- [ ] Assets load (css/js)
- [ ] No 500 errors

---

## 🆘 Configuration Issues

**Issue: Database won't connect**
```
Solution:
1. Verify host is "localhost"
2. Check database name includes prefix
3. Verify user is assigned to database
4. Recreate user with simpler password
```

**Issue: Emails won't send**
```
Solution:
1. Check MAIL_HOST is correct
2. Verify MAIL_PORT matches encryption
3. Use port 465 with ssl
4. Generate Gmail app password (not regular password)
```

**Issue: File upload fails**
```
Solution:
1. Chmod storage/ to 755
2. Increase upload_max_filesize in .htaccess
3. Check post_max_size >= upload_max_filesize
```

---

**Configuration complete! Ready for deployment! 🚀**

See `INFINITY_FREE_DEPLOYMENT_GUIDE.md` for next steps.
