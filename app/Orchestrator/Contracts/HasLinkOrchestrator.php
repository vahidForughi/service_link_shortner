<?php

namespace App\Orchestrator\Contracts;

use App\DTO\Orchestrator\Link\LinkShowOrchOutputDTO;
use App\DTO\Orchestrator\Link\LinkStoreOrchInputDTO;
use App\DTO\Service\Link\LinkFetchByAddressInputDTO;
use App\DTO\Service\Link\LinkStoreInputDTO;
use App\Services\Link\LinkService;
use App\Services\RabbitMQ\RoutingKeyEnum;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Collection;

trait HasLinkOrchestrator
{
    final public function getLinksList(): Collection
    {
        return resolve(LinkService::class)->fetchList()
            ->map(fn ($link) =>
                new LinkShowOrchOutputDTO(
                    id: $link->id,
                    address: $link->address,
                    hash: $link->hash,
                    visitsCount: $link->visits_count,
                )
            );
    }

    final public function storeLink(LinkStoreOrchInputDTO $data): LinkShowOrchOutputDTO
    {
        $link = resolve(LinkService::class)->fetchByAddress(new LinkFetchByAddressInputDTO(
            address: $data->address,
        ));
        dd($link);
        if (!empty($link)) {
            throw new InvalidArgumentException();
        }

        resolve(\App\Services\RabbitMQ\RabbitMQService::class)->publish(
            exchange: \App\Services\RabbitMQ\ExchangeEnum::Topic->value,
            message: $data->toArray(),
            routingKey: RoutingKeyEnum::routingName(RoutingKeyEnum::Create, 'link')
        );

        dd('ok');

        $link = resolve(LinkService::class)->store(new LinkStoreInputDTO(
            address: $data->address,
        ));

        return new LinkShowOrchOutputDTO(
            id: $link->id,
            address: $link->address,
            hash: $link->hash,
            visitsCount: $link->visits_count,
        );
    }

    final public function showLink(string $linkID): LinkShowOrchOutputDTO
    {
        $link = resolve(LinkService::class)->fetchByID(linkID: $linkID);

        return new LinkShowOrchOutputDTO(
            id: $link->id,
            address: $link->address,
            hash: $link->hash,
            visitsCount: $link->visits_count,
        );
    }
}
