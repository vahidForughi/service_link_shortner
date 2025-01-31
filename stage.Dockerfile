ARG DOCKER_IMAGE_BASE_VERSION=latest

FROM microservice-kickstart/laravel-base:${DOCKER_IMAGE_BASE_VERSION}

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-autoloader

COPY --chown=root:root . ./

RUN composer dump-autoload --optimize

RUN chmod -R 777 ./storage

EXPOSE 5050

COPY config/nginx.conf /etc/nginx/conf.d/default.conf

ENTRYPOINT ["./entrypoint.sh"]
