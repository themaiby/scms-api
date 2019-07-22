FROM php:7.3.6-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
       libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql zip -j$(nproc) gd  \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php && mv composer.phar /usr/local/bin/composer \
    && php -r "unlink('composer-setup.php');" \
    && composer global require hirak/prestissimo \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
