<?php

namespace App\Providers;

use App\Orchestrator\Orchestrator;
use App\Repositories\LinkRepositoryInterface;
use App\Services\Link\LinkService;
use App\Services\RabbitMQ\RabbitMQService;
use Illuminate\Support\ServiceProvider;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Orchestrator::class, function ($app) {
            return new Orchestrator();
        });

        $this->app->singleton(RabbitMQService::class, function ($app) {
            return new RabbitMQService(
                new AMQPStreamConnection(
                    host: config('rabbitmq.host'),
                    port: config('rabbitmq.port'),
                    user: config('rabbitmq.user'),
                    password: config('rabbitmq.password'),
                    vhost: config('rabbitmq.vhost'),
                )
            );
        });

        $this->app->singleton(LinkService::class, function ($app) {
            return new LinkService(
                linkRepository: resolve(LinkRepositoryInterface::class)
            );
        });
    }

    public function provide(): array
    {
        return [
            Orchestrator::class,
            LinkService::class,
        ];
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
