<?php

namespace App\DTO\Service\Link;

use App\DTO\BaseDTO;

class LinkStoreInputDTO extends BaseDTO
{
    public function __construct(
        readonly public string $address,
    ) {
        parent::__construct();
    }

    protected function rules(): array
    {
        return [
            'address' =>'required|url|max:2000',
        ];
    }

    protected function validate(): void
    {
        parent::validate();
    }
}
