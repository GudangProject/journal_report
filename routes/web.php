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
use App\Http\Controllers\Admin\Journals\JournalController;
use App\Http\Controllers\Admin\Journals\KnowledgeController;
use App\Http\Controllers\Admin\Journals\MybankController;
use App\Http\Controllers\Admin\Journals\PaymentController;
use App\Http\Controllers\Admin\Journals\ReportController;
use App\Http\Controllers\Admin\OfficeCategoryController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\OfficersController;
use App\Http\Controllers\Admin\PhotoContentController;
use App\Http\Controllers\Admin\PhotosController;
use App\Http\Controllers\Admin\PostLinkageController;
use App\Http\Controllers\Admin\PtspController;
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
use App\Models\Journals\Journal;
use Illuminate\Support\Facades\Route;

if(version_compare(PHP_VERSION, '8.1.0', '>=')) {
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

    Route::prefix('journals')->group(function (){
        Route::resource('journals', JournalController::class);
    });

    Route::prefix('knowledge')->group(function (){
        Route::resource('knowledge', KnowledgeController::class);
    });

    Route::prefix('payment')->group(function (){
        Route::resource('payment', PaymentController::class);
        Route::resource('mybank', MybankController::class);
        Route::get('invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');
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

    Route::get('/naskah/delete/{id}', [PaymentController::class, 'naskahDelete']);

    Route::get('reports-invoice-download', [ReportController::class, 'invoiceDownload'])->name('reports.invoice-download');
    Route::get('reports-stock', [ReportController::class, 'stock'])->name('reports.stock');
    Route::get('reports-payment', [ReportController::class, 'payment'])->name('reports.payment');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/sitemap.xml', [MetaController::class, 'sitemap'])->name('sitemap');




