# 🚀 SSH Deployment Cheatsheet

**Copy-paste these commands for quick deployment!**

---

## 📦 Initial Setup (One-Time)

### 1️⃣ Prepare Locally
```bash
npm run build
php deployment/scripts/export-database.php
git add .
git commit -m "Ready for deployment"
git push origin main
```

### 2️⃣ Setup Database in cPanel
1. Open cPanel → MySQL® Databases
2. Create database: `username_boxindustries`
3. Create user: `username_dbuser`
4. Add user to database with ALL PRIVILEGES
5. **Save credentials!**

### 3️⃣ Deploy via SSH
```bash
# Connect
ssh username@yourdomain.com

# Clone repo
cd ~
git clone https://github.com/yourusername/box-industries.git
cd box-industries

# Configure
cp deployment/env.production.template .env
nano .env
# Update: APP_URL, DB_* credentials
# Save: Ctrl+O, Enter, Ctrl+X

# Install
composer install --no-dev --optimize-autoloader
php artisan key:generate

# Upload database file from local machine (new terminal):
# scp database_export_*.sql username@yourdomain.com:~/box-industries/

# Back on server, import database:
mysql -u username_dbuser -p username_boxindustries < database_export_*.sql

# Set permissions
chmod -R 775 storage bootstrap/cache
chmod 644 .env

# Optimize
php artisan storage:link
php artisan optimize

# Check status
php artisan about
php artisan db:show
```

### 4️⃣ Point Domain
**In cPanel → Domains:**
- Domain: `yourdomain.com` or create subdomain `app.yourdomain.com`
- Document Root: `/home/username/box-industries/public`

### 5️⃣ Setup SSL & Cron
**SSL:** cPanel → SSL/TLS Status → Run AutoSSL

**Cron:** cPanel → Cron Jobs → Add:
```
* * * * * cd /home/username/box-industries && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🔄 Updates (Every Deployment)

```bash
ssh username@yourdomain.com
cd ~/box-industries
bash deployment/scripts/deploy.sh
```

**Done!** ✅

---

## 🐛 Quick Fixes

### 500 Error
```bash
cd ~/box-industries
php artisan cache:clear
php artisan config:clear
chmod -R 775 storage bootstrap/cache
tail -f storage/logs/laravel.log
```

### Can't Connect to Database
```bash
php artisan db:show  # Check connection
nano .env            # Verify credentials
php artisan config:cache
```

### Permission Denied
```bash
chmod -R 775 storage bootstrap/cache
```

### Git Issues
```bash
git status
git stash
git pull origin main
```

---

## 📝 Useful Aliases

Add to `~/.bashrc`:
```bash
nano ~/.bashrc
```

Add these lines:
```bash
alias art='php artisan'
alias logs='tail -f storage/logs/laravel.log'
alias deploy='cd ~/box-industries && bash deployment/scripts/deploy.sh'
alias box='cd ~/box-industries'
```

Save and reload:
```bash
source ~/.bashrc
```

Now you can just type:
- `box` → Go to app directory
- `art migrate` → Run migrations
- `logs` → View logs
- `deploy` → Deploy app

---

## 🔍 Health Check

```bash
cd ~/box-industries

# Check everything
php artisan about

# Check database
php artisan db:show

# Check routes
php artisan route:list

# Check logs
tail -50 storage/logs/laravel.log

# Check disk space
df -h

# Check PHP version
php -v

# Check running processes
ps aux | grep php
```

---

## 📦 Database Operations

### Backup
```bash
mysqldump -u username_dbuser -p username_boxindustries > ~/backups/db_$(date +%Y%m%d).sql
```

### Import
```bash
mysql -u username_dbuser -p username_boxindustries < database_export.sql
```

### Download Backup to Local
```bash
# On your local machine:
scp username@yourdomain.com:~/backups/db_*.sql ./
```

---

## 🚨 Emergency Rollback

```bash
cd ~/box-industries
php artisan down
git log --oneline -10        # Find previous working commit
git reset --hard COMMIT_HASH
composer install --no-dev
php artisan optimize:clear
php artisan optimize
php artisan up
```

---

## 📱 File Transfer

### Upload File
```bash
# From local machine:
scp localfile.txt username@yourdomain.com:~/box-industries/
```

### Download File
```bash
# From local machine:
scp username@yourdomain.com:~/box-industries/remotefile.txt ./
```

### Upload Directory
```bash
scp -r local-directory/ username@yourdomain.com:~/box-industries/
```

---

## ⚙️ PHP Version Issues

If cPanel uses different PHP versions:
```bash
# Check available versions
ls /usr/bin/php*

# Use specific version
/usr/bin/php82 artisan --version

# Set permanent alias
echo "alias php='/usr/bin/php82'" >> ~/.bashrc
source ~/.bashrc
```

---

**Pro Tip:** Keep this file open in a browser tab during deployment! 🚀

