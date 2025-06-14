FROM php:8.2-apache
RUN apt update
ENV DEBIAN_FRONTEND=noninteractive
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
WORKDIR /var/www/html
RUN chmod -R 755 ./
