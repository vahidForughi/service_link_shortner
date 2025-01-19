<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
//    Cache::put('hello', 'world');
    return Cache::get('links:9de54b08-f614-490c-b1a7-b8b45c3298fc');
//    return Cache::get('hello');
});

Route::get('/', [
    \App\Http\Controllers\LinkController::class,
    'index'
]);

Route::post('/', [
    \App\Http\Controllers\LinkController::class,
    'store'
]);

Route::group([
    'prefix' => '/{link_id}'
], function () {

    Route::get('/', [
        \App\Http\Controllers\LinkController::class,
        'show'
    ]);

    Route::put('/', [
        \App\Http\Controllers\LinkController::class,
        'update'
    ]);

    Route::delete('/', [
        \App\Http\Controllers\LinkController::class,
        'delete'
    ]);

});
