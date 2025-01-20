ARG DOCKER_IMAGE_BASE_VERSION=latest

FROM microservice-kickstart/laravel-base:${DOCKER_IMAGE_BASE_VERSION}

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-autoloader

COPY --chown=root:root . ./

RUN composer dump-autoload --optimize

RUN chmod -R 777 ./storage

EXPOSE 8000

ENTRYPOINT ["./entrypoint.sh"]
