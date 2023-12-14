<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login');
Route::post('/authenticate', [\App\Http\Controllers\Admin\AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('register');
Route::get('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/folders', [\App\Http\Controllers\FolderController::class, 'index'])->name('folders.index');
    Route::get('/folder/{id}', [\App\Http\Controllers\FolderController::class, 'view'])->name('folders.view');
    Route::get('/folders/search_favourites', [\App\Http\Controllers\FolderController::class, 'searchFavouriteFolders'])->name('folders.search_favourites');
    Route::get('/folders/search_file_folders', [\App\Http\Controllers\FolderController::class, 'searchFileFolders'])->name('folders.search_file_folders');
    Route::put('/folder/move', [\App\Http\Controllers\FolderController::class, 'moveFolder'])->name('folder.move');
    Route::put('/folder/update', [\App\Http\Controllers\FolderController::class, 'update'])->name('folder.update');
    Route::post('/folders', [\App\Http\Controllers\FolderController::class, 'store'])->name('folders.store');
    Route::delete('/folders', [\App\Http\Controllers\FolderController::class, 'delete'])->name('folders.delete');
    // Favourites Controller
    Route::delete('favourites', [\App\Http\Controllers\FavoritesController::class, 'delete'])->name('favourites.delete');
    Route::get('favourites/search', [\App\Http\Controllers\FavoritesController::class, 'search'])->name('favourites.search');
    // Article Routes
    Route::post('/favourites', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'addToFavourites'])->name('criminal_articles.favourites.add');
    // File Routes
    Route::post('files', [\App\Http\Controllers\FileController::class, 'store'])->name('files.store');
    Route::put('file/update', [\App\Http\Controllers\FileController::class, 'update'])->name('file.update');
    Route::put('file/move', [\App\Http\Controllers\FileController::class, 'moveFile'])->name('file.move');
    Route::get('files/search', [\App\Http\Controllers\FileController::class, 'search'])->name('file.search');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('article_categories', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'index'])
        ->name('admin.article_categories');
    Route::get('article_category', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'view'])
        ->name('admin.article_categories.view');
    Route::get('article_category/search', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'search'])
        ->name('admin.article_categories.search');
    Route::get('/article_category/get_children', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'getChildren'])
        ->name('admin.article_categories.get_children');
    Route::post('/article_categories', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'store'])
        ->name('admin.article_category.store');
    Route::put('/article_categories', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'update'])
        ->name('admin.article_category.update');
    Route::delete('/article_categories', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'delete'])
        ->name('admin.article_category.delete');
    Route::put('/article_category/update_parent', [\App\Http\Controllers\Admin\ArticleCategoryController::class, 'updateParent'])
        ->name('admin.article_category.update_parent');

    // Criminal articles
    Route::get('/criminal_articles', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'index'])
        ->name('admin.criminal_articles.index');
    Route::get('/criminal_articles/create', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'create'])
        ->name('admin.criminal_articles.create');
    Route::get('/criminal_articles/{id}', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'edit'])
        ->name('admin.criminal_article.edit');
    Route::post('/criminal_articles/store', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'store'])
        ->name('admin.criminal_articles.store');
    Route::post('/criminal_articles/update', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'update'])
        ->name('admin.criminal_articles.update');
    Route::delete('/criminal_article/delete/{id}', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'delete'])
        ->name('admin.criminal_article.delete');
    Route::get('/criminal_articles/search', [\App\Http\Controllers\Admin\CriminalArticleController::class, 'search'])
        ->name('admin.criminal_articles.search');
    // Favourites
    Route::get('/favourites', [\App\Http\Controllers\FavoritesController::class, 'index'])
        ->name('admin.favourites.index');
    Route::get('/favourites/{id?}', [\App\Http\Controllers\FavoritesController::class, 'index'])
        ->name('admin.favourites.view');
    // File Manager
    Route::get('file_manager', [\App\Http\Controllers\FileManagerController::class, 'index'])->name('admin.file_manager.index');
    Route::get('/file_manager/{folder_id?}', [\App\Http\Controllers\FileManagerController::class, 'index'])
        ->name('admin.file_manager.view');
    Route::get('/file/{id?}', [\App\Http\Controllers\FileController::class, 'view'])
        ->name('admin.file.view');
});
