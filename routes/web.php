<?php

use App\Http\Controllers\Admin\ArticleCategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CriminalArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

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



//New routes
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('register', [RegisterController::class, 'index'])->name('register.page');
Route::post('sing-in', [LoginController::class, 'login'])->name('sing-in')->middleware('throttle:5,1');
Route::post('sing-up', [RegisterController::class, 'register'])->name('sing-up');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('verify-phone', [VerifyPhoneController::class, 'index'])->name('verify_phone.page');
Route::post('verify_phone', [VerifyPhoneController::class, 'verify'])->name('verify_phone');

Route::get('send', [LoginController::class, 'send'])->name('send');

Route::get('/', function () {
    return view('home');
})->name('home');
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
    Route::delete('favourites', [FavoritesController::class, 'delete'])->name('favourites.delete');
    Route::get('favourites/search', [FavoritesController::class, 'search'])->name('favourites.search');
    // Article Routes
    Route::post('/favourites', [CriminalArticleController::class, 'addToFavourites'])->name('criminal_articles.favourites.add');
    // File Routes
    Route::post('files', [FileController::class, 'store'])->name('files.store');
    Route::put('file/update', [FileController::class, 'update'])->name('file.update');
    Route::put('file/move', [FileController::class, 'moveFile'])->name('file.move');
    Route::get('files/search', [FileController::class, 'search'])->name('file.search');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
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
});
