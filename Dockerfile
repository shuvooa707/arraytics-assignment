FROM php:8-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
  build-essential \
  libzip-dev \
  libpng-dev \
  libjpeg62-turbo-dev \
  libfreetype6-dev \
  locales \
  zip \
  jpegoptim optipng pngquant gifsicle \
  vim \
  unzip \
  git \
  curl

RUN service apache2 restart

RUN docker-php-ext-install pdo_mysql


WORKDIR /atmosphere

COPY . /atmosphere