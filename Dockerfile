# syntax=docker/dockerfile:1
FROM php:8.2-apache

# Install system deps + PHP extensions needed by Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip pkg-config \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mbstring xml zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Laravel must serve from /public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Add Composer into the runtime container
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . /var/www/html
RUN cd /var/www/html && composer install --no-interaction --prefer-dist


# Permissions (Laravel)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

CMD ["apache2-foreground"]
