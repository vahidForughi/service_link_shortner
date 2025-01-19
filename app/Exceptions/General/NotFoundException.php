<?php

namespace App\Exceptions\General;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class NotFoundException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = $this->code == 0 ? ResponseStatusCodeEnum::NotFound->value : $this->code;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = $this->message == '' ? 'Not Found.' : $this->message;
    }
}
