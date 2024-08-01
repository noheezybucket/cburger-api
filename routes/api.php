<?php

use App\Http\Controllers\API\BurgerController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('burgers', BurgerController::class);
    Route::apiResource('orders', OrderController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
