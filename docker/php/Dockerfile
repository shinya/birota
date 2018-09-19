FROM php:7.2-apache

RUN set -x && \
  apt-get -y update && \
  apt-get install -y libicu-dev wget unzip libsqlite3-dev libbz2-dev zlib1g-dev && \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j${NPROC} bz2 intl zip && \
  docker-php-ext-install -j${NPROC} pdo_mysql pdo_sqlite && \
  rm -rf /tmp/pear && \
  a2enmod rewrite

RUN wget https://getcomposer.org/installer -O composer-setup.php && php composer-setup.php
RUN mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pcntl

ENV APP_NAME birota
ENV APACHE_DOCUMENT_ROOT /var/www/html/${APP_NAME}/webroot

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
