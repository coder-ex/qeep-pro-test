FROM php:7.3-apache

# Install tools required for build stage
RUN apt-get update && apt-get install -fyqq \
    mc bash curl wget rsync ca-certificates openssl ssh git tzdata openntpd \
    fontconfig libc6 unzip libxrender1 libfreetype6-dev libjpeg62-turbo-dev \
    libpng-dev gnupg binutils-gold autoconf \
    nmap net-tools tcpdump \
    g++ gcc gnupg libgcc1 linux-headers-amd64 make python

# Install opcache
RUN apt-get install -y \
    && docker-php-ext-install -j$(nproc) opcache \
    && docker-php-ext-enable opcache

# Install iconv
RUN apt-get install -y \
    && docker-php-ext-install -j$(nproc) iconv

# Install libraries for compiling GD, then build it
RUN apt-get install -y libfreetype6 libfreetype6-dev libpng16-16 libpng-dev libjpeg62-turbo libjpeg62-turbo-dev \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get remove -y libfreetype6-dev libpng-dev libjpeg62-turbo-dev

# Install additional PHP libraries
RUN apt-get install -y libonig-dev \
    && docker-php-ext-install -j$(nproc) mbstring pdo pdo_mysql mysqli bcmath

# Install libraries for Imagick support
# - https://stackoverflow.com/questions/47258610/docker-php-7-1-imagick
# - https://ourcodeworld.com/articles/read/645/how-to-install-imagick-for-php-7-in-ubuntu-16-04
RUN apt-get clean && apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick && rm -rf /var/lib/apt/lists/*

# Add ZIP archives support
RUN apt-get update && apt-get install -y libzip-dev zip \
    && docker-php-ext-install -j$(nproc) zip \
    && apt-get remove -fyqq libzip-dev

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mkdir -p /usr/local/bin
RUN mv composer.phar /usr/local/bin/composer

# Install symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash
#RUN export PATH="$HOME/.symfony/bin:$PATH"

# Or install it globally on your system:
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Install xdebug
RUN pecl install xdebug-2.7.1 \
     && docker-php-ext-enable xdebug

# Create usermod && groupmod
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data \
    && a2enmod rewrite \
    && service apache2 restart

COPY ./apache-000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/
COPY ./php.ini /usr/local/etc/php/php.ini

RUN mkdir /source
WORKDIR /var/www/html
COPY ./ /var/www/html
