#!/bin/bash
# prepare-for-infinity-free.sh
# Script untuk persiapan project sebelum upload ke Infinity Free

set -e

echo "🚀 Preparing Laravel project for Infinity Free hosting..."
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Install PHP dependencies
echo -e "${YELLOW}[1/8]${NC} Installing PHP dependencies (production only)..."
composer install --no-dev --optimize-autoloader --no-interaction
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 2: Build frontend assets
echo -e "${YELLOW}[2/8]${NC} Building frontend assets..."
npm install
npm run production
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 3: Clear caches
echo -e "${YELLOW}[3/8]${NC} Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 4: Optimize for production
echo -e "${YELLOW}[4/8]${NC} Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 5: Set permissions
echo -e "${YELLOW}[5/8]${NC} Setting folder permissions..."
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod 644 .env
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 6: Cleanup unnecessary files
echo -e "${YELLOW}[6/8]${NC} Cleaning up unnecessary files..."
rm -rf node_modules/
rm -rf tests/
rm -rf .git/
rm -rf .github/
rm -f phpunit.xml
rm -f .editorconfig
rm -f .gitignore
rm -f .gitattributes
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 7: Optimize vendor
echo -e "${YELLOW}[7/8]${NC} Optimizing vendor folder..."
find vendor -type d -name tests -exec rm -rf {} + 2>/dev/null || true
find vendor -type d -name docs -exec rm -rf {} + 2>/dev/null || true
find vendor -name "*.md" -delete
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Step 8: Create info file
echo -e "${YELLOW}[8/8]${NC} Creating deployment info..."
cat > DEPLOYMENT_INFO.txt << 'EOF'
DEPLOYMENT INFORMATION
======================

Generated: $(date)
Project: Laravel AGANS

FILES TO UPLOAD (via FTP):
- app/
- bootstrap/
- config/
- database/
- resources/
- routes/
- storage/
- vendor/
- public/
- .env (Production values)
- .htaccess (Root .htaccess)
- composer.json
- composer.lock
- artisan
- server.php

FILES TO EXCLUDE:
- node_modules/ (already built into public/css and public/js)
- tests/
- .git/
- .github/
- .vscode/
- .idea/

PERMISSIONS TO SET (via FTP):
- storage/       → 755
- bootstrap/cache/ → 755
- .env           → 644
- All other dirs → 755
- All files      → 644

DATABASE:
- Create new MySQL database in Infinity Free panel
- Create database user
- Run: php artisan migrate --force

AFTER UPLOAD:
1. Verify .env is correct
2. Run migrations
3. Test homepage loads
4. Check storage/logs/laravel.log for errors
5. Verify database connection
6. Test uploads work

REFERENCE GUIDES:
- INFINITY_FREE_SETUP.md (complete guide)
- INFINITY_FREE_DEPLOYMENT_GUIDE.md (step-by-step)
- INFINITY_FREE_OPTIMIZATION.md (optimization tips)
- INFINITY_FREE_TROUBLESHOOTING.md (common issues)
- INFINITY_FREE_QUICK_REF.md (quick reference)
EOF

cat DEPLOYMENT_INFO.txt
echo -e "${GREEN}✓ Done${NC}"
echo ""

# Summary
echo ""
echo -e "${GREEN}=====================================${NC}"
echo -e "${GREEN}✓ PROJECT READY FOR DEPLOYMENT!${NC}"
echo -e "${GREEN}=====================================${NC}"
echo ""
echo "📊 Project Statistics:"
echo "   Vendor files: $(find vendor -type f | wc -l)"
echo "   Total files: $(find . -type f ! -path './node_modules/*' ! -path './.git/*' | wc -l)"
echo "   Vendor size: $(du -sh vendor | cut -f1)"
echo ""
echo "📋 Next Steps:"
echo "   1. Update .env with production database credentials"
echo "   2. Upload files to Infinity Free via FTP"
echo "   3. Create MySQL database in control panel"
echo "   4. Run: php artisan migrate --force"
echo "   5. Verify: https://yourdomain.com"
echo ""
echo "📚 Documentation:"
echo "   - Main Guide: INFINITY_FREE_SETUP.md"
echo "   - Deployment: INFINITY_FREE_DEPLOYMENT_GUIDE.md"
echo "   - Troubleshooting: INFINITY_FREE_TROUBLESHOOTING.md"
echo "   - Quick Ref: INFINITY_FREE_QUICK_REF.md"
echo ""
echo "Ready for upload! 🚀"
