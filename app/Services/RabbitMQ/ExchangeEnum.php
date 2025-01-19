<?php

namespace App\Services\RabbitMQ;

use App\DTO\RabbitMQ\RabbitMQExchangeQueueBindsDTO;
use App\Traits\EnumHelperTrait;

enum ExchangeEnum: string
{
    use EnumHelperTrait;

    case Direct = 'shortner_direct';
    case Fanout = 'shortner_fanout';
    case Topic = 'shortner_topic';

    public function type(): string
    {
        return match ($this) {
            self::Direct => 'direct',
            self::Fanout => 'fanout',
            self::Topic => 'topic',
        };
    }

    public function binds(): array
    {
        return match ($this) {
            self::Direct => [
//                new RabbitMQExchangeQueueBindsDTO(QueueEnum::QueueOne, RoutingKeyEnum::OK),
            ],
            self::Fanout => [
//                new RabbitMQExchangeQueueBindsDTO(QueueEnum::QueueOne, RoutingKeyEnum::OK),
//                new RabbitMQExchangeQueueBindsDTO(QueueEnum::QueueTwo, RoutingKeyEnum::Fail),
            ],
            self::Topic => [
//                new RabbitMQExchangeQueueBindsDTO(QueueEnum::QueueOne, RoutingKeyEnum::Create),
//                new RabbitMQExchangeQueueBindsDTO(QueueEnum::QueueTwo, RoutingKeyEnum::Update),
                new RabbitMQExchangeQueueBindsDTO(QueueEnum::LinkCreated, RoutingKeyEnum::Create),
            ],
        };
    }
}
