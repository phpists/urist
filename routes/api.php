<?php

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

/** Auth */
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);
    Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
    Route::post('verify-code', [\App\Http\Controllers\Api\Auth\VerifyController::class, 'index']);
    Route::post('logout', [\App\Http\Controllers\Api\Auth\LogoutController::class, 'index']);

    // Reset Password
    Route::post('reset-password/request', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'request']);
    Route::post('reset-password/verify', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'verify']);
    Route::put('reset-password', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'update']);
});

Route::group(['middleware' => 'jwt'], function () {
    Route::get('me', [\App\Http\Controllers\Api\User\ProfileController::class, 'index']);
});
