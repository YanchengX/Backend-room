
FROM php:8.1-fpm

MAINTAINER boesanyan

RUN apt-get update && apt-get install -y \
    git \ 
    zip \
    curl \
    vim \
    build-essential \
    libzip-dev \
    locales 

RUN pecl install xdebug && docker-php-ext-enable xdebug

#cache clean
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#mysql
RUN docker-php-ext-install pdo_mysql pdo mysqli

#composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

EXPOSE 9000

CMD ["php-fpm"]
