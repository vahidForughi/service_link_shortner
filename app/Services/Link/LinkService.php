<?php

namespace App\Services\Link;

use App\DTO\Service\Link\LinkFetchByAddressInputDTO;
use App\DTO\Service\Link\LinkStoreInputDTO;
use App\Models\Link;
use App\Repositories\LinkRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Collection;

class LinkService extends BaseService
{
    public function __construct(
        readonly private LinkRepositoryInterface $linkRepository
    ) {}

    public function fetchList(): Collection
    {
        return $this->linkRepository->getAllLinks();
    }

    public function store(LinkStoreInputDTO $linkData): Link
    {
        return $this->linkRepository->createLink([
            'address' => $linkData->address,
            'hash' => bcrypt($linkData->address),
            'visits_count' => 0,
        ]);
    }

    public function fetchByID(string $linkID): Link
    {
        return $this->linkRepository->getLinkById(id: $linkID);
    }

    public function fetchByAddress(LinkFetchByAddressInputDTO $linkData): Link
    {
        return $this->linkRepository->getLinkByAddress(address: $linkData->address);
    }

}
