<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\GroupController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'quotes'], function () {
        Route::get('/', [QuoteController::class, 'index']);
    });

    Route::group(['prefix' => 'coins'], function () {
        Route::get('/', [CoinController::class, 'listAll']);
        Route::get('/coins-with-recent-quotes', [CoinController::class, 'listCoinsWithRecentQuotes']);
    });

    Route::group(['prefix' => 'groups'], function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::post('/', [GroupController::class, 'save']);
        Route::get('/{group}', [GroupController::class, 'show']);
        Route::put('/{group}', [GroupController::class, 'update']);
        Route::delete('/{group}', [GroupController::class, 'destroy']);
        Route::post('/{group}/coins', [GroupController::class, 'addCoins']);
        Route::delete('/{group}/coins', [GroupController::class, 'removeCoins']);
    });
});
