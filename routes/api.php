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
    Route::put('me', [\App\Http\Controllers\Api\User\ProfileController::class, 'update']);

    /** Articles */
    Route::get('criminal-articles/categories', [\App\Http\Controllers\Api\CriminalArticleController::class, 'categories']);
    Route::resource('criminal-articles', \App\Http\Controllers\Api\CriminalArticleController::class)
        ->only(['index', 'show']);

    /** Bookmarks */
    Route::resource('bookmarks', \App\Http\Controllers\Api\User\BookmarkController::class)
        ->except(['show', 'update']);
    Route::resource('bookmarks/folder', \App\Http\Controllers\Api\User\BookmarkFolderController::class)
        ->only(['store', 'update', 'destroy']);

    /** Registries */
    Route::get('registries', [\App\Http\Controllers\Api\RegistryController::class, 'index']);

    /** Blog */
    Route::get('blog-tags', [\App\Http\Controllers\Api\BlogController::class, 'tags']);
    Route::get('blog', [\App\Http\Controllers\Api\BlogController::class, 'index']);
    Route::get('blog/a/{article}', [\App\Http\Controllers\Api\BlogController::class, 'show']);

    /** Pages */
    Route::get('pages/{page}', [\App\Http\Controllers\Api\PageController::class, 'index']);

    /** Contact Form */
    Route::post('contact-form', [\App\Http\Controllers\Api\ContactController::class, 'form']);
});
