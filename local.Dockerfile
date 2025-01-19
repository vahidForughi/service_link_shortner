FROM microservice-kickstart/service_link_shortner_base:${DOCKER_IMAGE_LARAVEL_BASE_VERSION}

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-autoloader

COPY --chown=root:root . ./

RUN composer dump-autoload --optimize

RUN chmod -R 777 ./storage

EXPOSE 8000

ENTRYPOINT ["./entrypoint.sh"]
