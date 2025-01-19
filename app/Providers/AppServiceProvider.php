<?php

namespace App\Providers;

use App\Enums\ResponseStatusCodeEnum;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('successJson', function (
            array $data = [],
            ResponseStatusCodeEnum|int $statusCode = ResponseStatusCodeEnum::OK,
            array $headers = [],
            int $options = 0
        ) {
            return response()->json(
                data: $data === [] ? null :[
                    'success' => true,
                    'data' => $data,
                ],
                status: $statusCode instanceof ResponseStatusCodeEnum ? $statusCode->value : $statusCode,
                headers: $headers,
                options: $options
            );
        });

        Response::macro('failedJson', function (
            array|string $message,
            ResponseStatusCodeEnum|int $statusCode = ResponseStatusCodeEnum::BadRequest,
            array $headers = [],
            int $options = 0
        ) {
            return response()->json(
                data: [
                    'success' => false,
                    'message' => $message,
                ],
                status: $statusCode instanceof ResponseStatusCodeEnum ? $statusCode->value : $statusCode,
                headers: $headers,
                options: $options
            );
        });
    }
}
