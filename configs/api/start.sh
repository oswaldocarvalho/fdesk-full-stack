#!/bin/bash

# Update nginx to match worker_processes to no. of cpu's
procs=$(cat /proc/cpuinfo | grep processor | wc -l)
sed -i -e "s/worker_processes  1/worker_processes $procs/" /etc/nginx/nginx.conf

# cria um arquivo para o banco
if [[ ! -e /var/www/html/database/database.sqlite ]]; then
    touch /var/www/html/database/database.sqlite
fi

#
php artisan migrate

# Se as chaves ainda não existem, cria
if [[ ! -e /var/www/html/storage/oauth-private.key ]]; then
    php artisan passport:install
fi

# Inicia o supervisord
exec supervisord -n -c /etc/supervisord.conf
