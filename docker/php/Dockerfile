FROM php:7.1-fpm

MAINTAINER Roberto Arruda <robertoadearruda@gmail.com>

RUN apt-get update && apt-get install -y --reinstall coreutils
RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev \
    libfreetype6-dev libjpeg62-turbo-dev \
    libmcrypt-dev libpng12-dev git vim curl \
    && docker-php-ext-install -j$(nproc) iconv mcrypt zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo 'alias ll="ls -l --color=auto"' >> ~/.bashrc

#CMD ["php"]