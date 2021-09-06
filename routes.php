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
        Route::get('get/{account_id}', [\GromIT\Instagram\Controllers\Accounts::class, 'getMedias']);
    }
);
