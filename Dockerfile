FROM dunglas/frankenphp:php8.2-bookworm

# ---------------------------------------------------------
# System dependencies
# ---------------------------------------------------------

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
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*


# ---------------------------------------------------------
# Node.js 22
# ---------------------------------------------------------

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && node --version \
    && npm --version \
    && rm -rf /var/lib/apt/lists/*


# ---------------------------------------------------------
# PHP GD configuration
# ---------------------------------------------------------

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp


# ---------------------------------------------------------
# PHP extensions
# ---------------------------------------------------------

RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    zip


# ---------------------------------------------------------
# Composer
# ---------------------------------------------------------

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# ---------------------------------------------------------
# Application directory
# ---------------------------------------------------------

WORKDIR /app


# ---------------------------------------------------------
# Composer dependencies
# ---------------------------------------------------------

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist \
    --no-scripts


# ---------------------------------------------------------
# Node dependencies
# ---------------------------------------------------------

COPY package.json package-lock.json ./

RUN npm install


# ---------------------------------------------------------
# Copy Laravel application
# ---------------------------------------------------------

COPY . .


# ---------------------------------------------------------
# Laravel package discovery
# ---------------------------------------------------------

RUN php artisan package:discover --ansi


# ---------------------------------------------------------
# Build frontend
# ---------------------------------------------------------

RUN npm run build


# ---------------------------------------------------------
# Laravel directories
# ---------------------------------------------------------

RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/logs \
    bootstrap/cache


# ---------------------------------------------------------
# Permissions
# ---------------------------------------------------------

RUN chmod -R 775 storage bootstrap/cache


# ---------------------------------------------------------
# Laravel cache
# ---------------------------------------------------------

RUN php artisan config:cache

RUN php artisan event:cache

RUN php artisan route:cache

RUN php artisan view:cache


# ---------------------------------------------------------
# Railway port
# ---------------------------------------------------------

EXPOSE 8000


# ---------------------------------------------------------
# Start Laravel
# ---------------------------------------------------------

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
