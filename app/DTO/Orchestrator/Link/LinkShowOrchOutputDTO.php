<?php

namespace App\DTO\Orchestrator\Link;

use App\DTO\BaseDTO;

class LinkShowOrchOutputDTO extends BaseDTO
{
    public function __construct(
        readonly public string $id,
        readonly public string $address,
        readonly public string $hash,
        readonly public int $visitsCount,
    ) {
        parent::__construct();
    }
}
