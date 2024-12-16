<?php

use App\Http\Controllers\Api\PaymentController;
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
//    Route::post('register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'index']);
    Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
//    Route::post('verify-code', [\App\Http\Controllers\Api\Auth\VerifyController::class, 'index']);
    Route::post('logout', [\App\Http\Controllers\Api\Auth\LogoutController::class, 'index']);
    // With providers
    Route::post('login/apple/{token}', [\App\Http\Controllers\Api\Auth\LoginController::class, 'handleAppleLogin']);
    Route::post('login/google/{token}', [\App\Http\Controllers\Api\Auth\LoginController::class, 'handleGoogleLogin']);

    // Reset Password
    Route::post('reset-password/request', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'request']);
    Route::post('reset-password/verify', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'verify']);
    Route::put('reset-password', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'update']);

    // guest login
    Route::post('login-guest', [\App\Http\Controllers\Api\Auth\LoginController::class, 'guest']);
});

Route::group(['middleware' => ['jwt', 'api-single-login']], function () {
    Route::get('me', [\App\Http\Controllers\Api\User\ProfileController::class, 'index']);
    Route::put('me', [\App\Http\Controllers\Api\User\ProfileController::class, 'update']);
    Route::delete('me', [\App\Http\Controllers\Api\User\ProfileController::class, 'destroy']);

    /** Articles */
    Route::get('criminal-articles/categories/{type?}', [\App\Http\Controllers\Api\CriminalArticleController::class, 'categories']);
    Route::get('criminal-articles/search', [\App\Http\Controllers\Api\CriminalArticleController::class, 'search']);
    Route::get('criminal-articles/{type?}', [\App\Http\Controllers\Api\CriminalArticleController::class, 'index']);
    Route::get('criminal-article/{criminalArticle}', [\App\Http\Controllers\Api\CriminalArticleController::class, 'show']);
    Route::get('criminal-article/{article}/export-doc', [\App\Http\Controllers\Api\CriminalArticleController::class, 'exportDoc']);

    /** Categories */
    Route::get('categories/search/{type}', [\App\Http\Controllers\Api\CategoryController::class, 'search']);
    Route::get('categories/{type}/{articleCategory?}', [\App\Http\Controllers\Api\CategoryController::class, 'index']);

    /** Cabinet */
    Route::get('cabinet/files/{file}/export-doc', [\App\Http\Controllers\Api\User\FileController::class, 'exportDoc'])
        ->middleware('throttle:10,5');
    Route::resource('cabinet', \App\Http\Controllers\Api\User\FileController::class)->only('index');
    Route::resource('cabinet/folders', \App\Http\Controllers\Api\User\FileFolderController::class)
        ->only(['store', 'update', 'destroy']);
    Route::post('cabinet/files/new', [\App\Http\Controllers\Api\User\FileController::class, 'newFile']);
    Route::resource('cabinet/files', \App\Http\Controllers\Api\User\FileController::class)
        ->except('index');
    Route::resource('cabinet/bookmarks', \App\Http\Controllers\Api\User\BookmarkController::class)
        ->except(['show']);

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

    /** Notifications */
    Route::resource('notifications', \App\Http\Controllers\Api\User\NotificationController::class)->only('index');
    Route::post('notifications/bulk-read', [\App\Http\Controllers\Api\User\NotificationController::class, 'bulkRead']);

});


// Check Token Validity
Route::get('auth/check-token-validity', \App\Http\Controllers\Api\Auth\ValidateTokenController::class);

// LiqPay
Route::post('liqpay/callback', [\App\Http\Controllers\Api\LiqPayController::class, 'callback'])
    ->middleware(['liqpay.check.signature'])
    ->name('api.liqpay.callback');

// RevenueCat
Route::post('revenuecat/webhook', [\App\Http\Controllers\Api\RevenueCatController::class, 'webhook']);
