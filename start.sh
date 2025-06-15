#!/bin/sh

# Instala dependencias de PHP y JS
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install && npm run build

# Limpieza y cachés
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Arranca PHP-FPM y Nginx
php-fpm -y /etc/php/8.2/fpm/php-fpm.conf &
nginx -g "daemon off;"
