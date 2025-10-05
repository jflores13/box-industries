# 📦 Deployment Resources

This directory contains everything you need to deploy your Box Industries Laravel application to cPanel.

---

## 🎯 Start Here

### 👉 **NEW: Read `START_HERE.md` first!** 👈

**✅ Do you have SSH access?**
- **YES** → Use **`SSH_CHEATSHEET.md`** then **`SSH_DEPLOYMENT_GUIDE.md`** (Recommended! Much easier)
- **NO** → Use **`CPANEL_DEPLOYMENT_GUIDE.md`** (Manual method)

---

## 📁 Directory Contents

### 📄 Documentation

- **`START_HERE.md`** 👉 **READ THIS FIRST** - Quick orientation guide
  - Compare deployment methods
  - Choose the right approach
  - 3-step quick start
  - Pre-flight checklist

- **`FORGE_VULTR_GUIDE.md`** 🏆 **RECOMMENDED** - Laravel Forge + Vultr deployment (professional)
  - Automated deployments (push to deploy)
  - 15-minute setup
  - Free SSL certificates
  - Built-in monitoring & queue workers
  - Zero-downtime deployments
  - Industry standard for Laravel

- **`SSH_DEPLOYMENT_GUIDE.md`** ⭐ - SSH-based deployment (DIY approach)
  - Simple, straightforward commands
  - Use Git directly on server
  - Automated with scripts
  - Budget-friendly

- **`SSH_CHEATSHEET.md`** 📋 - One-page copy-paste commands for SSH deployment
  - Quick initial setup
  - One-command updates
  - Emergency fixes
  - Useful aliases

- **`CPANEL_DEPLOYMENT_GUIDE.md`** - Manual deployment via cPanel GUI (fallback)
  - Pre-deployment checklist
  - Server setup instructions
  - Database configuration
  - Troubleshooting tips
  - Post-deployment tasks

### ⚙️ Configuration

- **`env.production.template`** - Production environment template
  - Pre-configured for cPanel hosting
  - Includes security best practices
  - All settings explained with comments
  - Copy this to `.env` on your server

### 🔧 Scripts

- **`scripts/deploy.sh`** - Automated deployment script
  - Pull latest code from Git
  - Install dependencies
  - Run migrations
  - Clear and rebuild cache
  - Restart queue workers
  - Zero-downtime deployment

- **`scripts/export-database.php`** - Database export helper
  - Exports local database to SQL file
  - Supports SQLite and MySQL
  - Includes import instructions
  - Shows file size and warnings

---

## 🚀 Quick Start

### With SSH Access (Recommended)

1. **Prepare locally:**
   ```bash
   npm run build
   php deployment/scripts/export-database.php
   git push origin main
   ```

2. **On server via SSH:**
   ```bash
   ssh username@yourdomain.com
   cd ~
   git clone https://github.com/yourusername/box-industries.git
   cd box-industries
   cp deployment/env.production.template .env
   nano .env  # Configure database
   composer install --no-dev
   php artisan key:generate
   # Import database and point domain to public/
   ```

3. **Read the complete SSH guide:**
   ```bash
   cat deployment/SSH_DEPLOYMENT_GUIDE.md
   ```

### Without SSH Access (Fallback)

1. **Read the complete guide:**
   ```bash
   cat deployment/CPANEL_DEPLOYMENT_GUIDE.md
   ```

2. **Export your database:**
   ```bash
   php deployment/scripts/export-database.php
   ```

3. **Build production assets:**
   ```bash
   npm run build
   ```

4. **Follow the deployment guide** for server setup and file upload

5. **Configure `.env` on server** using `env.production.template` as reference

---

## 🔄 Subsequent Deployments

After the initial deployment, use the deployment script:

```bash
# On your server via SSH
cd /home/username/laravel
bash deployment/scripts/deploy.sh
```

Or specify a different branch:

```bash
bash deployment/scripts/deploy.sh develop
```

---

## 📋 Pre-Deployment Checklist

Use this checklist before every deployment:

### Local Tasks
- [ ] All code committed and pushed to Git
- [ ] Tests passing: `php artisan test`
- [ ] Code formatted: `vendor/bin/pint`
- [ ] Assets built: `npm run build`
- [ ] Database exported (if schema changed)
- [ ] `.env.production.template` updated (if config changed)

### Server Tasks
- [ ] Backups created (database and files)
- [ ] Enough disk space available
- [ ] Server is accessible via SSH
- [ ] Domain/SSL certificate is configured

---

## 🔐 Security Notes

**CRITICAL:** Never commit these files to Git:
- `.env` (actual environment file)
- `database_export_*.sql` (database dumps)
- Any files with passwords or API keys

These are already in `.gitignore` but be careful when creating new files.

---

## 🛠️ Script Usage

### Deployment Script

```bash
# Basic usage
bash deployment/scripts/deploy.sh

# Deploy specific branch
bash deployment/scripts/deploy.sh staging

# Make executable (one-time setup)
chmod +x deployment/scripts/deploy.sh
```

**What it does:**
1. Enables maintenance mode
2. Pulls latest code from Git
3. Installs Composer dependencies
4. Runs database migrations
5. Clears all caches
6. Optimizes application
7. Sets file permissions
8. Restarts queue workers
9. Disables maintenance mode

### Database Export Script

```bash
# Export database
php deployment/scripts/export-database.php

# Make executable (one-time setup)
chmod +x deployment/scripts/export-database.php
```

**Output:**
- SQLite: `database_export_YYYY-MM-DD_HHMMSS.sqlite` or `.sql`
- MySQL: `database_export_YYYY-MM-DD_HHMMSS.sql`

---

## 🐛 Troubleshooting

### Deployment Script Issues

**"Not in Laravel root directory"**
```bash
cd /home/username/laravel
bash deployment/scripts/deploy.sh
```

**"Git not found"**
- Upload files manually via FTP
- Or ask hosting provider to install Git

**"Composer not found"**
- Download composer.phar to your directory
- Script will automatically try using it

### Database Export Issues

**"mysqldump command not found"**
- Export manually from phpMyAdmin
- Or use: `php artisan db:show` to view connection details

**"Permission denied"**
```bash
chmod +x deployment/scripts/export-database.php
php deployment/scripts/export-database.php
```

---

## 📚 Additional Resources

### Laravel Documentation
- [Deployment](https://laravel.com/docs/12.x/deployment)
- [Configuration](https://laravel.com/docs/12.x/configuration)
- [Optimization](https://laravel.com/docs/12.x/deployment#optimization)

### cPanel Documentation
- [cPanel Documentation](https://docs.cpanel.net/)
- [Managing Domains](https://docs.cpanel.net/cpanel/domains/)
- [MySQL Databases](https://docs.cpanel.net/cpanel/databases/mysql-databases/)

### Git Deployment
- [GitHub](https://github.com)
- [GitLab](https://gitlab.com)
- [Bitbucket](https://bitbucket.org)

---

## ⏰ Maintenance Tasks

### Daily
- Monitor logs: `tail -f storage/logs/laravel.log`
- Check disk space usage

### Weekly
- Review error logs
- Test backup restoration
- Update dependencies (if needed)

### Monthly
- Security updates: `composer update --no-dev`
- Database optimization: `php artisan optimize:clear`
- Clean old logs: `rm storage/logs/laravel-*.log`

---

## 🆘 Getting Help

If you encounter issues:

1. **Check the deployment guide** - Most common issues are covered
2. **View Laravel logs** - `tail -100 storage/logs/laravel.log`
3. **Check server logs** - cPanel → Errors
4. **Contact hosting support** - For server configuration issues
5. **Laravel documentation** - https://laravel.com/docs

---

## 📝 Notes

- Always test deployments in staging environment first
- Keep backups before deploying major changes
- Document any custom server configurations
- Update this README if you add custom deployment steps

---

**Happy Deploying! 🚀**

