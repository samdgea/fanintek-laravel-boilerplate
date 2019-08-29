FROM php:7.2-apache

LABEL maintainer="Abdilah Sammi <ask@abdilah.id>"

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite

ADD . /var/www
ADD ./public /var/www/html

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

RUN echo "root:@password123" | chpasswd