FROM php:8.3-apache
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql
ENV APACHE_DOCUMENT_ROOT=/var/www/tutobox2/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN apt update
#installer GIT
RUN apt install -y git
#Installer zip
RUN apt install -y zip
#pour symfony
RUN apt-get update -y && apt-get install -y libmcrypt-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN apt install -y npm
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash
