# Stage 1: build frontend assets (Vite)
FROM node:20-bookworm-slim AS assets
WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

# Stage 2: install PHP dependencies (Composer)
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-ansi \
    --optimize-autoloader

COPY . .
RUN composer dump-autoload --optimize

# Stage 3: runtime
FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        intl \
        zip \
        gd \
        opcache \
    && rm -rf /var/lib/apt/lists/*

# Copy application + vendor + built assets
COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

RUN mkdir -p storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Render sets PORT; php artisan serve respects -S host:port
CMD ["sh", "-lc", "php artisan migrate --force || true; php artisan storage:link || true; php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
