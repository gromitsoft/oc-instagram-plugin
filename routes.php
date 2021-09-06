<?php


use GromIT\Instagram\Api\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => 'instagram',
        'middleware' => [
            'web',
        ]
    ],
    static function () {
        Route::get('get', [MediaController::class, 'get']);
    }
);
