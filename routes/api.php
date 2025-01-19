<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/rabbitmq/{message}', function ($message) {
    resolve(\App\Services\RabbitMQ\RabbitMQService::class)->publish(
        exchange: \App\Services\RabbitMQ\ExchangeEnum::Topic->value,
        message: $message,
        routingKey: \App\Services\RabbitMQ\RoutingKeyEnum::routingName(
            \App\Services\RabbitMQ\RoutingKeyEnum::Create,
            'salaaam'
        )
    );

    return $message;

});

Route::group([
    'prefix' => '/v1',
], base_path('routes/group/handle.php'));
