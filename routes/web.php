<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryContoller;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DeliveryZoneController;
use App\Http\Controllers\Admin\GoodsReceivingController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Public\CartController;
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
        Route::get('/', [SiteController::class, 'index'])->name('index');
        Route::get('/product-category/{id}', [SiteController::class, 'category'])->name('category');
        Route::get('/product/{id}', [SiteController::class, 'product'])->name('product');
//        Route::get('/', [SiteController::class, 'index'])->name('index.subdomain');
//        Route::get('/product/{name}', [SiteController::class, 'product'])->name('product.subdomain');
    });
});

Route::domain('risroll.test')->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('index');
    Route::get('/product-category/{id}', [SiteController::class, 'category'])->name('category');
    Route::get('/product/{id}', [SiteController::class, 'product'])->name('product');
    Route::get('/checkout', [SiteController::class, 'checkout'])->name('checkout');
    Route::get('/terms-of-use', [SiteController::class, 'terms'])->name('terms');
    Route::get('/privacy-policy', [SiteController::class, 'privacy'])->name('privacy');
    Route::get('/promotions', [SiteController::class, 'promotions'])->name('promotions');
    Route::get('/contacts', [SiteController::class, 'contacts'])->name('contacts');
    Route::get('/delivery', [SiteController::class, 'delivery'])->name('delivery');
    Route::post('/search', [SiteController::class, 'search'])->name('search');
    Route::get('/cart/create-order', [SiteController::class, 'createOrder'])->name('public.order.create');
    Route::post('/cart/add-product', [CartController::class, 'addProduct'])->name('cart.add');
    Route::post('/cart/change-quantity', [CartController::class, 'changeQuantity'])->name('cart.change-quantity');
    Route::post('/cart/remove-product', [CartController::class, 'removeProduct'])->name('cart.remove');
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
    Route::resource('order', OrderController::class);
    Route::post('fetch-data/{restaurantID}/{wid}/{cityId}', [AdminMainController::class, 'fetchData'])->name('fetch.mobidel.data');
    Route::post('category/update-order', [CategoryContoller::class, 'updateOrder']);
    Route::post('product/update-order', [ProductController::class, 'updateOrder']);
    Route::post('promotion/update-order', [PromotionController::class, 'updateOrder']);
});
