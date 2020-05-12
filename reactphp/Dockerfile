FROM phpearth/php:7.4-nginx
MAINTAINER Lukas Skywalker <lukas.paiskr@bootiq.io>
RUN apk --no-cache add supervisor curl

# Configure PHP-FPM
ADD .docker-conf/www.conf /etc/php/7.4/php-fpm.d/www.conf

# Configure supervisord
RUN mkdir -p /var/log/supervisor
ADD .docker-conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY ./ /var/www/html/

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN cd /var/www/html/ && /usr/bin/composer install --no-dev --optimize-autoloader --no-interaction --no-progress
RUN chown -R www-data:www-data /var/www/html/
#------------- Container Config ---------------------------------------------------------------

# Expose port 80
EXPOSE 80

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
# Set supervisor to manage container processes
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
