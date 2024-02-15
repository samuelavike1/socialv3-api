<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Authentication routes
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');

//user profile routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('create-profile', [\App\Http\Controllers\UserProfileController::class, 'store']);
    Route::get('show-profile', [\App\Http\Controllers\UserProfileController::class, 'show']);
    Route::post('update-profile', [\App\Http\Controllers\UserProfileController::class, 'update']);
});

//Post Routes
Route::apiResource('post', \App\Http\Controllers\PostController::class);
