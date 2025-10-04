# ⚡ Quick Deployment Reference Card

**Keep this handy during deployment!**

---

## 🔑 SSH Access (RECOMMENDED)

### Connect to Server
```bash
ssh username@yourdomain.com
```

### Quick Deployment (After Initial Setup)
```bash
cd ~/box-industries
bash deployment/scripts/deploy.sh
```

---

## 🎯 Essential Commands

### Initial Setup (SSH Method)
```bash
# Locally:
npm run build
php deployment/scripts/export-database.php
git push origin main

# On server:
ssh username@yourdomain.com
git clone https://github.com/yourusername/box-industries.git
cd box-industries
cp deployment/env.production.template .env
nano .env  # Configure DB
composer install --no-dev
php artisan key:generate
mysql -u dbuser -p database < database_export.sql
chmod -R 775 storage bootstrap/cache
php artisan optimize
```

### Future Deployments (SSH)
```bash
ssh username@yourdomain.com
cd ~/box-industries
bash deployment/scripts/deploy.sh
```

---

## 📋 Essential .env Settings

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=username_dbname
DB_USERNAME=username_user
DB_PASSWORD=your_password

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
```

---

## 🔧 Essential Artisan Commands

```bash
# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate --force

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize
# OR separately:
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Check database connection
php artisan db:show

# View logs
tail -f storage/logs/laravel.log
tail -100 storage/logs/laravel.log
```

---

## 📁 Critical File Permissions

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chmod 644 .env
```

---

## 🌐 cPanel Locations

| Task | Location |
|------|----------|
| PHP Version | Software → Select PHP Version |
| Databases | Databases → MySQL Databases |
| phpMyAdmin | Databases → phpMyAdmin |
| File Manager | Files → File Manager |
| Cron Jobs | Advanced → Cron Jobs |
| SSL Certificate | Security → SSL/TLS Status |
| Error Logs | Metrics → Errors |

---

## 📍 Document Root Settings

**Change your domain's document root to:**
```
/home/username/laravel/public
```

Or create symbolic link:
```bash
cd /home/username
rm -rf public_html
ln -s /home/username/laravel/public public_html
```

---

## ⚠️ Common Issues & Quick Fixes

### 500 Error
```bash
php artisan cache:clear
php artisan config:clear
chmod -R 775 storage bootstrap/cache
tail -f storage/logs/laravel.log
```

### CSS/JS Not Loading
```bash
# Locally:
npm run build
# Then upload: public/build/
```

### Database Connection Error
```bash
php artisan db:show  # Verify settings
# Check .env: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### Session Issues
```bash
php artisan migrate --force  # Ensure sessions table exists
php artisan cache:clear
```

---

## 🔐 Security Checklist

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Strong database password
- [ ] `SESSION_SECURE_COOKIE=true` (if using HTTPS)
- [ ] SSL certificate installed
- [ ] `.env` file permissions: 644
- [ ] Storage permissions: 775

---

## 📞 Emergency Contacts

**Hosting Support:**
- Check your hosting provider's support page
- Have cPanel credentials ready

**Laravel Resources:**
- Documentation: https://laravel.com/docs/12.x
- Forums: https://laracasts.com/discuss

---

## 🚀 Deployment Workflow

1. **Prepare Locally:**
   ```bash
   git pull origin main
   composer install
   npm install
   npm run build
   php artisan test
   php deployment/scripts/export-database.php
   git push origin main
   ```

2. **On Server:**
   ```bash
   cd /home/username/laravel
   bash deployment/scripts/deploy.sh
   ```

3. **Verify:**
   - Visit your website
   - Test login
   - Check admin dashboard
   - Monitor logs

---

## 📊 Health Check Commands

```bash
# Check PHP version
php -v

# Check installed PHP modules
php -m

# Check Composer
composer --version

# Check Git
git --version

# Check disk space
df -h

# Check Laravel version
php artisan --version

# Check queue workers (if using queues)
ps aux | grep queue

# Check application status
php artisan about
```

---

## 🕐 Cron Job Examples

**Laravel Scheduler (Required):**
```cron
* * * * * cd /home/username/laravel && php artisan schedule:run >> /dev/null 2>&1
```

**Queue Worker (If using queues):**
```cron
* * * * * cd /home/username/laravel && php artisan queue:work --stop-when-empty --max-time=3600
```

**Database Backup (Daily at 2 AM):**
```cron
0 2 * * * mysqldump -u username_dbuser -p'password' username_db > /home/username/backups/db_$(date +\%Y\%m\%d).sql
```

---

## 💾 Database Import Methods

**Via phpMyAdmin:**
1. cPanel → phpMyAdmin
2. Select database
3. Click "Import"
4. Choose SQL file
5. Click "Go"

**Via SSH:**
```bash
mysql -u username_dbuser -p username_dbname < database_export.sql
```

---

## 🔄 Rollback Procedure

If deployment fails:

```bash
# 1. Enable maintenance mode
php artisan down

# 2. Rollback to previous Git commit
git log --oneline  # Find previous commit
git reset --hard COMMIT_HASH

# 3. Reinstall dependencies
composer install --no-dev

# 4. Clear cache
php artisan cache:clear
php artisan config:clear

# 5. Bring application back up
php artisan up
```

---

**Print this page and keep it near your desk! 📄**

