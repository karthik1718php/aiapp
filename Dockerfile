FROM php:8.1-apache

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system packages
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

# Set Laravel public folder as Apache root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Copy project files
COPY . /var/www/html

WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage
RUN chown -R www-data:www-data bootstrap/cache

# Cache config
RUN php artisan config:cache

EXPOSE 80