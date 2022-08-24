# FROM php:8.1-fpm-alpine

# RUN apk add --no-cache nginx wget

# RUN mkdir -p /run/nginx

# COPY docker/nginx.conf /etc/nginx/nginx.conf
# RUN docker-php-ext-install mysqli pdo pdo_mysql

# RUN mkdir -p /app
# COPY . /app

# RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
# RUN cd /app && \
#     /usr/local/bin/composer install --no-dev && php artisan storage:link
    
# RUN sudo chown -R www-data: /app
# RUN sudo chmod -R 777 /app/storage/app/public
# RUN sudo chmod -R 777 /app/public/storage
# RUN ls

# # RUN chmod 777 -R /var/www/storage/ && \
# #   chown -R www-data:www-data /var/www/ && \

# CMD sh /app/docker/startup.sh


############# new build ###########
FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY docker/nginx.conf /etc/nginx/nginx.conf


WORKDIR /app
COPY . /app
COPY --from=build /app /var/www/
RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN composer install && composer dumpautoload

RUN chmod 777 -R /var/www/storage/ && \
  chown -R www-data:www-data /var/www/ && \
  ls

CMD sh /app/docker/startup.sh
