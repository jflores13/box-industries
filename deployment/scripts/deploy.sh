#!/bin/bash

# ==============================================================================
# Laravel Deployment Script for cPanel
# ==============================================================================
# This script automates the deployment process for Laravel applications
# Usage: bash deployment/scripts/deploy.sh
# ==============================================================================

set -e  # Exit immediately if a command exits with a non-zero status

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ==============================================================================
# Configuration
# ==============================================================================

APP_NAME="Box Industries"
GIT_BRANCH="${1:-main}"  # Default to 'main' branch, or use first argument
PHP_CMD="php"  # May need to change to php82, php83, etc. on some servers

# ==============================================================================
# Helper Functions
# ==============================================================================

print_header() {
    echo ""
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}  $1${NC}"
    echo -e "${BLUE}========================================${NC}"
    echo ""
}

print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ $1${NC}"
}

# ==============================================================================
# Pre-Flight Checks
# ==============================================================================

print_header "Starting Deployment for $APP_NAME"

# Check if we're in the Laravel root directory
if [ ! -f "artisan" ]; then
    print_error "Not in Laravel root directory. Please cd to your Laravel app root."
    exit 1
fi

print_success "Found Laravel application"

# Check PHP version
PHP_VERSION=$($PHP_CMD -r "echo PHP_VERSION;")
print_info "PHP Version: $PHP_VERSION"

# Check if .env file exists
if [ ! -f ".env" ]; then
    print_error ".env file not found!"
    print_warning "Please create .env file from deployment/env.production.template"
    exit 1
fi

print_success ".env file found"

# ==============================================================================
# Enable Maintenance Mode
# ==============================================================================

print_header "Enabling Maintenance Mode"

$PHP_CMD artisan down --render="errors::503" --retry=60 || true

print_success "Maintenance mode enabled"

# ==============================================================================
# Pull Latest Code
# ==============================================================================

print_header "Pulling Latest Code from Git"

# Check if git is available
if ! command -v git &> /dev/null; then
    print_warning "Git not found. Skipping git pull."
    print_info "Make sure you've uploaded the latest code manually."
else
    # Stash any local changes
    git stash

    # Pull latest code
    print_info "Pulling from branch: $GIT_BRANCH"
    git pull origin "$GIT_BRANCH"

    print_success "Code updated successfully"
fi

# ==============================================================================
# Install/Update Dependencies
# ==============================================================================

print_header "Installing Composer Dependencies"

if ! command -v composer &> /dev/null; then
    print_warning "Composer not found in PATH"
    print_info "Trying with php composer.phar..."

    if [ -f "composer.phar" ]; then
        $PHP_CMD composer.phar install --no-dev --no-interaction --prefer-dist --optimize-autoloader
    else
        print_error "composer.phar not found. Please install Composer."
        exit 1
    fi
else
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
fi

print_success "Composer dependencies installed"

# ==============================================================================
# Run Database Migrations
# ==============================================================================

print_header "Running Database Migrations"

$PHP_CMD artisan migrate --force --no-interaction

print_success "Database migrations completed"

# ==============================================================================
# Clear All Cache
# ==============================================================================

print_header "Clearing Cache"

$PHP_CMD artisan cache:clear
print_success "Application cache cleared"

$PHP_CMD artisan config:clear
print_success "Configuration cache cleared"

$PHP_CMD artisan route:clear
print_success "Route cache cleared"

$PHP_CMD artisan view:clear
print_success "View cache cleared"

# ==============================================================================
# Optimize Application
# ==============================================================================

print_header "Optimizing Application"

$PHP_CMD artisan config:cache
print_success "Configuration cached"

$PHP_CMD artisan route:cache
print_success "Routes cached"

$PHP_CMD artisan view:cache
print_success "Views cached"

# Optimize autoloader
composer dump-autoload --optimize --no-dev --classmap-authoritative 2>/dev/null || \
$PHP_CMD composer.phar dump-autoload --optimize --no-dev --classmap-authoritative 2>/dev/null || true

print_success "Autoloader optimized"

# ==============================================================================
# Storage Link
# ==============================================================================

print_header "Creating Storage Link"

if [ ! -L "public/storage" ]; then
    $PHP_CMD artisan storage:link
    print_success "Storage link created"
else
    print_info "Storage link already exists"
fi

# ==============================================================================
# File Permissions
# ==============================================================================

print_header "Setting File Permissions"

chmod -R 775 storage bootstrap/cache
print_success "File permissions set"

# ==============================================================================
# Restart Queue Workers (if using queues)
# ==============================================================================

print_header "Restarting Queue Workers"

$PHP_CMD artisan queue:restart
print_success "Queue workers restarted (if any)"

# ==============================================================================
# Disable Maintenance Mode
# ==============================================================================

print_header "Disabling Maintenance Mode"

$PHP_CMD artisan up

print_success "Application is now live!"

# ==============================================================================
# Summary
# ==============================================================================

print_header "Deployment Complete!"

echo -e "${GREEN}✓ Git pulled${NC}"
echo -e "${GREEN}✓ Dependencies installed${NC}"
echo -e "${GREEN}✓ Database migrated${NC}"
echo -e "${GREEN}✓ Cache cleared & optimized${NC}"
echo -e "${GREEN}✓ Permissions set${NC}"
echo -e "${GREEN}✓ Application live${NC}"
echo ""
print_success "Deployment completed successfully for $APP_NAME"
echo ""

# ==============================================================================
# Post-Deployment Tasks
# ==============================================================================

print_info "Post-deployment reminders:"
echo "  1. Check application in browser"
echo "  2. Test critical functionality"
echo "  3. Monitor logs: tail -f storage/logs/laravel.log"
echo "  4. If using queues, ensure cron job is running"
echo ""

exit 0

