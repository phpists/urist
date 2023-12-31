<?php

use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CriminalArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController as UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Auth routes and pages
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register.page');
Route::post('sing-in', [LoginController::class, 'login'])->name('sing-in')->middleware('throttle:5,1');
Route::post('sing-up', [RegisterController::class, 'register'])->name('sing-up')->middleware('throttle:5,1');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('verify-phone', [VerifyPhoneController::class, 'index'])->name('verify_phone.page');
Route::get('verify-phone-resend', function (){return view('auth.verify_resend');})->name('verify_phone_resend.page');
Route::post('verify_phone', [VerifyPhoneController::class, 'verify'])->name('verify_phone');
Route::get('send', [LoginController::class, 'send'])->name('send');

Route::get('password/forgot', [ResetPasswordController::class, 'index'])->name('password.forgot');
Route::post('password/send-code', [ResetPasswordController::class, 'sendResetPasswordCode'])->name('password.send.code');
Route::get('password/reset', function (){return view('auth.reset_password');})->name('password.reset');
Route::post('password/recovery', [ResetPasswordController::class, 'resetPassword'])->name('password.recovery');



//Other routes

Route::get('/', function () {return view('home');})->name('home');
Route::get('/offer', function () {return view('pages.offer');})->name('offer');
Route::get('/blog', function () {return view('pages.blog');})->name('blog');
Route::get('/policy', function () {return view('pages.policy');})->name('policy');
Route::get('faq', [FaqController::class, 'index'])->name('faq');
Route::get('contacts', [ContactController::class, 'index'])->name('contacts');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', fn() => view('pages.dashboard'))->name('dashboard');
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::get('/folder/{id}', [FolderController::class, 'view'])->name('folders.view');
    Route::get('/folders/search_favourites', [FolderController::class, 'searchFavouriteFolders'])->name('folders.search_favourites');
    Route::get('/folders/search_file_folders', [FolderController::class, 'searchFileFolders'])->name('folders.search_file_folders');
    Route::put('/folder/move', [FolderController::class, 'moveFolder'])->name('folder.move');
    Route::put('/folder/update', [FolderController::class, 'update'])->name('folder.update');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::delete('/folders', [FolderController::class, 'delete'])->name('folders.delete');
    // Favourites Controller
    Route::get('/favourites/{id?}', [\App\Http\Controllers\ProfileController::class, 'favourites'])->name('favourites');
    Route::delete('favourites', [FavoritesController::class, 'delete'])->name('favourites.delete');
    Route::get('favourites/search', [FavoritesController::class, 'search'])->name('favourites.search');
    Route::put('favourites/move', [FavoritesController::class, 'moveFavourite'])->name('favourite.move');
    // Article Routes
    Route::post('/favourites', [CriminalArticleController::class, 'addToFavourites'])->name('criminal_articles.favourites.add');
    // File Routes
    Route::post('files', [FileController::class, 'store'])->name('files.store');
    Route::put('file/update', [FileController::class, 'update'])->name('file.update');
    Route::put('file/move', [FileController::class, 'moveFile'])->name('file.move');
    Route::get('files/search', [FileController::class, 'search'])->name('file.search');
    Route::delete('files', [FileController::class, 'delete'])->name('files.delete');
    // Tags
    Route::get('/tags/search', [TagController::class, 'search'])
        ->name('tags.search');
    // Users
    Route::get('/welcome', [\App\Http\Controllers\ProfileController::class, 'welcome'])->name('welcome');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::get('/collection', [\App\Http\Controllers\ProfileController::class, 'collection'])->name('collection');
    Route::get('/edit-page', [\App\Http\Controllers\ProfileController::class, 'editPage'])->name('edit_page');
    Route::get('/article', [\App\Http\Controllers\ProfileController::class, 'article'])->name('article');
    Route::get('/subscription', [\App\Http\Controllers\ProfileController::class, 'subscription'])->name('subscription');
});

/** User */
Route::group(['middleware' => ['auth'], 'as' => 'user.'], function () {
    // Profile
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [UserProfileController::class, 'update'])->name('profile.update');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('article_categories', [ArticleCategoryController::class, 'index'])
        ->name('admin.article_categories');
    Route::get('article_category', [ArticleCategoryController::class, 'view'])
        ->name('admin.article_categories.view');
    Route::get('article_category/search', [ArticleCategoryController::class, 'search'])
        ->name('admin.article_categories.search');
    Route::get('/article_category/get_children', [ArticleCategoryController::class, 'getChildren'])
        ->name('admin.article_categories.get_children');
    Route::post('/article_categories', [ArticleCategoryController::class, 'store'])
        ->name('admin.article_category.store');
    Route::put('/article_categories', [ArticleCategoryController::class, 'update'])
        ->name('admin.article_category.update');
    Route::delete('/article_categories', [ArticleCategoryController::class, 'delete'])
        ->name('admin.article_category.delete');
    Route::put('/article_category/update_parent', [ArticleCategoryController::class, 'updateParent'])
        ->name('admin.article_category.update_parent');
    Route::put('/article_category/update_position', [ArticleCategoryController::class, 'updatePosition'])
        ->name('admin.article_category.update_position');
    Route::put('/article_category/update_status', [ArticleCategoryController::class, 'updateStatus'])
        ->name('admin.article_category.update_status');
    Route::delete('article_category/bulk_delete', [ArticleCategoryController::class, 'deleteBulk'])
        ->name('admin.article_categories.bulk_delete');

    // Criminal articles
    Route::get('/criminal_articles', [CriminalArticleController::class, 'index'])
        ->name('admin.criminal_articles.index');
    Route::get('/criminal_articles/create', [CriminalArticleController::class, 'create'])
        ->name('admin.criminal_articles.create');
    Route::get('/criminal_articles/{id}', [CriminalArticleController::class, 'edit'])
        ->name('admin.criminal_article.edit');
    Route::post('/criminal_articles/store', [CriminalArticleController::class, 'store'])
        ->name('admin.criminal_articles.store');
    Route::post('/criminal_articles/update', [CriminalArticleController::class, 'update'])
        ->name('admin.criminal_articles.update');
    Route::delete('/criminal_article/delete/{id}', [CriminalArticleController::class, 'delete'])
        ->name('admin.criminal_article.delete');
    Route::get('/criminal_articles/search', [CriminalArticleController::class, 'search'])
        ->name('admin.criminal_articles.search');
    Route::delete('criminal_articles/bulk_delete', [CriminalArticleController::class, 'deleteBulk'])
        ->name('admin.criminal_articles.bulk_delete');
    Route::put('/criminal_article/update_position', [CriminalArticleController::class, 'updatePosition'])
        ->name('admin.criminal_article.update_position');
    Route::put('/criminal_article/update_status', [CriminalArticleController::class, 'updateStatus'])
        ->name('admin.criminal_article.update_status');
    // Favourites
    Route::get('/favourites', [FavoritesController::class, 'index'])
        ->name('admin.favourites.index');
    Route::get('/favourites/{id?}', [FavoritesController::class, 'index'])
        ->name('admin.favourites.view');
    // File Manager
    Route::get('file_manager', [FileManagerController::class, 'index'])->name('admin.file_manager.index');
    Route::get('/file_manager/{folder_id?}', [FileManagerController::class, 'index'])
        ->name('admin.file_manager.view');
    Route::get('/file/{id?}', [FileController::class, 'view'])
        ->name('admin.file.view');
    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('admin.tags.store');
    Route::get('/tag', [TagController::class, 'view'])->name('admin.tag.view');
    Route::get('/tag', [TagController::class, 'view'])->name('admin.tag.view');
    Route::put('/tag/update', [TagController::class, 'update'])->name('admin.tag.update');
    Route::delete('/tag/delete', [TagController::class, 'delete'])->name('admin.tag.delete');
    Route::delete('/tags/bulk_delete', [TagController::class, 'deleteBulk'])
        ->name('admin.tags.bulk_delete');
    Route::put('/tag/update_position', [TagController::class, 'updatePosition'])
        ->name('admin.tag.update_position');
    // Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions.index');
    Route::post('/subscriptions/update_permission', [SubscriptionController::class, 'updateRolePermission'])->name('admin.subscriptions.update_role_permission');
});
