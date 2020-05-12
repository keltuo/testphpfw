# test-php-fw
Test php framework - lumen, reactphp, slimphp, Apache Bench

Lumen - cd lumen && docker-compose up -d

ReactPhp - cd reactphp && docker-compose up -d

SlimPhp - cd slimphp && docker-compose up -d

One service 'docker-compose up -d service'

All services 'docker-compose up -d'

Enter container - ' docker-compose exec lumen bash '

Composer - ' docker-compose exec lumen bash -c "cd /var/www/html && composer install" '

AB test - ' docker-compose exec ab bash -c "ab -n 5000 -c 500 http://lumen/" '
Wrk - ' docker-compose exec ab bash -c "wrk -d60s --latency http://lumen/" '


