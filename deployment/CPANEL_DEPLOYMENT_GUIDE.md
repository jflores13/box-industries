# 📋 Complete cPanel Deployment Guide for Box Industries Laravel App

This guide will walk you through deploying your Laravel 12 + Inertia + Vue 3 application to cPanel hosting.

---

## 🎯 Overview

**What we're deploying:**
- Laravel 12 application
- Inertia.js + Vue 3 frontend
- MySQL database
- Built assets (CSS/JS)

**What you need:**
- cPanel access with SSH (recommended) or File Manager
- PHP 8.2 or higher
- MySQL database
- Composer installed on server
- Domain or subdomain configured

---

## 📑 Table of Contents

1. [Pre-Deployment Checklist](#1-pre-deployment-checklist)
2. [Server Requirements Check](#2-server-requirements-check)
3. [Prepare Your Application](#3-prepare-your-application)
4. [Database Setup](#4-database-setup)
5. [File Structure Setup](#5-file-structure-setup)
6. [Upload Your Application](#6-upload-your-application)
7. [Environment Configuration](#7-environment-configuration)
8. [Install Dependencies](#8-install-dependencies)
9. [Database Migration](#9-database-migration)
10. [File Permissions](#10-file-permissions)
11. [Configure Domain](#11-configure-domain)
12. [Testing](#12-testing)
13. [Troubleshooting](#13-troubleshooting)
14. [Post-Deployment](#14-post-deployment)

---

## 1. Pre-Deployment Checklist

### ✅ Local Machine Tasks

- [ ] All code committed and pushed to Git
- [ ] Run tests locally: `php artisan test`
- [ ] Build production assets: `npm run build`
- [ ] Export local database (see Database section)
- [ ] Review `.env` settings
- [ ] Verify PHP version compatibility (requires ^8.2)

### ✅ cPanel Access

- [ ] cPanel login credentials
- [ ] FTP/SFTP credentials or SSH access
- [ ] Domain/subdomain configured
- [ ] SSL certificate available (recommended)

---

## 2. Server Requirements Check

### A. Check PHP Version

**Via cPanel:**
1. Login to cPanel
2. Navigate to **"Select PHP Version"** or **"MultiPHP Manager"**
3. Ensure PHP **8.2** or **8.3** is selected
4. Enable required extensions:
   - ✅ `pdo_mysql`
   - ✅ `mbstring`
   - ✅ `xml`
   - ✅ `bcmath`
   - ✅ `curl`
   - ✅ `zip`
   - ✅ `json`
   - ✅ `fileinfo`

**Via SSH:**
```bash
php -v
php -m  # Check installed modules
```

### B. Check Composer

**Via SSH:**
```bash
composer --version
```

If Composer is not installed, you may need to:
1. Contact your hosting provider
2. Install it yourself in your home directory
3. Use a local `composer.phar` file

### C. Check MySQL Version

**Via cPanel:**
- Go to **"MySQL Databases"**
- Version should be MySQL 5.7+ or MariaDB 10.3+

---

## 3. Prepare Your Application

### A. Build Assets Locally

**CRITICAL:** Always build assets locally before deploying.

```bash
# In your local project directory
npm install
npm run build
```

This creates optimized files in `public/build/`.
10

### B. Clean Up Development Files

Ensure these are NOT uploaded:
- `node_modules/` (excluded in .gitignore)
- `.env` (excluded in .gitignore)
- `vendor/` (will be installed on server)
- `.git/` (optional, but can upload)

### C. Export Your Database

```bash
# Use the included helper script
php deployment/scripts/export-database.php

# Or manually:
php artisan db:show  # View connection info
mysqldump -u your_user -p your_database > database_export.sql
```

Save `database_export.sql` - you'll need this later.

---

## 4. Database Setup

### A. Create Database in cPanel

1. Login to cPanel
2. Go to **"MySQL® Databases"**
3. **Create a new database:**
   - Database name: `username_boxindustries` (example)
   - Note the full name (includes your username prefix)
4. **Create a database user:**
   - Username: `username_dbuser` (example)
   - Generate a strong password
   - **SAVE THESE CREDENTIALS!**
5. **Add user to database:**
   - Select the user and database
   - Grant **ALL PRIVILEGES**

### B. Import Your Database

**Via phpMyAdmin:**
1. Go to cPanel → **"phpMyAdmin"**
2. Select your new database
3. Click **"Import"** tab
4. Choose your `database_export.sql` file
5. Click **"Go"**

**Via SSH (faster for large databases):**
```bash
mysql -u username_dbuser -p username_boxindustries < database_export.sql
```

---

## 5. File Structure Setup

### Understanding cPanel Directory Structure

Most cPanel servers use:
```
/home/username/
  ├── public_html/          ← Your domain's document root
  ├── repositories/         ← (optional) Store Laravel app here
  └── ...
```

### Recommended Setup

**Option A: Laravel in subdirectory (Recommended)**
```
/home/username/
  ├── laravel/              ← Your Laravel application
  │   ├── app/
  │   ├── bootstrap/
  │   ├── config/
  │   ├── database/
  │   ├── public/           ← Laravel's public folder
  │   ├── resources/
  │   ├── routes/
  │   ├── storage/
  │   └── vendor/
  └── public_html/          ← Symbolic link to laravel/public
```

**Option B: Laravel outside public_html (Most Secure)**
```
/home/username/
  ├── box-industries/       ← Your Laravel application
  │   └── public/           ← Laravel's public folder
  └── public_html/          ← Symbolic link to box-industries/public
```

---

## 6. Upload Your Application

### Method A: Git (Recommended)

**Via SSH:**
```bash
# Navigate to your home directory
cd /home/username

# Clone your repository
git clone https://github.com/yourusername/box-industries.git

# Or if using a specific directory name:
git clone https://github.com/yourusername/box-industries.git laravel
```

### Method B: FTP/SFTP

1. Connect using FileZilla or similar
2. Upload entire project to `/home/username/laravel/`
3. Ensure `public/build/` folder is uploaded (contains built assets)

### Method C: cPanel File Manager

1. Go to cPanel → **"File Manager"**
2. Create directory `/home/username/laravel`
3. Upload your project as a ZIP file
4. Extract the ZIP file

---

## 7. Environment Configuration

### A. Create .env File

**Via SSH:**
```bash
cd /home/username/laravel
cp deployment/env.production.template .env
nano .env  # or vi .env
```

**Via cPanel File Manager:**
1. Navigate to your Laravel directory
2. Copy `deployment/env.production.template` to `.env`
3. Edit `.env` file

### B. Configure .env Values

Update these **CRITICAL** values:

```env
APP_NAME="Box Industries"
APP_ENV=production
APP_KEY=                    # Generate in next step
APP_DEBUG=false            # MUST be false!
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=username_boxindustries
DB_USERNAME=username_dbuser
DB_PASSWORD=your_strong_password

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true

CACHE_STORE=file
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### C. Generate Application Key

**Via SSH:**
```bash
cd /home/username/laravel
php artisan key:generate
```

This will automatically update your `.env` file with a secure `APP_KEY`.

---

## 8. Install Dependencies

### A. Install Composer Dependencies

**Via SSH:**
```bash
cd /home/username/laravel

# Install production dependencies only
composer install --optimize-autoloader --no-dev

# If you get memory errors:
php -d memory_limit=-1 /usr/local/bin/composer install --optimize-autoloader --no-dev
```

**If Composer is not available:**
1. Download `composer.phar` to your directory
2. Run: `php composer.phar install --optimize-autoloader --no-dev`

### B. Optimize for Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 9. Database Migration

### A. Verify Database Connection

```bash
php artisan db:show
```

You should see your database connection info.

### B. Run Migrations

Since you've already imported your database, verify tables exist:

```bash
php artisan migrate:status
```

If tables are missing or you want to reset:

```bash
php artisan migrate --force
```

Note: `--force` is required in production to bypass the safety prompt.

### C. (Optional) Seed Data

If you need to seed data:

```bash
php artisan db:seed --force
```

---

## 10. File Permissions

### Critical Directories Need Write Access

**Via SSH:**
```bash
cd /home/username/laravel

# Storage directory
chmod -R 775 storage
chmod -R 775 storage/framework
chmod -R 775 storage/framework/cache
chmod -R 775 storage/framework/sessions
chmod -R 775 storage/framework/views
chmod -R 775 storage/logs

# Bootstrap cache
chmod -R 775 bootstrap/cache

# .env file (secure it!)
chmod 644 .env
```

**Via cPanel File Manager:**
1. Right-click each directory
2. Select **"Change Permissions"**
3. Set to **755** or **775** for directories
4. Set to **644** for files

---

## 11. Configure Domain

### Option A: Point Domain to public/ Directory

**Via cPanel → Domains:**

1. Click your domain
2. Change **Document Root** to:
   ```
   /home/username/laravel/public
   ```
3. Save changes

### Option B: Create Symbolic Link

**Via SSH:**
```bash
# Remove existing public_html (backup first!)
cd /home/username
mv public_html public_html_backup

# Create symbolic link
ln -s /home/username/laravel/public public_html
```

### Option C: .htaccess Redirect (If you can't change document root)

Create/edit `/home/username/public_html/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ /laravel/public/$1 [L]
</IfModule>
```

---

## 12. Testing

### A. Basic Access Test

Visit your domain: `https://yourdomain.com`

You should see your Box Industries homepage.

### B. Admin Access Test

1. Visit: `https://yourdomain.com/login`
2. Login with your credentials
3. Navigate to: `https://yourdomain.com/admin/dashboard`

### C. Check for Errors

**View Laravel logs:**
```bash
tail -f storage/logs/laravel.log
```

**Common Issues:**
- 500 error → Check logs, permissions, .env
- 404 error → Check document root, .htaccess
- CSS/JS not loading → Check `public/build/` exists, run `npm run build`

---

## 13. Troubleshooting

### Issue: 500 Internal Server Error

**Solutions:**
1. Check `.env` file exists and is configured
2. Check `APP_KEY` is set: `php artisan key:generate`
3. Check file permissions (storage, bootstrap/cache)
4. Check PHP version (must be 8.2+)
5. View error logs: `tail storage/logs/laravel.log`
6. Clear cache: `php artisan cache:clear && php artisan config:clear`

### Issue: CSS/JS Not Loading

**Solutions:**
1. Verify `public/build/` directory exists
2. Rebuild assets: `npm run build` (locally)
3. Re-upload `public/build/` directory
4. Check `.htaccess` in `public/` directory exists
5. Check `APP_URL` in `.env` matches your domain

### Issue: Database Connection Failed

**Solutions:**
1. Verify database credentials in `.env`
2. Test connection: `php artisan db:show`
3. Check database user has proper privileges
4. Verify `DB_HOST` (usually `localhost`)
5. Check if database exists in cPanel

### Issue: Queue Jobs Not Running

**Solutions:**
1. Set up a cron job to run queue worker
2. Go to cPanel → **"Cron Jobs"**
3. Add:
   ```
   * * * * * cd /home/username/laravel && php artisan queue:work --stop-when-empty
   ```

### Issue: Session/Auth Issues

**Solutions:**
1. Run migrations for sessions: `php artisan migrate --force`
2. Check `SESSION_DRIVER=database` in `.env`
3. Verify `sessions` table exists in database
4. Clear session cache: `php artisan cache:clear`

### Issue: Vite Manifest Not Found

**Solutions:**
1. This means assets weren't built
2. Run `npm run build` locally
3. Re-upload the entire `public/build/` directory

---

## 14. Post-Deployment

### A. SSL Certificate (HTTPS)

**Via cPanel:**
1. Go to **"SSL/TLS Status"**
2. Enable **"AutoSSL"** or install Let's Encrypt
3. Update `.env`:
   ```env
   APP_URL=https://yourdomain.com
   SESSION_SECURE_COOKIE=true
   ```

### B. Set Up Scheduled Tasks (Cron)

Laravel's scheduler requires a cron job.

**Via cPanel → Cron Jobs:**

Add this cron job to run every minute:
```bash
* * * * * cd /home/username/laravel && php artisan schedule:run >> /dev/null 2>&1
```

### C. Set Up Queue Worker (Optional)

If using queues, add a cron job:
```bash
* * * * * cd /home/username/laravel && php artisan queue:work --stop-when-empty --max-time=3600
```

### D. Set Up Backups

**Database Backups:**
1. Use cPanel's backup wizard
2. Or set up automated backups via cron:
   ```bash
   0 2 * * * mysqldump -u username_dbuser -p'password' username_boxindustries > /home/username/backups/db_$(date +\%Y\%m\%d).sql
   ```

**File Backups:**
1. Use cPanel's backup wizard
2. Consider Git-based deployments for version control

### E. Monitoring

**Set up error monitoring:**
1. Check logs regularly: `storage/logs/laravel.log`
2. Consider services like:
   - Sentry (error tracking)
   - Laravel Forge (server management)
   - Envoyer (zero-downtime deployments)

### F. Performance Optimization

```bash
# Cache everything
php artisan optimize

# Or individually:
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 🚀 Future Deployments

For subsequent deployments, use the included deployment script:

```bash
# On your server, via SSH:
cd /home/username/laravel
bash deployment/scripts/deploy.sh
```

This script will:
- Pull latest code from Git
- Install dependencies
- Run migrations
- Clear and rebuild cache
- Restart queue workers

---

## 📞 Support & Resources

### Laravel Documentation
- Laravel 12: https://laravel.com/docs/12.x
- Inertia.js: https://inertiajs.com/
- Vue 3: https://vuejs.org/

### Hosting Support
- Contact your hosting provider if you need:
  - PHP version changes
  - Extension installations
  - SSH access
  - Composer installation

### Common cPanel Locations
- **File Manager:** cPanel → Files section
- **PHP Version:** cPanel → Software → Select PHP Version
- **MySQL Databases:** cPanel → Databases → MySQL Databases
- **phpMyAdmin:** cPanel → Databases → phpMyAdmin
- **Cron Jobs:** cPanel → Advanced → Cron Jobs
- **SSL/TLS:** cPanel → Security → SSL/TLS Status

---

## ✅ Deployment Checklist Summary

- [ ] PHP 8.2+ enabled with required extensions
- [ ] Database created and imported
- [ ] Application files uploaded
- [ ] `.env` file configured correctly
- [ ] `composer install --no-dev` completed
- [ ] `php artisan key:generate` ran
- [ ] Storage and bootstrap/cache permissions set (775)
- [ ] Domain document root pointed to `public/`
- [ ] SSL certificate installed
- [ ] Application accessible via browser
- [ ] Admin login works
- [ ] Cron job for scheduler added
- [ ] Cache optimized (`php artisan optimize`)

---

**Good luck with your deployment! 🎉**

If you encounter issues not covered in this guide, check the Laravel logs first:
```bash
tail -100 storage/logs/laravel.log
```

