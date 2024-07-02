FROM php:8.1-apache
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl zip pdo pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN a2enmod rewrite
WORKDIR /var/www/html
COPY . .
RUN mkdir -p var/cache var/log && \
    chown -R www-data:www-data var/cache var/log
USER www-data
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --optimize-autoloader
USER root
EXPOSE 80
CMD ["apache2-foreground"]