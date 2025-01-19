<?php

namespace App\Services\RabbitMQ;

use App\Traits\EnumHelperTrait;
use PhpAmqpLib\Exchange\AMQPExchangeType;

enum ExchangeTypeEnum: string
{
    use EnumHelperTrait;

    case Direct = AMQPExchangeType::DIRECT;
    case Fanout = AMQPExchangeType::FANOUT;
    case Topic = AMQPExchangeType::TOPIC;
    case Headers = AMQPExchangeType::HEADERS;
}
