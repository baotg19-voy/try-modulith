FROM php:8.3-fpm

# Install system dependencies first
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    gd \
    zip \
    exif \
    pcntl \
    bcmath

# MongoDB extension
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Composer and permissions
WORKDIR /var/www/html
COPY . /var/www/html
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN composer install --optimize-autoloader
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
