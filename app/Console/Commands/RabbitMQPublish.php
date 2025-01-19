<?php

namespace App\Console\Commands;

use App\Services\RabbitMQ\RabbitMQService;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run rabbitmq producer';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        resolve(\App\Services\RabbitMQ\RabbitMQService::class)->publish(
            exchange: \App\Services\RabbitMQ\ExchangeEnum::Direct->value,
            message: 'salaaaam'
        );
    }
}
