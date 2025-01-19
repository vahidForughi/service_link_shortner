<?php

namespace App\DTO\RabbitMQ;

use App\DTO\BaseDTO;
use App\Services\RabbitMQ\Consumers\RabbitMQConsumerAbstract;
use App\Services\RabbitMQ\ExchangeTypeEnum;
use App\Services\RabbitMQ\QueueEnum;
use App\Services\RabbitMQ\RoutingKeyEnum;

class RabbitMQConsumerQueueBindsDTO extends BaseDTO
{
    public function __construct(
        readonly public QueueEnum       $queue,
        public RabbitMQConsumerAbstract $consumer,
    ) {
        parent::__construct();
    }
}
