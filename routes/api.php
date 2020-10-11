<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\StreamController;

Route::get('/ping', fn() => 'pong');

Route::group(['as' => 'api.', 'namespace' => 'API', 'middleware' => ['apiator', 'auth:sanctum']], static function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'v1', 'as' => 'v1.', 'namespace' => 'V1', 'middleware' => ['apiator']], static function () {
        Route::get('/stream', [StreamController::class, 'index']);
        Route::get('/stream/viewer_count', [StreamController::class, 'viewerCount']);
        Route::get('/stream/collect', [StreamController::class, 'collect']);
    });
});

