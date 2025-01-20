FROM microservices-kickstart/laravel-base:1.0.0

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-autoloader
