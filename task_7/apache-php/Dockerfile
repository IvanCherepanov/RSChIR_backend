FROM composer:latest AS composer

FROM php:8.0-apache
WORKDIR /var/www/html-d
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN docker-php-ext-install mysqli
RUN pecl install redis
RUN docker-php-ext-enable redis
#попробовать в тома закинуть
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod authn_dbd && apt-get update && apt-get install -y apache2-utils libaprutil1-dbd-mysql &&\
    a2enmod rewrite &&  \
    apt-get install -y git && \
    apt-get install -y libpng-dev && \
    apt-get install -y zip unzip && \
    docker-php-ext-install gd
COPY src/composer.json ./
RUN composer update && \
    composer install
 #   && service apache2 restart