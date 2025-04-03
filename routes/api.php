<?php

use App\Http\Controllers\Api\CustomerAuthController;
use App\Http\Controllers\Api\CustomerChatController;
use App\Http\Controllers\Api\DriverAuthController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\StoreRateController;
use App\Http\Controllers\Api\UnitRateController;
use Illuminate\Support\Facades\Route;

Route::prefix('customer')->group(function () {

    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::post('/login', [CustomerAuthController::class, 'login']);

    Route::get('/dashboardOffer', [HomeController::class, 'dashboardOffer']);
    Route::post('/search', [HomeController::class, 'search']);
    Route::get('/topUnits', [HomeController::class, 'topUnits']);
    Route::get('/newest', [HomeController::class, 'newest']);

    Route::get('/store/{id}', [StoreController::class, 'store']);
    Route::get('/product/{id}', [StoreController::class, 'product']);
    // Route::get('/item/{id}', [StoreController::class, 'item']);
    Route::get('/unit/{id}', [StoreController::class, 'unit']);

    Route::get('/store/offers/{id}', [OfferController::class, 'storeOffers']);
    Route::get('/offers', [OfferController::class, 'allOffers']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [CustomerAuthController::class, 'logout']);

        Route::get('/forYou', [HomeController::class, 'forYou']);
        Route::post('/unit_rate',[UnitRateController::class,'unitRate']);
        Route::delete('/unit_rate/delete/{id}',[UnitRateController::class,'destroy']);

        Route::post('/store_rate',[StoreRateController::class,'storeRate']);
        Route::delete('/store_rate/delete/{id}',[StoreRateController::class,'destroy']);

        Route::get('/order/{id}', [OrderController::class, 'index']);
        Route::post('/order', [OrderController::class, 'store']);

        Route::post('/chat/send', [CustomerChatController::class, 'sendMessage']);
        Route::get('/chat/messages', [CustomerChatController::class, 'getMessages']);
    });
});

Route::prefix('drivers')->group(function () {
    Route::post('register', [DriverAuthController::class, 'register']);
    Route::post('login', [DriverAuthController::class, 'login']);

    Route::middleware('auth:driver')->group(function () {
        Route::post('logout', [DriverAuthController::class, 'logout']);
    });
});
