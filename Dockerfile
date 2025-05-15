FROM php:8.2-apache

COPY ./www /var/www/html/

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

COPY ./mysql-conf.d/mysql-conf.cnf /etc/mysql/conf.d/

RUN chmod 644 /etc/mysql/conf.d/mysql-conf.cnf

RUN apt-get update && apt-get install -y unzip git zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

RUN composer require phpmailer/phpmailer

RUN chown -R www-data:www-data /var/www/html