<?php

namespace App\Services\RabbitMQ;

use App\Services\RabbitMQ\Consumers\ConsumerLinkCreated;
use App\Services\RabbitMQ\Consumers\ConsumerThree;
use App\Services\RabbitMQ\Consumers\ConsumerTwo;
use App\Traits\EnumHelperTrait;

enum QueueEnum: string
{
    use EnumHelperTrait;

    case LinkCreated = 'link_created';

    public function consumers(): array
    {
        return match ($this) {
            self::LinkCreated => [ConsumerLinkCreated::class],
            default => [],
        };
    }
}
