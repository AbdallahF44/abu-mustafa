FROM dunglas/frankenphp:php8.2-bookworm

# ==========================================
# System dependencies
# ==========================================

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

# ==========================================
# Configure GD
# ==========================================

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# ==========================================
# PHP extensions
# ==========================================

RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    zip

# ==========================================
# Node.js 22
# ==========================================

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Verify Node and npm
RUN node --version && npm --version

# ==========================================
# Composer
# ==========================================

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# ==========================================
# PHP dependencies
# ==========================================

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-scripts

# ==========================================
# Node dependencies
# ==========================================

COPY package.json package-lock.json ./

RUN npm ci

# ==========================================
# Application
# ==========================================

COPY . .

# ==========================================
# Build frontend
# ==========================================

RUN npm run build

# ==========================================
# Laravel directories
# ==========================================

RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache

# ==========================================
# Laravel optimization
# ==========================================

RUN php artisan package:discover --ansi

RUN php artisan config:cache

RUN php artisan event:cache

RUN php artisan route:cache

RUN php artisan view:cache

# ==========================================
# FrankenPHP
# ==========================================

ENV SERVER_ROOT=/app/public

EXPOSE 8080

CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
