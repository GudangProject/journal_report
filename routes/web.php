<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\PointSettingController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\FilesCategoryController;
use App\Http\Controllers\Admin\IntegrationController;
use App\Http\Controllers\Admin\OfficeCategoryController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\PostLinkageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\Setting\AuthorController;
use App\Http\Controllers\Admin\Setting\MenuController;
use App\Http\Controllers\Admin\Setting\MenuCategoriesController;
use App\Http\Controllers\Admin\Setting\UserController;
use App\Http\Controllers\Admin\VideoCategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ScreenController;
use App\Http\Controllers\Client\ScreensController;
use App\Http\Controllers\Client\MetaController;

use Illuminate\Support\Facades\Route;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

require __DIR__.'/auth.php';

Route::get('/admin', function () {
    return redirect()->route('dashboards.index');
})->middleware(['auth'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function (){

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::prefix('dashboards')->group(function (){
        Route::resource('dashboards', DashboardController::class);
    });
    Route::prefix('posts')->group(function (){
        Route::resource('posts', PostController::class);
        Route::resource('postcategories', PostCategoryController::class);
        Route::resource('postlinkages', PostLinkageController::class);
    });
    Route::prefix('videos')->group(function (){
        Route::resource('videos', VideoController::class);
        Route::resource('videocategories', VideoCategoryController::class);
    });
    Route::prefix('pages')->group(function (){
        Route::resource('pages', PageController::class);
        Route::resource('pagecategories', PageCategoryController::class);
    });
    Route::prefix('images')->group(function (){
        Route::resource('images', ImageController::class);
        Route::resource('imagecategories', ImageCategoryController::class);
    });
    Route::prefix('offices')->group(function (){
        Route::resource('offices', OfficeController::class);
        Route::resource('officecategories', OfficeCategoryController::class);
    });
    Route::prefix('files')->group(function (){
        Route::resource('files', FilesController::class);
        Route::resource('filescategories', FilesCategoryController::class);
    });
    Route::prefix('services')->group(function (){
        Route::resource('services', ServiceController::class);
        Route::resource('servicecategories', ServiceCategoryController::class);
    });
    Route::prefix('integrations')->group(function (){
        Route::resource('integrations', IntegrationController::class);
    });
    Route::group(['middleware' => ['role:super admin']], function () {
        Route::prefix('points')->group(function (){
            Route::resource('points', PointController::class);
            Route::resource('settings', PointSettingController::class);
        });
        Route::prefix('menus')->group(function (){
            Route::resource('menus', MenuController::class);
            Route::resource('menuscategories', MenuCategoriesController::class);
        });
    });
    Route::resource('users', UserController::class)->middleware('role:super admin');
    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::resource('authors', AuthorController::class);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/sitemap.xml', [MetaController::class, 'sitemap'])->name('sitemap');

Route::get('search', [ScreensController::class, 'search'])->name('search');
Route::get('tags/{q}', [ScreensController::class, 'tags']);
Route::get('author/{slug}', [ScreenController::class, 'author']);

Route::get('page/{slug}', [ScreenController::class, 'page']);
Route::get('informasi', [ScreensController::class, 'files']);
Route::get('informasi/{slug}', [ScreenController::class, 'file']);
Route::get('layanan', [ScreensController::class, 'services']);
Route::get('kantor', [ScreensController::class, 'offices']);
Route::get('kantor/{slug}', [ScreenController::class, 'office']);
Route::get('arsip', [ScreensController::class, 'archives']);
Route::get('infografis', [ScreensController::class, 'infografis']);
Route::get('infografis/{slug}', [ScreenController::class, 'infografis']);
Route::get('podcasts', [ScreensController::class, 'podcasts']);
Route::get('video/{slug}', [ScreenController::class, 'video']);
Route::get('videos/{category?}', [ScreensController::class, 'videos']);
Route::get('pages/{category}', [ScreensController::class, 'pages']);

Route::get('berita/{category?}/{slug}', [ScreenController::class, 'redirect']);

Route::get('{category}', [ScreensController::class, 'posts']);
Route::get('{category?}/{slug}-{code}', [ScreenController::class, 'post'])->where('slug', '(.*)');
Route::get('{category}/sitemap.xml', [MetaController::class, 'sitemapDetail'])->name('sitemap-detail');





