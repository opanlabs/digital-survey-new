#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

ls

chmod -R 777 storage/app/public

chmod -R 777 public/storage

echo -e "success chmod bos"

nginx