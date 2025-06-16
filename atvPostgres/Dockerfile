FROM php:8.2-apache
RUN apt update
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql pgsql
WORKDIR /var/www/html
RUN chmod -R 755 ./
