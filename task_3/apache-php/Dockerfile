FROM php:8.0-apache
WORKDIR /var/www/html-d
RUN docker-php-ext-install mysqli
#попробовать в тома закинуть
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
