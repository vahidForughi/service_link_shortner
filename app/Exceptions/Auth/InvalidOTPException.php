<?php

namespace App\Exceptions\Auth;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\BaseException;

class InvalidOTPException extends BaseException
{
    #[\Override] protected function setCode(): void
    {
        $this->code = ResponseStatusCodeEnum::BadRequest->value;
    }

    #[\Override] protected function setMessage(): void
    {
        $this->message = __('messages.is_wrong', ['attribute' => __('messages.attributes.otp')]);
    }
}
