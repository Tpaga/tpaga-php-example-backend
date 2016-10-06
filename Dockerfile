FROM php:7.0-apache

# composer needs zip and unzip
RUN apt-get update
RUN apt-get install --assume-yes zip unzip

RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar require guzzlehttp/guzzle:~6.0

COPY . /var/www/html/
