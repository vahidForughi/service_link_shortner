<?php

namespace App\DTO\Orchestrator\Link;

use App\DTO\BaseDTO;

class LinkStoreOrchInputDTO extends BaseDTO
{
    public function __construct(
        readonly public string $address,
    ) {
        parent::__construct();
    }
}
