FROM dunglas/frankenphp:php8.2-bookworm

# ============================================
# System Dependencies
# ============================================

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    ca-certificates \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# ============================================
# Configure GD
# ============================================

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# ============================================
# PHP Extensions
# ============================================

RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    zip

# ============================================
# Node.js 22
# ============================================

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

RUN node --version && npm --version

# ============================================
# Composer
# ============================================

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# ============================================
# Composer Dependencies
# ============================================

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-scripts

# ============================================
# Node Dependencies
# ============================================

COPY package.json package-lock.json ./

RUN npm ci

# ============================================
# Application
# ============================================

COPY . .

# ============================================
# Build Frontend
# ============================================

RUN npm run build

# ============================================
# Laravel Directories
# ============================================

RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

# ============================================
# Laravel Optimization
# ============================================

RUN php artisan package:discover --ansi

RUN php artisan config:cache

RUN php artisan event:cache

RUN php artisan route:cache

RUN php artisan view:cache

# ============================================
# FrankenPHP
# ============================================

ENV SERVER_ROOT=/app/public

# Railway provides PORT automatically.
# 8080 is used only as a local fallback.
ENV PORT=8080

EXPOSE 8080

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]

