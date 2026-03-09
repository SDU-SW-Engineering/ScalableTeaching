set -e

git pull git@github.com-st:SDU-SW-Engineering/ScalableTeaching.git

php artisan down --refresh=15

# Install Laravel dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend
chmod +x node_modules/.bin/mix
npm run production

# Clear caches first
php artisan optimize:clear

# Rebuild caches
php artisan event:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Set ownership
sudo chown -R $(whoami):www-data .

# Standard permissions
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;

# Writable Laravel dirs
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

php artisan up
