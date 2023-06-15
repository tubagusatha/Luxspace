<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', [frontendController::class, 'index'])->name('index');
Route::get('/details/{slug}', [frontendController::class, 'details'])->name('details');
Route::get('/cart', [frontendController::class, 'cart'])->name('cart');
Route::get('/success', [frontendController::class, 'success'])->name('checkot-success');




Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified', 'IsAdmin'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    
    Route::resource('product', ProductController::class);
    Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only(['index', 'create', 'store', 'destroy']);
    Route::resource('transaction', TransactionController::class);
    Route::resource('user', UserController::class);
}) ;


