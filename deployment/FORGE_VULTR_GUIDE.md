# 🚀 Deploying with Laravel Forge + Vultr

**Welcome to the professional way to deploy Laravel!** This guide walks you through deploying your Box Industries application using Laravel Forge (server management) and Vultr (cloud hosting).

---

## 🎯 Why Forge + Vultr?

| Feature | Forge + Vultr | cPanel |
|---------|---------------|--------|
| **Setup Time** | 5 minutes | 30+ minutes |
| **Automation** | ✅ Full deployment automation | ❌ Manual |
| **SSL** | ✅ Automatic (Let's Encrypt) | ⚠️ Manual setup |
| **Queue Workers** | ✅ Auto-managed | ⚠️ Cron jobs |
| **Database** | ✅ MySQL optimized | ⚠️ Shared |
| **Performance** | ⚡ Dedicated VPS | 🐌 Shared hosting |
| **Cost** | $5-10/month Vultr + $12/month Forge | $5-20/month |
| **Professional** | ✅ Industry standard | ❌ Outdated |

**Total Cost:** ~$17-22/month for professional hosting

---

## 📋 Prerequisites

Before you start, you'll need:

### 1. Laravel Forge Account
- **Sign up:** https://forge.laravel.com
- **Cost:** $12/month (first server free for 5 days trial)
- **What it does:** Manages your server, deployments, SSL, databases, etc.

### 2. Vultr Account
- **Sign up:** https://www.vultr.com
- **Cost:** $5-10/month for a VPS (starts at $5/month)
- **What it does:** Provides the actual server (cloud VPS)
- **Alternative providers:** DigitalOcean, Linode, AWS, Hetzner

### 3. Domain Name
- Your domain (e.g., `boxindustries.com`)
- Access to DNS settings

### 4. Git Repository
- Code hosted on GitHub, GitLab, or Bitbucket
- Forge will pull code directly from your repo

---

## 🎬 Step-by-Step Deployment

### Phase 1: Prepare Your Application (5 minutes)

#### 1. Build Production Assets
```bash
cd /Users/jflores/Herd/box-industries
npm run build
```

#### 2. Commit and Push Everything
```bash
git add .
git commit -m "Prepare for production deployment"
git push origin main
```

#### 3. Create Environment Template
Your `.env.example` should include all needed variables. Forge will help configure it.

---

### Phase 2: Create Vultr Server (3 minutes)

#### 1. Log into Vultr
- Go to https://my.vultr.com
- Click **Deploy New Server**

#### 2. Choose Server Configuration

**Cloud Compute - Shared CPU** (recommended for starting)
- **Location:** Choose closest to your users (e.g., US, Europe)
- **Server Type:** Ubuntu 24.04 LTS (recommended)
- **Server Size:** 
  - Start: $5/month (1 CPU, 1GB RAM) - good for small apps
  - Better: $10/month (1 CPU, 2GB RAM) - recommended
  - Production: $20/month (2 CPU, 4GB RAM) - for high traffic

**Important Settings:**
- ✅ Enable Auto Backups ($1/month - recommended)
- ✅ Enable IPv6 (free)
- ❌ Skip additional features for now

#### 3. Deploy Server
- Click **Deploy Now**
- Wait 2-3 minutes for server to provision
- **Copy the IP address** - you'll need this for Forge

---

### Phase 3: Connect Forge to Vultr (2 minutes)

#### 1. Link Vultr to Forge (Optional but recommended)

In Laravel Forge:
1. Go to **Account** → **Source Control**
2. Click **Vultr** section
3. Add your Vultr API key
   - Get it from: https://my.vultr.com/settings/#settingsapi
   - This allows Forge to create servers directly

**OR** manually add your Vultr server's IP (easier for first time)

---

### Phase 4: Create Server in Forge (5 minutes)

#### 1. Create New Server in Forge

In Laravel Forge Dashboard:
1. Click **Create Server**
2. Choose **Custom VPS** (if not using Vultr API)

**Server Configuration:**
- **Name:** Box Industries Production
- **IP Address:** [Your Vultr server IP]
- **PHP Version:** PHP 8.4 (or 8.3/8.2)
- **Database:** MySQL 8.0 (recommended)
- **Database Name:** box_industries
- **Database User:** forge (or custom)

**Optional Features:**
- ✅ Node.js (required for npm)
- ✅ Redis (optional - good for caching)
- ❌ Skip other features for now

#### 2. Click Create Server
- Forge will spend 5-10 minutes provisioning your server
- It automatically installs: PHP, Nginx, MySQL, Node.js, Composer, etc.
- ☕ Grab a coffee!

---

### Phase 5: Create Site in Forge (3 minutes)

Once server provisioning completes:

#### 1. Create New Site
In Forge → Your Server → **Sites** → **New Site**

**Site Details:**
- **Root Domain:** `boxindustries.com`
- **Aliases:** `www.boxindustries.com` (optional)
- **Project Type:** Web Application
- **Web Directory:** `/public` (Laravel standard)

#### 2. Click Add Site
Forge creates the site structure automatically

---

### Phase 6: Connect Git Repository (2 minutes)

#### 1. Link Source Control to Forge

First time only:
1. Go to **Account** → **Source Control**
2. Connect GitHub/GitLab/Bitbucket
3. Authorize Forge to access your repositories

#### 2. Install Repository on Site

In Forge → Your Server → Your Site → **Git Repository**:
- **Provider:** GitHub (or your provider)
- **Repository:** `your-username/box-industries`
- **Branch:** `main` (or `master`)
- ✅ Install Composer Dependencies

Click **Install Repository**

Forge will:
- Clone your repository
- Run `composer install --no-dev`
- Set up proper permissions

---

### Phase 7: Configure Environment (5 minutes)

#### 1. Edit Environment File

In Forge → Your Site → **Environment**

Replace with this configuration:

```env
APP_NAME="Box Industries"
APP_ENV=production
APP_KEY=                    # Forge generates this automatically
APP_DEBUG=false
APP_TIMEZONE=UTC
APP_URL=https://boxindustries.com

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

# Database (auto-configured by Forge)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=box_industries
DB_USERNAME=forge
DB_PASSWORD=                # Forge fills this automatically

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

# Cache
CACHE_STORE=redis          # Using Redis is better than file
CACHE_PREFIX=

# Queue
QUEUE_CONNECTION=database
QUEUE_FAILED_DRIVER=database

# Mail (configure based on your mail service)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@boxindustries.com
MAIL_FROM_NAME="${APP_NAME}"

# Logging
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=warning

# Broadcasting
BROADCAST_CONNECTION=log

# Filesystem
FILESYSTEM_DISK=public

# Vite
VITE_APP_NAME="${APP_NAME}"

# Inertia
INERTIA_SSR_ENABLED=false

# Redis (if enabled)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Click **Save** - this automatically updates your `.env` file

#### 2. Generate Application Key

In Forge → Your Site → **Commands**:
```bash
php artisan key:generate
```

---

### Phase 8: Database Setup (5 minutes)

#### 1. Create Database User (Already done by Forge)

Forge automatically created:
- Database: `box_industries`
- User: `forge`
- Password: (shown in .env)

#### 2. Import Your Database

**Option A: Via SSH + SQL File**

First, export your local database:
```bash
php deployment/scripts/export-database.php
```

Then SSH into your server:
```bash
# Get SSH details from Forge → Your Server → Meta
ssh forge@your-server-ip

# Upload SQL file (from your local machine)
scp database_export_*.sql forge@your-server-ip:/home/forge/boxindustries.com/

# Import on server
mysql -u forge -p box_industries < /home/forge/boxindustries.com/database_export_*.sql
```

**Option B: Via Migrations (Recommended for fresh setup)**

In Forge → Your Site → **Commands**:
```bash
php artisan migrate --force
php artisan db:seed --force
```

---

### Phase 9: Configure Deployment Script (3 minutes)

Forge uses deployment scripts to automate your deployments.

#### 1. Edit Deployment Script

In Forge → Your Site → **Deployment** → **Edit Deploy Script**

Replace with this optimized script:

```bash
cd /home/forge/boxindustries.com

# Exit on any error
set -e

echo "🚀 Starting deployment..."

# Enable maintenance mode
php artisan down || true

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize application
php artisan optimize

# Restart queue workers
php artisan queue:restart

# Disable maintenance mode
php artisan up

echo "✅ Deployment complete!"
```

Click **Save**

#### 2. Enable Quick Deploy (Optional)

Toggle **Quick Deploy** ON if you want automatic deployments on every `git push`

---

### Phase 10: Setup Queue Workers (2 minutes)

Your application uses queues, so let's set up workers.

#### 1. Create Queue Worker

In Forge → Your Server → **Daemons** → **New Daemon**

**Configuration:**
- **Command:** `php artisan queue:work --sleep=3 --tries=3 --max-time=3600`
- **Directory:** `/home/forge/boxindustries.com`
- **User:** `forge`
- **Processes:** 1 (increase for more throughput)

Click **Create Daemon**

Forge automatically creates a supervisor configuration and starts the worker.

---

### Phase 11: Configure Scheduler (1 minute)

Laravel's task scheduler needs a cron job.

**Good news:** Forge already set this up automatically! ✅

You can verify in Forge → Your Server → **Scheduler** - you should see:
```
* * * * * php /home/forge/boxindustries.com/artisan schedule:run
```

---

### Phase 12: Configure Domain & SSL (3 minutes)

#### 1. Point Your Domain to Server

In your domain registrar (GoDaddy, Namecheap, Cloudflare, etc.):

Add these DNS records:
```
Type: A
Name: @
Value: [Your Vultr Server IP]
TTL: 300

Type: A
Name: www
Value: [Your Vultr Server IP]
TTL: 300
```

**Wait 5-10 minutes** for DNS propagation (can take up to 48 hours)

#### 2. Install SSL Certificate (Free!)

Once DNS is pointing:

In Forge → Your Site → **SSL** → **LetsEncrypt**
- Domain: `boxindustries.com www.boxindustries.com`
- Click **Obtain Certificate**

Forge automatically:
- Generates SSL certificate (free via Let's Encrypt)
- Configures Nginx
- Sets up auto-renewal
- Forces HTTPS

**Done!** Your site is now secure with `https://` ✅

---

### Phase 13: Deploy! (1 minute)

Everything is configured. Time to deploy!

#### Option A: Manual Deployment

In Forge → Your Site → **Deployment**:
- Click **Deploy Now**
- Watch the deployment log
- Wait for "✅ Deployment complete!"

#### Option B: Auto-Deploy

If Quick Deploy is enabled:
```bash
# From your local machine
git push origin main
```

Forge automatically detects the push and deploys! 🎉

---

## ✅ Post-Deployment Checklist

After deployment, verify everything works:

### 1. Test Your Site
- Visit `https://boxindustries.com`
- Check all pages load correctly
- Test forms and functionality
- Verify images and assets load

### 2. Check Logs

In Forge → Your Site → **Logs** → **Laravel Log**
- Look for any errors
- Should see successful requests

### 3. Verify Queue Workers

In Forge → Your Server → **Daemons**
- Status should be **Running** (green)

### 4. Test SSL

Visit: https://www.ssllabs.com/ssltest/analyze.html?d=boxindustries.com
- Should get A or A+ rating

### 5. Setup Monitoring

In Forge → Your Server → **Monitoring**
- Enable alerts for:
  - Server down
  - High CPU usage
  - Low disk space

---

## 🔄 Daily Development Workflow

### Making Changes

1. **Develop locally:**
   ```bash
   # Make your changes
   npm run build
   git add .
   git commit -m "Add new feature"
   git push origin main
   ```

2. **Forge auto-deploys** (if Quick Deploy enabled)
   - Or click **Deploy Now** in Forge

3. **That's it!** Your changes are live 🚀

### Viewing Logs

**Option A: Via Forge Dashboard**
- Forge → Your Site → **Logs**

**Option B: Via SSH**
```bash
ssh forge@your-server-ip
cd /home/forge/boxindustries.com
tail -f storage/logs/laravel.log
```

---

## 🐛 Troubleshooting

### Site Not Loading

**Check Deployment Status:**
- Forge → Your Site → **Deployment** → View last deployment log
- Look for errors

**Check Nginx:**
```bash
ssh forge@your-server-ip
sudo systemctl status nginx
```

### Database Connection Error

**Verify Database Credentials:**
- Forge → Your Site → **Environment**
- Check `DB_*` variables match database settings
- Forge → Your Server → **Database**

**Test Connection:**
```bash
ssh forge@your-server-ip
cd /home/forge/boxindustries.com
php artisan tinker
>>> DB::connection()->getPdo();
```

### 500 Server Error

**Check Laravel Logs:**
```bash
ssh forge@your-server-ip
tail -50 /home/forge/boxindustries.com/storage/logs/laravel.log
```

**Common fixes:**
```bash
# Run in Forge Commands section
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
```

### Queue Jobs Not Processing

**Check Daemon Status:**
- Forge → Your Server → **Daemons**
- Should be green (running)

**Restart Worker:**
- Click **Restart** next to your daemon
- Or run: `php artisan queue:restart`

### SSL Certificate Issues

**Renew Certificate:**
- Forge → Your Site → **SSL** → Click **Renew**

**Force HTTPS:**
- Forge → Your Site → **SSL** → Toggle **Force HTTPS** ON

---

## 📊 Monitoring & Maintenance

### Daily Tasks
- ✅ Check Forge dashboard for alerts
- ✅ Monitor site performance

### Weekly Tasks
- ✅ Review error logs
- ✅ Check disk space usage
- ✅ Verify backups are running

### Monthly Tasks
- ✅ Update dependencies: `composer update` (test first!)
- ✅ Review server metrics
- ✅ Test backup restoration
- ✅ Check SSL certificate renewal (auto-renews)

---

## 💰 Cost Breakdown

**Monthly Costs:**
- Vultr VPS: $5-10/month
- Laravel Forge: $12/month
- Domain: ~$1/month (if annual)
- **Total: $18-23/month**

**What You Get:**
- Dedicated server (not shared)
- Automatic deployments
- SSL certificates (free)
- Queue workers managed
- Database backups
- Server monitoring
- Professional setup
- Zero downtime deployments

**vs. Cheap cPanel hosting:**
- Similar cost ($5-20/month)
- But MUCH better performance and automation
- Worth every penny! 💯

---

## 🚀 Advanced Features

### Multiple Environments

Create separate servers for:
- **Staging:** Test before production
- **Production:** Live site

In Forge, just create another server and site, use `staging` branch for staging server.

### Continuous Deployment

Already enabled with Quick Deploy!
- Push to GitHub → Automatic deployment ✅

### Database Backups

In Forge → Your Server → **Backup**:
- Enable automated backups to S3/DigitalOcean Spaces
- Scheduled daily/weekly

### Performance Optimization

**Enable OPcache** (already enabled by Forge):
- Speeds up PHP by caching compiled code

**Add Redis caching:**
- Change `CACHE_STORE=redis` in .env
- Already installed by Forge!

**Optimize images:**
- Use WebP format
- Add CDN (Cloudflare free tier)

---

## 🆘 Getting Help

### Laravel Forge
- **Documentation:** https://forge.laravel.com/docs
- **Support:** support@laravel.com

### Vultr
- **Documentation:** https://www.vultr.com/docs/
- **Support:** https://my.vultr.com/support/

### Community
- **Laravel Discord:** https://discord.gg/laravel
- **Laracasts Forum:** https://laracasts.com/discuss

---

## 📚 Additional Resources

- [Laravel Forge Documentation](https://forge.laravel.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/12.x/deployment)
- [Vultr Getting Started](https://www.vultr.com/docs/)
- [Laravel Performance Guide](https://laravel.com/docs/12.x/deployment#optimization)

---

## 🎉 Congratulations!

You've successfully deployed your Laravel application the professional way! 🚀

Your application now has:
- ✅ Dedicated VPS server
- ✅ Automatic deployments
- ✅ SSL/HTTPS security
- ✅ Queue workers
- ✅ Database management
- ✅ Monitoring & alerts
- ✅ Professional infrastructure

**Welcome to modern Laravel development!** 🎊

---

**Pro Tips:**
1. Enable Quick Deploy for automatic deployments
2. Set up staging environment for testing
3. Monitor your logs regularly
4. Keep dependencies updated
5. Scale your Vultr server as traffic grows

Happy deploying! 🚀

