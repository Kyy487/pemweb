@echo off
REM prepare-for-infinity-free.bat
REM Script untuk persiapan project sebelum upload ke Infinity Free (Windows)

setlocal enabledelayedexpansion

echo.
echo ==============================================================
echo Preparing Laravel project for Infinity Free hosting...
echo ==============================================================
echo.

REM Step 1: Install PHP dependencies
echo [1/8] Installing PHP dependencies (production only)...
call composer install --no-dev --optimize-autoloader --no-interaction
echo.

REM Step 2: Build frontend assets
echo [2/8] Building frontend assets...
call npm install
call npm run production
echo.

REM Step 3: Clear caches
echo [3/8] Clearing caches...
call php artisan cache:clear
call php artisan config:clear
call php artisan route:clear
call php artisan view:clear
echo.

REM Step 4: Optimize for production
echo [4/8] Optimizing for production...
call php artisan config:cache
call php artisan route:cache
call php artisan view:cache
echo.

REM Step 5: Create deployment info
echo [5/8] Creating deployment info file...

(
echo DEPLOYMENT INFORMATION
echo ======================
echo.
echo FILES TO UPLOAD ^(via FTP^):
echo - app\
echo - bootstrap\
echo - config\
echo - database\
echo - resources\
echo - routes\
echo - storage\
echo - vendor\
echo - public\
echo - .env ^(Production values^)
echo - .htaccess
echo - composer.json
echo - composer.lock
echo - artisan
echo - server.php
echo.
echo FILES TO EXCLUDE:
echo - node_modules\ ^(already built^)
echo - tests\
echo - .git\
echo - .github\
echo.
echo PERMISSIONS TO SET ^(via FTP^):
echo - storage\ -^> 755
echo - bootstrap\cache\ -^> 755
echo.
echo DATABASE:
echo - Create MySQL database in Infinity Free panel
echo - Create database user
echo - Run: php artisan migrate --force
echo.
echo AFTER UPLOAD:
echo 1. Verify .env is correct
echo 2. Run migrations
echo 3. Test homepage loads
echo 4. Check storage\logs\laravel.log for errors
echo 5. Test database connection
echo.
echo REFERENCE GUIDES:
echo - INFINITY_FREE_SETUP.md
echo - INFINITY_FREE_DEPLOYMENT_GUIDE.md
echo - INFINITY_FREE_TROUBLESHOOTING.md
echo - INFINITY_FREE_QUICK_REF.md
) > DEPLOYMENT_INFO.txt

type DEPLOYMENT_INFO.txt
echo.

REM Summary
echo ==============================================================
echo PROJECT READY FOR DEPLOYMENT!
echo ==============================================================
echo.
echo Next Steps:
echo 1. Update .env with production database credentials
echo 2. Upload files to Infinity Free via FTP
echo 3. Create MySQL database in control panel
echo 4. Run: php artisan migrate --force
echo 5. Verify: https://yourdomain.com
echo.
echo Documentation:
echo - Main Guide: INFINITY_FREE_SETUP.md
echo - Deployment: INFINITY_FREE_DEPLOYMENT_GUIDE.md
echo - Troubleshooting: INFINITY_FREE_TROUBLESHOOTING.md
echo.
echo Ready for upload!
echo.
pause
