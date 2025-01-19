<?php

namespace App\Exceptions;

use App\Enums\ResponseStatusCodeEnum;
use App\Exceptions\General\InternalException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render(
        $request,
        Throwable $e
    ): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response {
        switch (true) {
            case $e instanceof InternalException:
                break;
            case $e instanceof BaseException:
                return $e->render();
            case $e instanceof AccessDeniedException:
            case $e instanceof AuthenticationException:
                return response()->failedJson(message: $e->getMessage(), statusCode: ResponseStatusCodeEnum::Forbidden);
            case $e instanceof ValidationException :
                return response()->failedJson(message: $e->errors());
            case $e instanceof NotFoundHttpException:
                return response()->failedJson(message: 'The route could not be found.', statusCode: ResponseStatusCodeEnum::NotFound);
        }

        if (config('app.env') == 'production') {
            return response()->failedJson(
                message: 'An error has happened',
                statusCode: ResponseStatusCodeEnum::InternalServerError
            );
        }

        return parent::render($request, $e);
    }


}
