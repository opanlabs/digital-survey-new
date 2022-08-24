#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

ls

sudo -u www-data stat /username/test/static

gpasswd -a www-data username

chmod g+x /username && chmod g+x /username/test && chmod g+x /username/test/static

chmod -R 777 /app/storage/app/public

chmod -R 777 /app/public/storage

echo -e "success chmod"

nginx