<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PointSettingController;
use App\Http\Controllers\Admin\Journals\FinanceController;
use App\Http\Controllers\Admin\Journals\JournalController;
use App\Http\Controllers\Admin\Journals\KnowledgeController;
use App\Http\Controllers\Admin\Journals\LoaController;
use App\Http\Controllers\Admin\Journals\MybankController;
use App\Http\Controllers\Admin\Journals\PaymentController;
use App\Http\Controllers\Admin\Journals\PointController;
use App\Http\Controllers\Admin\Journals\ReportController;
use App\Http\Controllers\Admin\Setting\AuthorController;
use App\Http\Controllers\Admin\Setting\MenuController;
use App\Http\Controllers\Admin\Setting\MenuCategoriesController;
use App\Http\Controllers\Admin\Setting\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MetaController;
use App\Http\Controllers\WebsettingController;
use Illuminate\Support\Facades\Artisan;
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

    Route::prefix('loa')->group(function (){
        Route::resource('loa', LoaController::class);
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

        Route::resource('websetting', WebsettingController::class);
        Route::resource('points', PointController::class);

    });

    Route::resource('users', UserController::class)->middleware('role:super admin');
    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::resource('authors', AuthorController::class);

    Route::get('/naskah/delete/{id}', [PaymentController::class, 'naskahDelete']);

    Route::get('reports-invoice-download', [ReportController::class, 'invoiceDownload'])->name('reports.invoice-download');
    Route::get('reports-invoice-print', [ReportController::class, 'invoicePrint'])->name('reports.invoice-print');
    Route::get('reports-stock', [ReportController::class, 'stock'])->name('reports.stock');
    Route::get('reports-payment', [ReportController::class, 'payments'])->name('reports.payment');

    // finance
    Route::get('reports-finance', [FinanceController::class, 'index'])->name('reports.finance');
    Route::get('finance-detail', [FinanceController::class, 'detail'])->name('reports.finance-detail');
    Route::post('finance-speding-money', [FinanceController::class, 'spedingMoney'])->name('finance.speding-money');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/sitemap.xml', [MetaController::class, 'sitemap'])->name('sitemap');
Route::get('panduan-author', function() {
    return view('components.guide-author');
});
Route::get('panduan-pic', function() {
    return view('components.guide-pic');
});

//Clear route cache
Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache cleared';
});

// Clear cache using reoptimized class
Route::get('/optimize-clear', function() {
    Artisan::call('optimize:clear');
    return 'View cache cleared';
});



