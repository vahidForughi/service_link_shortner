<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/admin'
], base_path('routes/group/admin/handle.php'));
