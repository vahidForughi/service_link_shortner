<?php

namespace App\Exceptions\General;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class BadRequestException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = $this->code == 0 ? ResponseStatusCodeEnum::BadRequest->value : $this->code;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = $this->message == '' ? 'Bad Request.' : $this->message;
    }
}
