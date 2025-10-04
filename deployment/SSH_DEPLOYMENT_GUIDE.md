# 🚀 SSH Deployment Guide for cPanel (Recommended)

**You have SSH access - use this guide! It's the professional way to deploy.**

---

## ⚡ Why SSH?

- **Fast:** No file uploads, clone directly from Git
- **Automated:** Use deployment scripts
- **Reliable:** Direct command execution
- **Industry Standard:** How professionals deploy

---

## 📋 Prerequisites Checklist

### On Your Local Machine
- [ ] Code pushed to Git (GitHub, GitLab, Bitbucket)
- [ ] Assets built: `npm run build`
- [ ] Database exported: `php deployment/scripts/export-database.php`

### On cPanel
- [ ] SSH access credentials
- [ ] PHP 8.2+ enabled
- [ ] MySQL database created
- [ ] Domain/subdomain configured

---

## 🎯 Deployment Process

### Step 1: Connect via SSH

```bash
ssh username@yourdomain.com
# or
ssh username@server-ip-address
```

Enter your password when prompted.

**First time?** Your hosting provider gave you:
- Username (usually your cPanel username)
- Password or SSH key
- Hostname (domain or IP address)

### Step 2: Check Server Environment

```bash
# Check PHP version (need 8.2+)
php -v

# Check available PHP versions
ls /usr/bin/php*
# or
which php82  # Might be php82, php83, etc.

# If you need a specific version, use it:
alias php='/usr/bin/php82'  # Adjust as needed

# Check Composer
composer --version

# If composer not found:
which composer
# You may need to install it or use composer.phar
```

### Step 3: Set Up Directory Structure

```bash
# Navigate to home directory
cd ~

# You'll see something like:
# /home/username/

# Check what's there
ls -la

# You should see:
# - public_html/  (your current WordPress site)
# - Other directories...
```

**Recommended structure:**
```
/home/username/
  ├── box-industries/     ← Your Laravel app (new)
  │   └── public/         ← Laravel's public directory
  ├── public_html/        ← Your WordPress site (existing)
  └── backups/            ← Create this for backups
```

### Step 4: Create Backup Directory

```bash
mkdir -p ~/backups
```

### Step 5: Set Up MySQL Database

**Via SSH, you can use the cPanel API, but it's easier via cPanel GUI:**

1. Open cPanel in browser
2. Go to **MySQL® Databases**
3. Create database: `username_boxindustries`
4. Create user: `username_dbuser`
5. Generate strong password → **Save it!**
6. Add user to database with ALL PRIVILEGES

**Or via SSH with cPanel API (advanced):**
```bash
# This might work on some cPanel servers:
uapi --user=username Mysql create_database name=username_boxindustries
uapi --user=username Mysql create_user name=username_dbuser password='StrongPassword123!'
uapi --user=username Mysql set_privileges_on_database user=username_dbuser database=username_boxindustries privileges=ALL
```

### Step 6: Clone Your Repository

```bash
cd ~

# Clone from GitHub (adjust URL to your repo)
git clone https://github.com/yourusername/box-industries.git

# Or GitLab
git clone https://gitlab.com/yourusername/box-industries.git

# Or Bitbucket
git clone https://bitbucket.org/yourusername/box-industries.git
```

**If your repo is private, you'll need authentication:**

**Option A: Personal Access Token (Recommended)**
```bash
# GitHub: https://github.com/settings/tokens
# Create token, then:
git clone https://YOUR_TOKEN@github.com/yourusername/box-industries.git
```

**Option B: SSH Key**
```bash
# Generate SSH key on server
ssh-keygen -t ed25519 -C "your_email@example.com"

# Copy public key
cat ~/.ssh/id_ed25519.pub

# Add to GitHub: Settings → SSH Keys
# Then clone:
git clone git@github.com:yourusername/box-industries.git
```

### Step 7: Navigate to Your App

```bash
cd ~/box-industries

# Verify you're in the right place
ls -la
# You should see: app/, config/, database/, public/, etc.
```

### Step 8: Create and Configure .env

```bash
# Copy the production template
cp deployment/env.production.template .env

# Edit with nano (easier) or vi
nano .env

# Update these values:
# APP_URL=https://yourdomain.com
# DB_DATABASE=username_boxindustries
# DB_USERNAME=username_dbuser
# DB_PASSWORD=your_strong_password
#
# Save: Ctrl+O, Enter, Ctrl+X
```

**Critical .env settings:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=username_boxindustries
DB_USERNAME=username_dbuser
DB_PASSWORD=YourStrongPassword

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true

CACHE_STORE=file
QUEUE_CONNECTION=database
```

### Step 9: Install Composer Dependencies

```bash
# Production install (no dev dependencies)
composer install --no-dev --optimize-autoloader

# If you get memory errors:
php -d memory_limit=-1 $(which composer) install --no-dev --optimize-autoloader

# If composer isn't installed, download it:
curl -sS https://getcomposer.org/installer | php
# Then use:
php composer.phar install --no-dev --optimize-autoloader
```

### Step 10: Generate Application Key

```bash
php artisan key:generate
```

This will update your `.env` file with a secure `APP_KEY`.

### Step 11: Import Database

**First, upload your database export to the server:**

```bash
# On your LOCAL machine, upload the export:
scp database_export_*.sql username@yourdomain.com:~/box-industries/
```

**Then on the server:**

```bash
cd ~/box-industries

# Import into MySQL
mysql -u username_dbuser -p username_boxindustries < database_export_*.sql

# Enter your database password when prompted
```

**Verify import:**
```bash
php artisan db:show
php artisan migrate:status
```

### Step 12: Set File Permissions

```bash
cd ~/box-industries

# Storage and cache directories need write permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# .env should be readable only by you
chmod 644 .env
```

### Step 13: Create Storage Link

```bash
php artisan storage:link
```

### Step 14: Optimize Application

```bash
# Cache everything for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 15: Point Domain to Laravel

You have several options:

**Option A: Change Document Root (Recommended)**

1. Go to cPanel → **Domains**
2. Click your domain (or create subdomain like `app.yourdomain.com`)
3. Change **Document Root** to: `/home/username/box-industries/public`
4. Save

**Option B: Symbolic Link (If WordPress is on main domain)**

```bash
# Create subdomain in cPanel first: app.yourdomain.com
# Point it to any directory, then:

cd ~
# Remove the default public_html for subdomain
rm -rf app.yourdomain.com/public_html

# Create symbolic link
ln -s ~/box-industries/public ~/app.yourdomain.com/public_html
```

**Option C: Keep WordPress on main domain, Laravel on subdomain**

This is the cleanest approach:
- `yourdomain.com` → WordPress (stays in `~/public_html`)
- `app.yourdomain.com` → Laravel (points to `~/box-industries/public`)

In cPanel → **Domains** → **Create Subdomain**:
- Subdomain: `app`
- Document Root: `/home/username/box-industries/public`

### Step 16: Set Up SSL (HTTPS)

```bash
# Check if AutoSSL is enabled in cPanel
# Go to: Security → SSL/TLS Status → Run AutoSSL
```

Once SSL is active, update `.env`:
```bash
nano .env
# Change APP_URL to https://
# Set SESSION_SECURE_COOKIE=true
```

Then recache:
```bash
php artisan config:cache
```

### Step 17: Test Your Application

```bash
# Visit your domain
# You should see your Box Industries homepage

# Check for errors:
tail -f storage/logs/laravel.log

# Test database connection:
php artisan db:show

# Test a simple artisan command:
php artisan about
```

---

## 🔄 Future Deployments (Super Easy!)

Once initial setup is complete, deployments are simple:

```bash
# SSH into server
ssh username@yourdomain.com

# Navigate to app
cd ~/box-industries

# Run deployment script
bash deployment/scripts/deploy.sh
```

**That's it!** The script automatically:
- Enables maintenance mode
- Pulls latest code
- Installs dependencies
- Runs migrations
- Clears cache
- Optimizes application
- Disables maintenance mode

---

## 🛠️ Essential SSH Commands

### View Logs
```bash
# Real-time log monitoring
tail -f storage/logs/laravel.log

# Last 100 lines
tail -100 storage/logs/laravel.log

# Search logs
grep "error" storage/logs/laravel.log
```

### Artisan Commands
```bash
# Clear all cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan optimize

# Run migrations
php artisan migrate --force

# Check database
php artisan db:show

# Check application status
php artisan about

# Tinker (Laravel REPL)
php artisan tinker
```

### Git Commands
```bash
# Pull latest code
git pull origin main

# Check current branch
git branch

# Check status
git status

# View recent commits
git log --oneline -10
```

### File Management
```bash
# List files
ls -la

# Check disk space
df -h

# Check directory size
du -sh ~/box-industries

# Copy files
cp source destination

# Move/rename files
mv old-name new-name

# Remove files (careful!)
rm filename
rm -rf directory/
```

### Process Management
```bash
# Check running processes
ps aux | grep php

# Check queue workers
ps aux | grep queue

# Kill a process
kill PID
```

---

## ⏰ Set Up Cron Jobs

Laravel needs a cron job for scheduled tasks.

**Via cPanel:**
1. Go to **Advanced → Cron Jobs**
2. Add new cron job:

```
* * * * * cd /home/username/box-industries && php artisan schedule:run >> /dev/null 2>&1
```

**For queue workers (if using queues):**
```
* * * * * cd /home/username/box-industries && php artisan queue:work --stop-when-empty --max-time=3600
```

**Via SSH (if you have crontab access):**
```bash
crontab -e
# Add the lines above
```

---

## 🔐 Security Best Practices

### Secure Your .env
```bash
chmod 644 .env
# Only you can read/write, others can only read (but web server can't access it anyway)
```

### Keep .git Private
Your `.git` directory is outside `public/`, so it's already protected.
But verify:
```bash
# This should NOT be accessible via browser
curl https://yourdomain.com/.git/config
# Should get 404 or error
```

### Regular Updates
```bash
# Update dependencies (test in staging first!)
composer update --no-dev

# Clear cache after updates
php artisan optimize:clear
php artisan optimize
```

---

## 📦 Database Backups via SSH

### Manual Backup
```bash
cd ~/backups

# Backup database
mysqldump -u username_dbuser -p username_boxindustries > db_$(date +%Y%m%d_%H%M%S).sql

# Backup files
tar -czf files_$(date +%Y%m%d_%H%M%S).tar.gz ~/box-industries
```

### Automated Daily Backup (Cron)
```bash
# Add to crontab (crontab -e or via cPanel):
0 2 * * * mysqldump -u username_dbuser -p'YourPassword' username_boxindustries > /home/username/backups/db_$(date +\%Y\%m\%d).sql 2>&1
```

### Download Backup to Local
```bash
# On your local machine:
scp username@yourdomain.com:~/backups/db_*.sql ./local-backup-directory/
```

---

## 🐛 Troubleshooting

### "Permission denied" when running scripts
```bash
chmod +x deployment/scripts/*.sh
chmod +x deployment/scripts/*.php
```

### "Git not found"
```bash
# Check if git is available
which git

# Contact hosting support if not installed
# Or download Git for cPanel
```

### "Composer not found"
```bash
# Download composer.phar
cd ~/box-industries
curl -sS https://getcomposer.org/installer | php

# Use it:
php composer.phar install --no-dev
```

### "Wrong PHP version"
```bash
# Check available versions
ls /usr/bin/php*

# Use specific version
/usr/bin/php82 artisan --version

# Or set alias in ~/.bashrc
echo "alias php='/usr/bin/php82'" >> ~/.bashrc
source ~/.bashrc
```

### "Can't write to storage/"
```bash
chmod -R 775 storage bootstrap/cache
```

### SSH Connection Issues
```bash
# Test connection
ssh -v username@yourdomain.com

# Check SSH is on port 22 (or different port)
ssh -p 2222 username@yourdomain.com
```

---

## 🎓 Pro Tips

### 1. Use Git Tags for Releases
```bash
# On local machine
git tag -a v1.0.0 -m "Initial production release"
git push origin v1.0.0

# On server
git fetch --tags
git checkout v1.0.0
```

### 2. Use .bashrc Aliases
```bash
# Add to ~/.bashrc
nano ~/.bashrc

# Add these lines:
alias art='php artisan'
alias t='php artisan tinker'
alias logs='tail -f storage/logs/laravel.log'
alias deploy='bash deployment/scripts/deploy.sh'

# Save and reload
source ~/.bashrc

# Now you can just type:
art migrate
logs
deploy
```

### 3. Create Deployment Checklist Script
```bash
# Create ~/deploy-checklist.sh
nano ~/deploy-checklist.sh
```

Add:
```bash
#!/bin/bash
cd ~/box-industries
echo "✓ Current branch: $(git branch --show-current)"
echo "✓ Last commit: $(git log -1 --oneline)"
echo "✓ Laravel version: $(php artisan --version)"
echo "✓ Database: $(php artisan db:show | head -5)"
echo "✓ Disk space: $(df -h . | tail -1 | awk '{print $4}')"
```

Make executable:
```bash
chmod +x ~/deploy-checklist.sh
```

### 4. Quick Access
```bash
# Add to ~/.bashrc
echo "cd ~/box-industries" >> ~/.bashrc
# Now when you SSH in, you're automatically in the right directory
```

---

## ✅ Post-Deployment Checklist

- [ ] Website loads correctly
- [ ] SSL certificate active (https://)
- [ ] Admin login works
- [ ] Database queries work
- [ ] Images/assets load
- [ ] Forms submit correctly
- [ ] Email sending works (test registration/contact forms)
- [ ] Cron job scheduled
- [ ] Error logs are clean
- [ ] Backups configured

---

## 🚀 Complete Initial Deployment Summary

```bash
# 1. SSH into server
ssh username@yourdomain.com

# 2. Clone repository
cd ~
git clone https://github.com/yourusername/box-industries.git

# 3. Configure
cd box-industries
cp deployment/env.production.template .env
nano .env  # Edit database credentials

# 4. Install dependencies
composer install --no-dev --optimize-autoloader

# 5. Setup Laravel
php artisan key:generate
mysql -u dbuser -p database < database_export.sql
php artisan migrate:status

# 6. Permissions
chmod -R 775 storage bootstrap/cache
chmod 644 .env

# 7. Optimize
php artisan storage:link
php artisan optimize

# 8. Point domain in cPanel to: ~/box-industries/public

# 9. Setup SSL and cron jobs

# Done! 🎉
```

---

**Welcome to professional deployment! 🚀**

Need help with any step? The commands are ready to copy-paste.

