#!/bin/sh
set -e

echo "✨ Starting custom build script..."

composer install --no-interaction --prefer-dist --optimize-autoloader
npm ci
npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "✅ Build script complete. Starting server..."

php artisan serve --host=0.0.0.0 --port=8080
