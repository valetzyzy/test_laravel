FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mariadb-client git zip libmagickwand-dev curl --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath intl exif

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd userToRunComposer

USER userToRunComposer
