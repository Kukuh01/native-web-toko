FROM php:8.1-fpm

RUN apt-get update && apt-get install -y libonig-dev libzip-dev zip unzip libpng-dev libjpeg-dev libfreetype6-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install pdo pdo_mysql mbstring gd

WORKDIR /var/www