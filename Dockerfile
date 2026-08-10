FROM dunglas/frankenphp:php8.2-bookworm

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# GD
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# PHP extensions required by Laravel + Excel
RUN docker-php-ext-install \
    gd \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    zip

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Composer dependencies
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-scripts

# Node dependencies
COPY package.json package-lock.json ./

RUN npm install

# Application
COPY . .

# Laravel package discovery
RUN php artisan package:discover --ansi

# Build frontend
RUN npm run build

# Laravel directories
RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

# Cache Laravel configuration
RUN php artisan config:cache
RUN php artisan event:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
