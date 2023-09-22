<?php

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
        Route::get('/', [SiteController::class, 'index']);
    })->name('index.subdomain');
});

Route::get('/', [SiteController::class, 'index'])->name('index.base');

