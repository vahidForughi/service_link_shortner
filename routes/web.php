<?php

use Illuminate\Support\Facades\Route;

Route::get('/links/bulk-store', function () {

    $links = [];
    for ($i = 0; $i < 5 ; $i++) {
        $address = fake()->url();
        $links[] = [
            "id" => fake()->uuid(),
            "address" => $address,
            "hash" => bcrypt($address),
        ];
    }

    \App\Models\Link::insert($links);

    return "ok";
});

Route::get('/{hash}', function ($hash) {
    $link = \App\Models\Link::where('hash', $hash)->first();
    $link->update([
        "visits_count" => $link->visits_count + 1
    ]);
    return $link->address;
});
