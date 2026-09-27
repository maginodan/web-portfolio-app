FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev \
    nginx nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# FIX env injection from Dokploy (IMPORTANT)
RUN sed -i 's/;clear_env = yes/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf

# FIX permissions (IMPORTANT)
RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data /app

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts

# Laravel bootstrap
RUN php artisan package:discover

# Frontend build
RUN npm install --legacy-peer-deps
RUN npm run build

# Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Expose HTTP
EXPOSE 80

# Start both services correctly
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]