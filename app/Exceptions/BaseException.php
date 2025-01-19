<?php

namespace App\Exceptions;

use App\Enums\ResponseStatusCodeEnum;
use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

abstract class BaseException extends Exception
{
    public function __construct(string $message = "", ResponseStatusCodeEnum|int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            message: $message,
            code: $code instanceof ResponseStatusCodeEnum ? $code->value : $code,
            previous: $previous
        );

        $this->setCode();
        $this->setMessage();
    }

    abstract protected function setCode(): void;

    abstract protected function setMessage(): void;

    public function render(): JsonResponse
    {
        $message = $this->handleMessage($this);
        if (count($message) == 1){
            $message = $message[0];
        }

        return response()->failedJson(message: $message, statusCode: $this->code);
    }

    protected function handleMessage(
        Throwable|Exception $ex,
    ): array {
        $messages = [
            $ex->getMessage(),
        ];

        if (!empty($previous = $this->getPrevious())) {
            $messages[] = $previous->getMessage();
        }

        return $messages;
    }
}
