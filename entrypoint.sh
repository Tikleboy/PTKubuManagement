#!/bin/sh
set -e
cd /var/www/html

# Seed the SQLite volume on first boot
if [ ! -s database/database.sqlite ] && [ -f database/database.sqlite.seed ]; then
  cp database/database.sqlite.seed database/database.sqlite
fi
touch database/database.sqlite
chown www-data:www-data database/database.sqlite
chmod 664 database/database.sqlite

# Laravel boot (env vars come from Dokploy)
php artisan config:clear
php artisan package:discover --ansi || true
php artisan migrate --force || true
php artisan storage:link || true
php artisan config:cache
php artisan route:cache || true
php artisan view:cache || true
chown -R www-data:www-data storage bootstrap/cache

exec apache2-foreground
