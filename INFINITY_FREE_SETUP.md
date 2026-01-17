# Setup Infinity Free untuk Laravel - Panduan Lengkap

## ⚠️ Penting: Persyaratan Infinity Free

### Batasan Hosting:
- **PHP Version**: 7.4 (recommended) atau 8.0
- **Disk Space**: ~5GB per akun
- **Inode Limit**: ~30,000 per akun
- **Autoinstaller**: Tersedia (optional)
- **Database**: MySQL/MariaDB tersedia
- **HTTP/HTTPS**: Support keduanya
- **Akses SSH**: TIDAK ada

### Masalah Potensial:
1. **Vendor folder terlalu besar** - Solusi: Optimize dependencies
2. **Node modules tidak diperlukan** - Solusi: Pre-compile assets
3. **Cache tidak persistent** - Solusi: Gunakan file storage
4. **Permissions issue** - Solusi: 755 untuk folders, 644 untuk files
5. **Memory limit rendah** - Solusi: Optimize kode

---

## 📋 Struktur Proyek untuk Infinity Free

```
public_html/
├── public/              ← Entry point (htaccess setup)
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── .htaccess        ← Penting!
├── app/
├── config/
├── database/
├── resources/
├── routes/
├── storage/            ← Writable (755)
├── bootstrap/
├── vendor/             ← Pre-compiled
├── .env                ← Production config
├── .htaccess           ← Root htaccess
└── server.php          ← Development fallback
```

---

## 🚀 Langkah-Langkah Setup

### 1. Persiapan di Local
```bash
# Optimasi dependencies
composer install --no-dev
composer dump-autoload -o

# Pre-compile assets (pastikan sudah build production)
npm install
npm run production

# Clear caches
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Siapkan File .env Production
Lihat file `.env.infinity-free` untuk template

### 3. Upload ke Infinity Free

**Option A: Upload Manual (FTP)**
1. Gunakan FileZilla atau hosting provider's file manager
2. Upload file-file KECUALI:
   - `node_modules/` (sudah di-build)
   - `.git/` directory
   - Testing files

**Option B: Gunakan Git**
```bash
# Setup git repo di host
# Push dari local
git push production main
```

### 4. Setup di Control Panel Infinity Free

1. **Document Root**: Arahkan ke `/public_html/public`
   - Atau gunakan `.htaccess` redirect (lihat step 6)

2. **Database**:
   - Buat MySQL database
   - Buat user dengan password kuat
   - Catat credentials untuk `.env`

3. **PHP Version**:
   - Pilih PHP 8.0 (recommended)
   - Update `.htaccess` jika perlu

### 5. Run Migration (First Time)

Via SSH (jika tersedia) atau public endpoint:

**Opsi 1: Command Line (SSH)**
```bash
cd public_html
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder
```

**Opsi 2: Web Routes (Temporary)**
- Buat temporary route di `routes/web.php`:
```php
Route::get('/setup-db', function () {
    if (env('APP_ENV') === 'local') abort(403);
    
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed');
    
    return 'Database setup complete';
});
```
- Akses via browser sekali, lalu hapus route

### 6. Configure .htaccess Files

**Root `.htaccess`** (di public_html/):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Public `.htaccess`** (di public_html/public/):
Lihat file `public/.htaccess`

### 7. Set Permissions

**Via File Manager:**
- `storage/`: 755
- `bootstrap/cache/`: 755
- `public/`: 755
- Semua files: 644

---

## ✅ Testing & Verification

1. **Test Homepage**
   - Akses https://yourdomain.com
   - Cek browser console, tidak ada error

2. **Test Database Connection**
   - Buat route test: `/test-db`
   - Verifikasi koneksi database works

3. **Test File Upload**
   - Upload file ke storage
   - Verify storage folder writable

4. **Test Logging**
   - Buat route yang log message
   - Check storage/logs/laravel.log

5. **Monitor Memory**
   - Di awal gunakan `ray()` untuk debug
   - Optimasi jika memory usage tinggi

---

## 🔧 Troubleshooting

### Issue: 500 Error
```
Solusi:
1. Check storage/logs/laravel.log
2. Pastikan .env correct
3. Run: php artisan config:cache
4. Periksa folder permissions
```

### Issue: Database Connection Error
```
Solusi:
1. Verify MySQL credentials di .env
2. Test koneksi: php artisan tinker → DB::connection()->getPdo()
3. Recreate database user
```

### Issue: File Not Found (404)
```
Solusi:
1. Check .htaccess di public folder
2. Verify mod_rewrite enabled
3. Clear browser cache
```

### Issue: Too Many Files / Inode Limit
```
Solusi:
1. Delete node_modules (kalau masih ada)
2. Remove unnecessary packages
3. Optimize vendor folder
4. Contact support untuk inode limit increase
```

### Issue: Memory Exhausted
```
Solusi:
1. Set memory_limit lebih tinggi di .htaccess:
   php_value memory_limit 256M
2. Optimize query (eager load)
3. Remove heavy packages
```

---

## 📝 Optimization Tips

### 1. Kurangi Vendor Size
```bash
# Remove dev dependencies
composer install --no-dev --optimize-autoloader

# Remove unused packages
composer require --only-name=needed
```

### 2. Optimize Images
- Compress semua images sebelum upload
- Gunakan modern formats (webp)

### 3. Database Indexing
- Index frequently queried columns
- Use relationships efficiently

### 4. Caching Strategy
- Gunakan query caching
- Cache configuration di .env:
```
CACHE_DRIVER=file
SESSION_DRIVER=file
```

### 5. Queue Jobs (Optional)
- Infinity Free tidak support background jobs
- Gunakan webhook atau cron jika perlu

---

## 📞 Support Resources

- **Infinity Free Docs**: https://docs.infinityfree.net/
- **Laravel Docs**: https://laravel.com/docs/8.x
- **Troubleshooting**: Check `INFINITY_FREE_TROUBLESHOOTING.md`

---

## ✨ Checklist Sebelum Go Live

- [ ] .env file configured untuk production
- [ ] Database migrated successfully
- [ ] All assets compiled (css/js built)
- [ ] Storage folder permissions set to 755
- [ ] .htaccess files configured
- [ ] Document root pointing to /public
- [ ] Email configuration tested
- [ ] Logging working properly
- [ ] HTTPS enabled
- [ ] Database backup ready
- [ ] Error logging monitored

---

**Status**: Ready for deployment! 🎉
