FROM php:8.2-apache
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
RUN mkdir -p var/cache var/log public/bundles && \
    chown -R www-data:www-data var/cache var/log public/bundles
USER www-data
RUN composer install --no-interaction --optimize-autoloader
USER root
RUN chown -R www-data:www-data vendor var/cache var/log public/bundles
EXPOSE 80
CMD ["apache2-foreground"]