FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --no-dev && php artisan storage:link
    

RUN chown -R www-data: /app
RUN chmod -R 777 /app/storage/app/public
RUN chmod -R 777 /app/public/storage

CMD sh /app/docker/startup.sh
