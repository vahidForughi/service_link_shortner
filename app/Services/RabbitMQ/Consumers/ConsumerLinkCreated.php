<?php

namespace App\Services\RabbitMQ\Consumers;

use App\DTO\Service\Link\LinkStoreInputDTO;
use App\Services\Link\LinkService;
use App\Services\RabbitMQ\QueueEnum;
use App\Services\RabbitMQ\RabbitMQService;
use Illuminate\Support\Facades\Log;

class ConsumerLinkCreated extends RabbitMQConsumerAbstract
{
    public static function getQueue(): QueueEnum
    {
        return QueueEnum::LinkCreated;
    }

    public static function handle($message)
    {
        echo 'Consumer Link Created';
        Log::info('Consumer Link Created');
        $data = resolve(RabbitMQService::class)->messageDecode($message->body);
        Log::info($data);

        resolve(LinkService::class)->store(new LinkStoreInputDTO(
            address: $data->address,
        ));

        $message->ack();
    }
}
