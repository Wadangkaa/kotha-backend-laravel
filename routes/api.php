<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KothaController;
use App\Http\Controllers\RentalFloorController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);
Route::apiResource('kotha', KothaController::class, ['only' => ['index', 'show']]);
Route::post('search-kotha-in-map', [KothaController::class, 'searchKothaInMap']);
Route::post('recommendation', [KothaController::class, 'recommendation']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', [AuthenticationController::class, 'profile']);
    Route::post('logout', [AuthenticationController::class, 'logout']);

    Route::get('kotha/self/all', [KothaController::class, 'authUserKotha']);
    Route::apiResource('kotha', KothaController::class, ['except' => ['index', 'show']]);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('rental-floor', RentalFloorController::class);


    // admin routes
    Route::get('dashboard-stats', [AdminController::class, 'dashboardStats']);
});
