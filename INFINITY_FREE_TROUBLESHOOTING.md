# Troubleshooting Infinity Free Hosting

## 🔴 Error Pages & Solutions

### 1. Blank Page / No Content

**Symptom:** Empty white page, no error message

**Solutions:**
```bash
# 1. Check error logs
# Via FTP: download storage/logs/laravel.log
# Or via File Manager: open storage/logs/laravel.log

# 2. Check .env
# Verify all values are correct
# Especially: DB_*, APP_KEY, APP_URL

# 3. Reset caches (via SSH if available)
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 4. Check PHP version
# Visit Control Panel → PHP Settings
# Should be 7.4+ or 8.0+
```

**Common Causes:**
- Missing APP_KEY in .env
- Database credentials wrong
- PHP version incompatible
- Memory limit too low

---

### 2. 500 Internal Server Error

**Symptom:** "500 Internal Server Error" page

**Immediate Actions:**
```bash
# 1. Enable debug to see actual error
# Edit .env:
APP_DEBUG=true

# 2. Reload page - now you'll see the error
# Screenshot/note the error message

# 3. Fix the error, then disable debug
APP_DEBUG=false
```

**Common 500 Errors:**

**Error: SQLSTATE[HY000] [1045] Access denied for user**
```
Solution:
1. Check DB_USERNAME, DB_PASSWORD in .env
2. Verify database user exists in control panel
3. Check database name is correct (often prefixed)
4. Recreate database user with new password
```

**Error: Specified key was too long; max key length is 767 bytes**
```
Solution:
1. Add to config/database.php:
   'mysql' => [
       'driver' => 'mysql',
       ...
       'charset' => 'utf8',
       'collation' => 'utf8_unicode_ci',
   ]
2. Re-run migrations
```

**Error: Call to undefined function**
```
Solution:
1. Run: php artisan dump-autoload
2. Or: composer dump-autoload -o
3. Re-upload vendor folder
```

---

### 3. 404 Not Found (Wrong Type)

**Symptom:** "404 | Not Found" shown by web server (not Laravel)

**Solution:**

This means mod_rewrite isn't working.

```
Step 1: Check .htaccess exists
- Via FTP/File Manager
- Should be in /public_html/public/.htaccess

Step 2: Check file permissions
- .htaccess should be readable (644)
- /public should be writable (755)

Step 3: Enable mod_rewrite
- Contact Infinity Free support
- Ask: "Please enable mod_rewrite for my domain"
- They'll enable it (usually 1-2 hours)

Step 4: Clear browser cache
- Press Ctrl+Shift+Del
- Clear cache
- Reload page
```

---

### 4. 403 Forbidden

**Symptom:** "403 Forbidden" error

**Solutions:**
```
Solution 1: Fix permissions
- storage/ folder → chmod 755
- bootstrap/cache → chmod 755
- .env → chmod 644

Solution 2: Allow directory access
- Check .htaccess doesn't block access
- Remove "Options -Indexes" temporarily

Solution 3: Check IP restrictions
- Some hosts block certain IPs
- Contact support if persists
```

---

### 5. Database Connection Error

**Symptom:** "SQLSTATE[HY000] [2002] No such file or directory"

**Solutions:**

```bash
# Solution 1: Check host is correct
# In .env, change:
DB_HOST=localhost    # Try this first
# OR
DB_HOST=127.0.0.1    # Try this if localhost fails

# Solution 2: Check database exists
# Via phpmyadmin or control panel:
# 1. Login to phpmyadmin
# 2. Look for your database
# 3. If not there, create it

# Solution 3: Check credentials
php artisan tinker
> DB::connection()->getPdo()
# Should not error

# Solution 4: Request MySQL restart
# Contact Infinity Free support
```

---

### 6. Large File Upload Error

**Symptom:** "File too large" or upload fails

**Solutions:**

```apache
# Add to .htaccess (in /public_html/):
php_value upload_max_filesize 128M
php_value post_max_size 128M
```

**If still doesn't work:**
```
1. Contact support to increase limits
2. They can adjust server-wide settings
```

---

### 7. Inode Limit Exceeded

**Symptom:** Can't upload/create new files, despite space available

**Problem:** Infinity Free limits inode count (~30,000 per account)

**Solution:**

```bash
# 1. Count current files
find . -type f | wc -l

# 2. If > 25,000, optimize:
   # Remove node_modules
   rm -rf node_modules/
   
   # Clean vendor (remove tests, docs)
   find vendor -type d -name tests -exec rm -rf {} +
   find vendor -type d -name docs -exec rm -rf {} +

# 3. Remove log files
rm storage/logs/*

# 4. If still over, request inode increase
   # Contact Infinity Free support
   # They may increase limit
```

---

### 8. Memory Limit Exceeded

**Symptom:** "Allowed memory size of XXX bytes exhausted"

**Solutions:**

```apache
# Add to .htaccess:
php_value memory_limit 256M
php_value max_execution_time 300
```

**If still error:**
```php
// Add to config/app.php
ini_set('memory_limit', '256M');

// Or in specific controller
ini_set('memory_limit', '512M');

// Optimize queries - avoid loading entire tables:
// ❌ Bad:
$users = User::all();

// ✅ Good:
$users = User::select('id', 'name')->limit(100)->get();

// ✅ Better - Chunking:
User::chunk(100, function($users) {
    foreach ($users as $user) {
        // Process
    }
});
```

---

### 9. HTTPS / SSL Certificate Issues

**Symptom:** Browser warning or "Not Secure" indicator

**Solutions:**

```
Solution 1: Let Encrypt Auto-SSL
1. Go to Control Panel
2. Look for "SSL/TLS Certificates"
3. Enable "Auto-install Let's Encrypt"
4. Wait 5-10 minutes
5. Reload page

Solution 2: Force HTTPS in code
// In config/app.php
'url' => 'https://' . env('APP_URL'),

// Or in .htaccess
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

Solution 3: Update APP_URL
# In .env:
APP_URL=https://yourdomain.com  ← Must be HTTPS
```

---

### 10. Email Not Sending

**Symptom:** Mail::send() doesn't send email

**Solutions:**

```php
// 1. Test email sending
Route::get('/test-email', function() {
    try {
        Mail::raw('Test', function ($msg) {
            $msg->to('your@email.com')
                ->subject('Test Email');
        });
        return 'Email sent!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
```

**Common SMTP issues:**

```
Issue 1: Port blocked
Solution: Use port 465 (SSL) or 587 (TLS)
In .env:
MAIL_PORT=465
MAIL_ENCRYPTION=ssl

Issue 2: Invalid credentials
Solution: Double-check SMTP username/password
Test with: https://www.google.com/accounts/AccountChooser?continue=https://myaccount.google.com/

Issue 3: Sandbox account
Solution: If using Gmail, setup App Password:
1. https://myaccount.google.com/apppasswords
2. Generate app password for Laravel
3. Use in .env: MAIL_PASSWORD=xxxx xxxx xxxx xxxx
```

---

### 11. Asset Files Not Loading (404)

**Symptom:** CSS/JS files return 404, images broken

**Solutions:**

```bash
# Solution 1: Ensure assets were built
npm run production

# This should create:
# public/css/app.css
# public/js/app.js

# Solution 2: Verify files uploaded
# Via FTP, check:
# /public_html/public/css/app.css
# /public_html/public/js/app.js

# Solution 3: Fix manifest.json
# In .htaccess (/public):
RewriteCond %{REQUEST_FILENAME} !-f
# Must allow real files through

# Solution 4: Check config/app.php
'asset_url' => env('ASSET_URL'),
# In .env, set: ASSET_URL=https://yourdomain.com

# Solution 5: Update asset paths in blade
# ✅ Use helper:
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}"></script>

# ❌ Don't use:
<link rel="stylesheet" href="/css/app.css">
```

---

### 12. Session Not Persisting

**Symptom:** Login fails, sessions lost on page reload

**Solutions:**

```php
// 1. Check SESSION_DRIVER in .env
SESSION_DRIVER=file  // Must be file for Infinity Free

// 2. Check storage/framework/sessions is writable
// Permissions should be 755

// 3. In config/session.php
'driver' => env('SESSION_DRIVER', 'file'),
'path' => storage_path('framework/sessions'),

// 4. Test session
Route::get('/test-session', function () {
    session(['test' => 'value']);
    return session('test');  // Should output: value
});

// 5. Clear stale sessions
// Add to cron job:
php artisan session:prune-stale-files
```

---

## 📋 Diagnostic Checklist

When something breaks, check in order:

```
□ 1. Check storage/logs/laravel.log for errors
□ 2. Set APP_DEBUG=true to see actual error
□ 3. Verify .env values (all DB_* settings)
□ 4. Check folder permissions (755 for dirs, 644 for files)
□ 5. Run: php artisan cache:clear
□ 6. Run: php artisan config:cache
□ 7. Verify .htaccess exists and is readable
□ 8. Check PHP version (7.4+)
□ 9. Test database connection: php artisan tinker → DB::connection()->getPdo()
□ 10. Check browser console (F12) for asset errors
□ 11. Clear browser cache (Ctrl+Shift+Del)
□ 12. Contact hosting support if still broken
```

---

## 🆘 When to Contact Infinity Free Support

**They can help with:**
- Enable/disable mod_rewrite
- Increase PHP memory limit
- Increase upload file size limit
- Increase inode limit
- Restart MySQL service
- Change PHP version
- SSL certificate issues
- Email configuration help

**Contact:** Submit ticket via https://infinityfree.net/

---

## 💡 Quick Fixes (Try These First)

```bash
# Most issues fixed by:
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Delete old log files
rm storage/logs/laravel-*.log

# Recreate storage directories
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
chmod -R 755 storage/
```

---

**Still stuck? Check the main guide: `INFINITY_FREE_SETUP.md`**
