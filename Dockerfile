FROM php:8.2-apache

COPY ./www /var/www/html/

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

COPY ./mysql-conf.d/mysql-conf.cnf /etc/mysql/conf.d/

RUN chmod 644 /etc/mysql/conf.d/mysql-conf.cnf
