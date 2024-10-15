<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\PersonalQuestController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('v1')->middleware("auth:sanctum")->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('personal-quests', PersonalQuestController::class);
    Route::get('logout', [AuthController::class, 'logout']);
});