#!/bin/sh

sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

php-fpm -D

# while ! nc -w 1 -z 127.0.0.1 9000; do sleep 0.1; done;

ls

php artisan storage:link

mkdir -p storage/app/public/images

mount -o remount,acl /

setfacl -PRdm u::rwx,g::rwx,o::rw storage/app/public/images

# setfacl -PRdm u::rwx,g::rwx,o::rw public/storage/images

# chmod -R 777 storage/app/public/images

# chmod -R 777 public/storage/images

echo -e "success chmod bos"

nginx