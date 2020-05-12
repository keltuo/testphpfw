FROM phpearth/php:7.4-nginx
MAINTAINER Lukas Skywalker <lukas.paiskr@bootiq.io>
RUN apk --no-cache add supervisor curl

# Configure nginx
ADD .docker-conf/nginx.conf /etc/nginx/nginx.conf
ADD .docker-conf/default /etc/nginx/sites-enabled/default

# Configure PHP-FPM
ADD .docker-conf/www.conf /etc/php/7.4/php-fpm.d/www.conf

# Configure supervisord
RUN mkdir -p /var/log/supervisor
ADD .docker-conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY ./ /var/www/html/
RUN chown -R www-data:www-data /var/www/html/

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN cd /var/www/html/ && /usr/bin/composer install --no-dev --optimize-autoloader --no-interaction --no-progress

RUN chown -R www-data:www-data /var/www/html/
#------------- Container Config ---------------------------------------------------------------
RUN  version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
        && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
        && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
        && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
        && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > /etc/php/7.4/conf.d/blackfire.ini

# Expose port 80
EXPOSE 80

#CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
# Set supervisor to manage container processes
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
