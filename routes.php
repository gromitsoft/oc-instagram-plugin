<?php


use GromIT\Instagram\Api\Controllers\MediaController;
use GromIT\Instagram\Api\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => 'api',
        'middleware' => [
            'web',
            CorsMiddleware::class,
        ]
    ],
    static function () {
        Route::get('instagram', [MediaController::class, 'get']);
    }
);
