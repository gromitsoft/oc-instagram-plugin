<?php

use GromIT\Instagram\Api\Controllers\MediaController;
use GromIT\Instagram\Api\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => 'instagram',
        'middleware' => [
            'web',
            CorsMiddleware::class,
        ]
    ],
    static function () {
        Route::get('get/{account_id}/{limit?}', [MediaController::class, 'get']);
    }
);
