<?php

namespace App\DTO\RabbitMQ;

use App\DTO\BaseDTO;
use App\Services\RabbitMQ\ExchangeTypeEnum;
use App\Services\RabbitMQ\QueueEnum;
use App\Services\RabbitMQ\RoutingKeyEnum;

class RabbitMQExchangeQueueBindsDTO extends BaseDTO
{
    public function __construct(
        readonly public QueueEnum $queue,
        readonly public RoutingKeyEnum $routingKey = RoutingKeyEnum::Empty,
    ) {
        parent::__construct();
    }
}
