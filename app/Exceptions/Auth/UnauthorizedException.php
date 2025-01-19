<?php

namespace App\Exceptions\Auth;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class UnauthorizedException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = ResponseStatusCodeEnum::Unauthorized->value;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = __('messages.unauthorized');
    }
}
