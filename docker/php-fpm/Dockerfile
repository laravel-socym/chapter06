FROM php:7.2-fpm-alpine

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache pdo pdo_mysql

COPY conf/opcache.ini $PHP_INI_DIR/conf.d/
