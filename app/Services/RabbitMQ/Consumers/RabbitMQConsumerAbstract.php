<?php

namespace App\Services\RabbitMQ\Consumers;

use App\Services\RabbitMQ\QueueEnum;
use PhpAmqpLib\Message\AMQPMessage;

abstract class RabbitMQConsumerAbstract
{
    abstract public static function getQueue(): QueueEnum;
    abstract public static function handle($message);
}
