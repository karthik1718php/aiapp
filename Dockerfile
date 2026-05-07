FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y unzip git curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN php artisan config:cache

EXPOSE 80