<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryContoller;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DeliveryZoneController;
use App\Http\Controllers\Admin\GoodsReceivingController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Public\SiteController;
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



Route::domain('{subdomain}.risroll.test')->group(function () {
    Route::middleware('subdomain')->group(function () {
        Route::get('/', [SiteController::class, 'index'])->name('index.subdomain');
        Route::get('/product/{name}', [SiteController::class, 'product'])->name('product.subdomain');
    });
});

Route::domain('risroll.test')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index.base');
    Route::get('/product/{name}', [SiteController::class, 'product'])->name('product.base');
});

Route::prefix('administrator')->group(function() {
    Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    Route::resource('city', CityController::class);
    Route::resource('manager', ManagerController::class);
    Route::resource('pickup', PickupPointController::class);
    Route::resource('promotion', PromotionController::class);
    Route::resource('zone', DeliveryZoneController::class);
    Route::resource('receiving', GoodsReceivingController::class);
    Route::resource('index', IndexController::class);
    Route::resource('category', CategoryContoller::class);
    Route::resource('product', ProductController::class);
    Route::resource('image', ImageController::class);
    Route::post('fetch-data/{restaurantID}/{wid}/{cityId}', [AdminMainController::class, 'fetchData'])->name('fetch.mobidel.data');
});
