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

Route::get('login/{driver}', [LoginController::class, 'driverLogin'])->name('login.driver');
Route::get('login/{driver}/callback', [LoginController::class, 'driverLoginCallback'])->name('login.driver.callback');

Route::get('register', [RegisterController::class, 'index'])->name('register.page');
Route::post('sing-in', [LoginController::class, 'login'])->name('sing-in')->middleware('throttle:5,1');
Route::post('sing-up', [RegisterController::class, 'register'])->name('sing-up')->middleware('throttle:5,1');
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('verify-phone', [VerifyPhoneController::class, 'index'])->name('verify_phone.page');
Route::get('verify-phone-resend', function (){return view('auth.verify_resend');})->name('verify_phone_resend.page');
Route::post('verify_phone', [VerifyPhoneController::class, 'verify'])->name('verify_phone');
Route::post('verify-phone/resend', [VerifyPhoneController::class, 'resendVerifyCode'])->name('auth.verify-phone.resend');
Route::get('send', [LoginController::class, 'send'])->name('send');

Route::get('password/forgot', [ResetPasswordController::class, 'index'])->name('password.forgot');
Route::post('password/send-code', [ResetPasswordController::class, 'sendResetPasswordCode'])->name('password.send.code');
Route::get('password/reset', function (){return view('auth.reset_password');})->name('password.reset');
Route::post('password/verify-code', [ResetPasswordController::class, 'verifyCode'])->name('password.verify-code');
Route::post('password/recovery', [ResetPasswordController::class, 'resetPassword'])->name('password.recovery');
Route::get('password/verify-page', [ResetPasswordController::class, 'verificationPage'])->name('password.verify-page');
Route::post('password/verification-code/resend', [ResetPasswordController::class, 'resendVerifyCode'])
    ->name('auth.reset-password.verify-code.resend');



//Other routes

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::post('form', [\App\Http\Controllers\HomeController::class, 'form'])
    ->name('home.form');

Route::get('/offer', [\App\Http\Controllers\HomeController::class, 'offer'])->name('offer');
Route::get('/policy', [\App\Http\Controllers\HomeController::class, 'policy'])->name('policy');
Route::get('faq', [FaqController::class, 'index'])->name('faq');
Route::get('contacts', [ContactController::class, 'index'])->name('contacts');


/** Blog */
Route::get('blog/{blogTag?}', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/article/{blog}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
/** /Blog */


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
    Route::post('files/new', [FileController::class, 'new'])->name('files.new.store');
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
});

/** User */
Route::group(['middleware' => ['auth'], 'as' => 'user.'], function () {
    // Index
    Route::get('dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])
        ->name('dashboard.index');

    // Profile
    Route::get('profile', [UserProfileController::class, 'index'])
        ->name('profile.index');
    Route::put('profile', [UserProfileController::class, 'update'])
        ->name('profile.update');
    Route::post('update-password', [UserProfileController::class, 'changePassword'])
        ->name('profile.change-password');
    Route::get('search-city', [UserProfileController::class, 'searchCity'])
        ->name('profile.search-city');

    Route::group(['middleware' => ['role:max']], function () {
        // Articles
        Route::get('articles/{type?}', [\App\Http\Controllers\User\ArticleController::class, 'index'])
            ->name('articles.index');
        Route::get('search', [\App\Http\Controllers\User\ArticleController::class, 'search'])
            ->name('articles.search');
        Route::get('article/{article}', [\App\Http\Controllers\User\ArticleController::class, 'show'])
            ->name('articles.show');
//    Route::resource('articles/{type}', \App\Http\Controllers\User\ArticleController::class)
//        ->only(['index', 'show']);
        Route::get('articles-total-count/{type?}', [\App\Http\Controllers\User\ArticleController::class, 'articlesCount'])
            ->name('articles.total-count');
        // Download DOC
        Route::get('articles/{article}/export-doc', [\App\Http\Controllers\User\ArticleController::class, 'exportDoc'])
            ->name('articles.export-doc');

        Route::get('search/items', [\App\Http\Controllers\User\ArticleController::class, 'searchItems'])
            ->name('search.items');

        // Bookmarks
        Route::get('bookmarks/{folderId?}', [\App\Http\Controllers\User\BookmarkController::class, 'index'])
            ->name('bookmarks.index');

        // File Manager
        Route::get('cabinet/{folderId?}', [\App\Http\Controllers\User\FileController::class, 'index'])
            ->name('files.index');
        Route::get('file/{file}/edit', [\App\Http\Controllers\User\FileController::class, 'edit'])
            ->name('files.edit');
        Route::put('file/{file}/update-file-name', [\App\Http\Controllers\User\FileController::class, 'updateFileName'])
            ->name('files.update.file-name');
        // Download DOC
        Route::get('file/{file}/export-doc', [\App\Http\Controllers\User\FileController::class, 'exportDoc'])
            ->name('files.export-doc');

        // Registries
        Route::get('registries', [\App\Http\Controllers\User\RegistryController::class, 'index'])
            ->name('registries.index');
    });

    // Filter
    Route::get('filter/{type?}', [\App\Http\Controllers\User\ArticleController::class, 'getFilter'])
        ->name('filter');

    // Subscription
    Route::get('subscription', [\App\Http\Controllers\User\SubscriptionController::class, 'index'])
        ->name('subscription.index');
    Route::post('subscription/{plan}', [\App\Http\Controllers\User\SubscriptionController::class, 'paymentData'])
        ->name('subscription.payment-data');
    Route::delete('subscription/cancel', [\App\Http\Controllers\User\SubscriptionController::class, 'cancel'])
        ->name('subscription.cancel');

    // Notifications
    Route::post('notifications/bulk-mark-as-read', [\App\Http\Controllers\User\NotificationController::class, 'bulkMarkAsRead'])
        ->name('notifications.bulk-mark-as-read');

});

Route::post('subscription', [\App\Http\Controllers\User\SubscriptionController::class, 'checkout'])
    ->middleware(['liqpay.check.signature'])
    ->name('subscription.checkout');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin'], 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('article_categories_all/{tab?}/{category?}', [ArticleCategoryController::class, 'index'])
        ->name('article_categories');
    Route::get('article_category', [ArticleCategoryController::class, 'view'])
        ->name('article_categories.view');
    Route::get('article_category/search', [ArticleCategoryController::class, 'search'])
        ->name('article_categories.search');
    Route::get('/article_category/get_children', [ArticleCategoryController::class, 'getChildren'])
        ->name('article_categories.get_children');
    Route::post('/article_categories', [ArticleCategoryController::class, 'store'])
        ->name('article_category.store');
    Route::put('/article_categories', [ArticleCategoryController::class, 'update'])
        ->name('article_category.update');
    Route::delete('/article_categories', [ArticleCategoryController::class, 'delete'])
        ->name('article_category.delete');
    Route::put('/article_category/update_parent', [ArticleCategoryController::class, 'updateParent'])
        ->name('article_category.update_parent');
    Route::put('/article_category/update_position/{category}', [ArticleCategoryController::class, 'updatePosition'])
        ->name('article_category.update_position');
    Route::put('/article_category/update_status', [ArticleCategoryController::class, 'updateStatus'])
        ->name('article_category.update_status');
    Route::delete('article_category/bulk_delete', [ArticleCategoryController::class, 'deleteBulk'])
        ->name('article_categories.bulk_delete');
    Route::get('article_categories/{article_category}/show-full-path', [ArticleCategoryController::class, 'showFullPath'])
        ->name('article_categories.show-full-path');

    // Criminal articles
    Route::get('/criminal_articles', [CriminalArticleController::class, 'index'])
        ->name('criminal_articles.index');
    Route::get('/criminal_articles/create', [CriminalArticleController::class, 'create'])
        ->name('criminal_articles.create');
    Route::get('/criminal_articles/{id}', [CriminalArticleController::class, 'edit'])
        ->name('criminal_article.edit');
    Route::post('/criminal_articles/store', [CriminalArticleController::class, 'store'])
        ->name('criminal_articles.store');
    Route::post('/criminal_articles/update', [CriminalArticleController::class, 'update'])
        ->name('criminal_articles.update');
    Route::delete('/criminal_article/delete/{id}', [CriminalArticleController::class, 'delete'])
        ->name('criminal_article.delete');
    Route::get('/criminal_articles/search', [CriminalArticleController::class, 'search'])
        ->name('criminal_articles.search');
    Route::delete('criminal_articles/bulk_delete', [CriminalArticleController::class, 'deleteBulk'])
        ->name('criminal_articles.bulk_delete');
    Route::put('/criminal_article/update_position', [CriminalArticleController::class, 'updatePosition'])
        ->name('criminal_article.update_position');
    Route::put('/criminal_article/update_status', [CriminalArticleController::class, 'updateStatus'])
        ->name('criminal_article.update_status');
    Route::get('criminal_article/check-name', [CriminalArticleController::class, 'checkName'])
        ->name('criminal-article.check-name');
    Route::post('criminal_articles/{article}/update_category', [CriminalArticleController::class, 'updateCategory'])
        ->name('criminal-article.update-category');
    Route::get('criminal_article/{article}/full_name', [CriminalArticleController::class, 'showFullName'])
        ->name('criminal-article.show-full-name');
    Route::post('criminal_article/{article}/delete_category', [CriminalArticleController::class, 'deleteCategory'])
        ->name('criminal-article.delete-category');
    Route::post('criminal_article/add_category', [CriminalArticleController::class, 'addCategory'])
        ->name('criminal-article.add-category');
    Route::get('criminal_articles-data-for-select', [CriminalArticleController::class, 'getAllArticlesForSelect'])
        ->name('criminal-articles.data-for-select');

    // Favourites
    Route::get('/favourites', [FavoritesController::class, 'index'])
        ->name('favourites.index');
    Route::get('/favourites/{id?}', [FavoritesController::class, 'index'])
        ->name('favourites.view');
    // File Manager
    Route::get('file_manager', [FileManagerController::class, 'index'])->name('file_manager.index');
    Route::get('/file_manager/{folder_id?}', [FileManagerController::class, 'index'])
        ->name('file_manager.view');
    Route::get('/file/{id?}', [FileController::class, 'view'])
        ->name('file.view');
    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tag', [TagController::class, 'view'])->name('tag.view');
    Route::get('/tag', [TagController::class, 'view'])->name('tag.view');
    Route::put('/tag/update', [TagController::class, 'update'])->name('tag.update');
    Route::delete('/tag/delete', [TagController::class, 'delete'])->name('tag.delete');
    Route::delete('/tags/bulk_delete', [TagController::class, 'deleteBulk'])
        ->name('tags.bulk_delete');
    Route::put('/tag/update_position', [TagController::class, 'updatePosition'])
        ->name('tag.update_position');
    // Subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions/update_permission', [SubscriptionController::class, 'updateRolePermission'])->name('subscriptions.update_role_permission');

    // Registries
    Route::delete('registries/bulk-delete', [\App\Http\Controllers\Admin\RegistryController::class, 'bulkDelete'])
        ->name('registries.bulk_delete');
    Route::resource('registries', \App\Http\Controllers\Admin\RegistryController::class);

    // Blog
    Route::delete('blog/bulk-delete', [\App\Http\Controllers\Admin\Blog\BlogController::class, 'bulkDelete'])
        ->name('blog.bulk-delete');
    Route::resource('blog', \App\Http\Controllers\Admin\Blog\BlogController::class);

    // Blog Tag
    Route::delete('blog-tags/bulk-delete', [\App\Http\Controllers\Admin\Blog\BlogTagController::class, 'bulkDelete'])
        ->name('blog-tags.bulk-delete');
    Route::post('blog-tags/sort', [\App\Http\Controllers\Admin\Blog\BlogTagController::class, 'sort'])
        ->name('blog-tags.sort');
    Route::resource('blog-tags', \App\Http\Controllers\Admin\Blog\BlogTagController::class);

    // Plans
    Route::post('plans/sort', [\App\Http\Controllers\Admin\Plan\PlanController::class, 'sort'])
        ->name('plans.sort');
    Route::resource('plans', \App\Http\Controllers\Admin\Plan\PlanController::class, [
        'only' => ['index', 'show', 'update']
    ]);

    // Plan Features
    Route::post('features/sort', [\App\Http\Controllers\Admin\Plan\FeatureController::class, 'sort'])
        ->name('features.sort');
    Route::resource('features', \App\Http\Controllers\Admin\Plan\FeatureController::class, [
        'only' => ['index', 'show', 'update']
    ]);

    // Notifications
    Route::resource('notifications', \App\Http\Controllers\Admin\NotificationController::class);

    // Settings
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)
        ->only(['index', 'show', 'update']);

    // System Pages
    Route::resource('system-pages', \App\Http\Controllers\Admin\SystemPageController::class)
        ->only(['edit', 'update']);

    // System Mails
    Route::resource('system-mails', \App\Http\Controllers\Admin\SystemMailController::class)
        ->only(['edit', 'update']);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
        ->only(['index']);
    Route::post('users/{user}/subscribe', [\App\Http\Controllers\Admin\UserController::class, 'subscribe'])
        ->name('users.subscribe');
    Route::post('users/{user}/unsubscribe', [\App\Http\Controllers\Admin\UserController::class, 'unsubscribe'])
        ->name('users.unsubscribe');

});
