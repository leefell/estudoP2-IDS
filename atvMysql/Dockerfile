# Dockerfile para Apache + PHP 8.2
FROM php:8.2-apache

# Instalar extensões necessárias do PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Definir permissões corretas
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/