FROM    php:8.0.9-fpm-buster

LABEL   maintainer="Oswaldo de Carvalho Filho <oswaldo.vix@gmail.com>"

# VERSÕES
ENV     NGINX_VERSION                   1.14.2*
ENV     SUPERVISOR_VERSION              3.3.5-1
ENV     COMPOSER_VERSION                2.1.1

# packages
RUN     apt-get                         update                                                          &&  \
        apt-get                         install                                                             \
                                        --no-install-recommends                                             \
                                        --no-install-suggests                                               \
                                        -q -y                                                               \
                                        apt-utils                                                           \
                                        libpq-dev                                                           \
                                        libmcrypt-dev                                                       \
                                        libzip-dev                                                          \
                                        libfreetype6-dev                                                    \
                                        libjpeg62-turbo-dev                                                 \
                                        libpng-dev                                                          \
                                        libwebp-dev                                                         \
                                        zlib1g-dev                                                          \
                                        python-pip                                                          \
                                        python-setuptools                                                   \
                                        nano                                                                \
                                        zip                                                                 \
                                        unzip                                                               \
                                        git                                                                 \
                                        nginx=${NGINX_VERSION}                                              \
                                        supervisor=${SUPERVISOR_VERSION}                                &&  \
        curl                            -sL https://deb.nodesource.com/setup_lts.x | bash -             &&  \
        apt-get                         install -y nodejs                                               &&  \

        # REMOVE O LIXO
        apt-get                         clean                                                           &&  \
        rm                              -rf /var/lib/apt/lists/*

# EXTS
RUN     pip                             install                     supervisor-stdout                   &&  \
        pecl                            install                     -o -f mcrypt                        &&  \
        docker-php-ext-enable           mcrypt                                                          &&  \
        docker-php-ext-install          zip                                                             &&  \
        #
        # CLEAN
        rm                              -rf                         /tmp/pear                           && \
        # docker php ext install
        docker-php-ext-install          pdo_pgsql                                                          \
                                        opcache

#
# COMPOSER
RUN     curl -o /tmp/composer-setup.php https://getcomposer.org/installer                               && \
        curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig                        && \
        php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" && \
        php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} && \
        rm -rf /tmp/composer-setup.php

#
# APP SOURCE
COPY    /backend                        /var/www/html

#####
#
# CONFIGURATIONS
####################

# SUPERVISOR
COPY    /configs/api/supervisord.conf   /etc/supervisord.conf

# NGINX
COPY    /configs/api/default.conf       /etc/nginx/conf.d/default.conf
COPY    /configs/api/nginx.conf         /etc/nginx/nginx.conf

# PHP-FPM
COPY    /configs/api/www.conf           /usr/local/etc/php-fpm.d/www.conf

# ENTRY-POINT
COPY    /configs/api/start.sh           /start.sh

EXPOSE  80

#
RUN     chown                           www-data:www-data * -R                                          && \
        composer                        install

CMD     ["/start.sh"]
