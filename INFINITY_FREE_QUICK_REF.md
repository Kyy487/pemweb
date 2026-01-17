# Quick Reference - Infinity Free Setup

## 📋 Pre-Deployment Checklist

```bash
# 1. Optimize dependencies
composer install --no-dev --optimize-autoloader

# 2. Build assets
npm install
npm run production

# 3. Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Cleanup
rm -rf node_modules
rm -rf tests
rm -rf .git
```

## 🚀 Upload to Infinity Free

**Via FTP:**
1. Use FileZilla
2. Upload all files EXCEPT: `node_modules`, `.git`, `tests`
3. Upload `.env` separately with production values

**Folders to set permissions to 755:**
- `storage/`
- `bootstrap/cache/`

## 🗄️ Database Setup

1. Create MySQL database via Control Panel
2. Create database user
3. Update `.env` with credentials
4. Run migrations:
   ```bash
   php artisan migrate --force
   ```

## ⚙️ Configuration

**Key .env settings:**
```
APP_ENV=production
APP_DEBUG=false
DB_HOST=localhost
DB_DATABASE=username_dbname
DB_USERNAME=username_user
DB_PASSWORD=your_password
CACHE_DRIVER=file
SESSION_DRIVER=file
```

## ✅ Verify After Upload

1. Test homepage: `https://yourdomain.com`
2. Test database: Create test route, check connection
3. Check error logs: `storage/logs/laravel.log`
4. Test uploads: Verify `storage/` is writable

## 🔧 If Something Breaks

```
1. Check storage/logs/laravel.log
2. Set APP_DEBUG=true to see error
3. Run: php artisan cache:clear
4. Run: php artisan config:cache
5. Check .htaccess is in place
6. Verify folder permissions
7. Contact support if needed
```

## 📁 File Structure on Host

```
public_html/
├── public/              ← Document Root
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── .htaccess
├── app/
├── config/
├── routes/
├── storage/            ← Writable (755)
├── .env                ← Production config
└── .htaccess           ← Root redirect
```

## 🔐 Important Files

| File | Purpose | Permissions |
|------|---------|-------------|
| `.env` | Production config | 644 |
| `.htaccess` | URL rewriting | 644 |
| `storage/` | Logs, uploads | 755 |
| `bootstrap/cache/` | Framework cache | 755 |

## 🚨 Common Issues & Fixes

| Issue | Fix |
|-------|-----|
| Blank page | Check `storage/logs/laravel.log` |
| 404 errors | Ensure `.htaccess` in `/public` |
| DB connection error | Verify credentials in `.env` |
| Asset 404 | Run `npm run production` again |
| Permission denied | chmod storage/ to 755 |

## 📞 Support

- **Docs**: [infinityfree.net/docs](https://docs.infinityfree.net/)
- **Troubleshooting**: See `INFINITY_FREE_TROUBLESHOOTING.md`
- **Full Guide**: See `INFINITY_FREE_SETUP.md`

---

**Everything configured! Ready to deploy! 🚀**
