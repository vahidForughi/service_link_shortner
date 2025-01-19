<?php

namespace App\Exceptions\General;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class InternalException extends BaseException
{

    #[\Override] protected function setCode(): void
    {
        $this->code = $this->code == 0 ? ResponseStatusCodeEnum::InternalServerError->value : $this->code;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = $this->message == '' ? 'Internal Error.' : $this->message;
    }
}
