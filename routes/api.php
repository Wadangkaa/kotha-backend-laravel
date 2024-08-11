<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KothaController;
use App\Http\Controllers\RentalFloorController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', [AuthenticationController::class, 'profile']);
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::apiResource('kotha', KothaController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('rental-floor', RentalFloorController::class);
});
