<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WebsiteController;
use App\Http\Middleware\PreventUnauthorizedAccesskey;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('websites')->group(function () {
    Route::get('/', [WebsiteController::class, 'index']);

    Route::prefix('{website}')->group(function () {
        Route::post('/subscribe', [SubscriberController::class, 'store']);
        Route::post('/unsubscribe/{subscriber:email}', [SubscriberController::class, 'destroy']);

        Route::prefix('posts')->group(function () {
            Route::get('', [PostController::class, 'index']);
            Route::post('', [PostController::class, 'store']);
        });
    });
});
