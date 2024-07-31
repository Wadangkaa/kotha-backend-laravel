<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::post('login', [AuthenticationController::class, 'login']);
Route::post('register', [AuthenticationController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', [AuthenticationController::class, 'profile']);
    Route::post('logout', [AuthenticationController::class, 'logout']);
});
