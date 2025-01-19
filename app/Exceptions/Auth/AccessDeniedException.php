<?php

namespace App\Exceptions\Auth;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class AccessDeniedException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = ResponseStatusCodeEnum::Forbidden->value;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = 'Access Denied';
    }
}
