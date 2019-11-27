
FROM php:7.2.10-apache-stretch

RUN apt-get update -yqq && \
    apt-get install -y vim git apt-utils mariadb-client zip unzip libzip-dev libpq-dev && \
    pecl install xdebug &&\
    docker-php-ext-enable xdebug &&\
    docker-php-ext-install zip mysqli pdo_mysql &&\
    a2enmod rewrite && \
    docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*

#RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/app

# set our application folder as an environment variable
#ENV APP_HOME /var/www/app
# change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
# enable apache module rewrite

#RUN a2enmod rewrite
#RUN a2enmod ssl
#RUN a2enmod headers

# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-

#RUN a2enmod rewrite headers
# copy source files and run composera
COPY . /var/www/app

# change ownership of our applications
RUN chown -R www-data:www-data /var/www/app

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]


# docker-php-ext-install pdo_mysql && \
#    docker-php-ext-install mysql && \
#