#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

cd app/ && ls

setfacl -PRdm u::rwx,g::rwx,o::rwx storage/app/public

setfacl -PRdm u::rwx,g::rwx,o::rwx public/storage

# chmod -R 777 storage/app/public/images

# chmod -R 777 public/storage/images

echo -e "success chmod bos"

nginx