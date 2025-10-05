# 🎯 START HERE - Choose Your Deployment Method

Choose the deployment method that best fits your needs and budget.

---

## 📚 Which Guide Should You Use?

### 🏆 RECOMMENDED: Laravel Forge + Vultr (Professional)

**`FORGE_VULTR_GUIDE.md`** 🚀 - The modern, professional way
- ⚡ Fastest setup (15 minutes total)
- 🤖 Automatic deployments (push to deploy)
- 🔒 Free SSL certificates
- 📊 Built-in monitoring
- 🔄 Zero-downtime deployments
- 💪 Managed queue workers
- **Cost:** ~$17-22/month ($5-10 Vultr + $12 Forge)
- **Best for:** Production sites, professional projects, growing apps

### ⭐ For SSH Access (DIY Deployment)

1. **`SSH_CHEATSHEET.md`** 📋 - Start here! Copy-paste commands
   - Quick initial setup in minutes
   - One-command updates
   - All commands ready to go
   - **Cost:** $5-20/month (hosting only)
   - **Best for:** Budget hosting, learning

2. **`SSH_DEPLOYMENT_GUIDE.md`** 📖 - Complete walkthrough
   - Detailed explanations
   - Troubleshooting
   - Pro tips and best practices

### ⚠️ Legacy/Fallback

3. **`CPANEL_DEPLOYMENT_GUIDE.md`** - Only if SSH fails
   - Manual file uploads via FTP/File Manager
   - More time-consuming
   - Use only if SSH is unavailable

---

## ⚡ Quick Start (3 Steps)

### Step 1: Prepare Locally (5 minutes)
```bash
# In your local project directory
npm run build
php deployment/scripts/export-database.php
git push origin main
```

### Step 2: Setup on Server (10 minutes)
```bash
# Connect via SSH
ssh username@yourdomain.com

# Clone your repo
git clone https://github.com/yourusername/box-industries.git
cd box-industries

# Configure
cp deployment/env.production.template .env
nano .env  # Edit database credentials

# Install & setup
composer install --no-dev
php artisan key:generate
chmod -R 775 storage bootstrap/cache
php artisan optimize
```

### Step 3: Configure cPanel (5 minutes)
1. **Create database** (MySQL Databases)
2. **Import database** (via SSH or phpMyAdmin)
3. **Point domain** to `/home/username/box-industries/public`
4. **Setup cron job** for Laravel scheduler
5. **Enable SSL** (AutoSSL)

**Done!** 🎉

---

## 🔄 Future Updates

After initial setup, updates are ONE command:

```bash
ssh username@yourdomain.com
cd ~/box-industries
bash deployment/scripts/deploy.sh
```

The script automatically:
- ✅ Enables maintenance mode
- ✅ Pulls latest code
- ✅ Installs dependencies
- ✅ Runs migrations
- ✅ Clears & rebuilds cache
- ✅ Disables maintenance mode

---

## 📖 Recommended Reading Order

1. **Right now:** `SSH_CHEATSHEET.md` (2 minutes)
2. **Before deploying:** `SSH_DEPLOYMENT_GUIDE.md` (10 minutes)
3. **Keep handy:** `QUICK_REFERENCE.md` (during deployment)
4. **Reference:** `README.md` (when you need it)

---

## 🔧 What You Need From Your Hosting Provider

Make sure you have:

- [x] SSH username and password
- [x] SSH hostname (e.g., `yourdomain.com` or IP address)
- [ ] Confirm PHP version is 8.2+ 
- [ ] Confirm Composer is available
- [ ] Confirm Git is available

**Test SSH access:**
```bash
ssh username@yourdomain.com
```

If that works, you're golden! ✨

---

## 💡 Deployment Method Comparison

| Feature | Forge + Vultr | SSH (DIY) | cPanel GUI |
|---------|---------------|-----------|------------|
| **Setup Time** | ⚡ 15 mins | ⚠️ 30 mins | 🐌 45+ mins |
| **Deploy Time** | ⚡ 1-2 mins | ⚠️ 2-3 mins | 🐌 15+ mins |
| **Automation** | ✅✅ Full auto | ✅ Scripted | ❌ Manual |
| **SSL Setup** | ✅ Automatic | ⚠️ Manual | ⚠️ Manual |
| **Queue Workers** | ✅ Auto-managed | ⚠️ Manual setup | ⚠️ Cron jobs |
| **Monitoring** | ✅ Built-in | ❌ DIY | ❌ Basic |
| **Zero Downtime** | ✅ Yes | ⚠️ With effort | ❌ No |
| **Monthly Cost** | $17-22 | $5-20 | $5-20 |
| **Technical Skill** | 🟢 Beginner | 🟡 Intermediate | 🟢 Beginner |
| **Industry Standard** | ✅✅ Professional | ✅ Good | ❌ Outdated |
| **Scalability** | ✅✅ Easy | ✅ Possible | ❌ Limited |
| **Best For** | Production | Learning/Budget | Legacy only |

**Recommendation:** Forge + Vultr is worth the extra $10-12/month for the time saved and professional features!

---

## 🎓 What You'll Learn

By using SSH deployment, you'll learn:
- Professional deployment workflows
- Git-based deployments
- Laravel optimization
- Server management basics
- Shell scripting
- Database operations

These are valuable skills for any Laravel developer! 🚀

---

## 🆘 Need Help?

**If something doesn't work:**

1. **Check the error message** - Most errors are self-explanatory
2. **View Laravel logs:** `tail -f storage/logs/laravel.log`
3. **Consult the troubleshooting section** in `SSH_DEPLOYMENT_GUIDE.md`
4. **Try the quick fixes** in `SSH_CHEATSHEET.md`

**Common first-time issues:**
- Wrong database credentials → Edit `.env`
- Permission errors → Run `chmod -R 775 storage bootstrap/cache`
- PHP version → Contact hosting support
- Composer/Git not found → Contact hosting support

---

## ✅ Pre-Flight Checklist

Before you start deploying, make sure:

- [ ] Your code is in a Git repository (GitHub/GitLab/Bitbucket)
- [ ] You can SSH into your server
- [ ] You have cPanel access for database/domain setup
- [ ] You've run `npm run build` locally
- [ ] You've exported your database locally

If all checked, you're ready! 🚀

---

## 🎯 Your Next Step

**Open and read:** `SSH_CHEATSHEET.md`

It has all the commands you need, ready to copy-paste. It's designed for speed - you'll be deployed in under 30 minutes!

---

**Welcome to professional Laravel deployment! 🎉**

The hard part is over - with SSH access, the rest is smooth sailing.

