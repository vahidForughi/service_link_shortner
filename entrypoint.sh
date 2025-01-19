#!/bin/sh

echo "Starting $APP_ENV ..."
#composer install --optimize-autoloader
if [ "$APP_ENV" = "local" ]; then
    echo "Running in local enviroment..."
    if [ "$APP_TASK" = "api" ]; then
        echo "Running API"
        php artisan serve --host=0.0.0.0 --port=8000
    elif [ "$APP_TASK" = "consume" ]; then
        echo "Running Consume"
        php artisan rabbitmq:consume
    else
        echo "Invalid environment: APP_ENV: $APP_ENV | APP_TASK: $APP_TASK. Shutting down the container."
        exit 1
    fi
fi
