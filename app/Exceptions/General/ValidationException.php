<?php

namespace App\Exceptions\General;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class ValidationException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = ResponseStatusCodeEnum::BadRequest->value;
    }

    #[\Override] protected function setMessage(): void
    {
        return;
    }
}
