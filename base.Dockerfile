ARG DOCKER_IMAGE_LARAVEL_BASE_VERSION=latest

FROM microservices-kickstart/laravel-base:${DOCKER_IMAGE_LARAVEL_BASE_VERSION}

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-autoloader
