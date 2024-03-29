<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'main'])->name('main');

Auth::routes();

Route::get('/categories', [Controller::class, 'show_categories'])->name('categories');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/basket', [BasketController::class, 'show'])->name('basket');
    Route::get('/basketAdd/{id}', [BasketController::class, 'add'])->name('basketAdd');
    Route::post('/basketAddPOST', [BasketController::class, 'addPOST'])->name('basketAddPOST');
    Route::get('/basketRemove/{id}', [BasketController::class, 'remove'])->name('basketRemove');
    Route::get('/basketDelete/{id}', [BasketController::class, 'delete'])->name('basketDelete');
    Route::get('/basket/place', [BasketController::class, 'place'])->name('basketPlace');
    Route::post('/basket/confirm', [BasketController::class, 'confirm'])->name('basketConfirm');
    Route::get('/like/{id}', [LikeController::class, 'like'])->name('like');
    Route::get('/unlike/{id}', [LikeController::class, 'unlike'])->name('unlike');
    Route::get('/favourites', [Controller::class, 'favourites'])->name('favourites');
    Route::post('/product/{slug}/reviewSend', [ProductController::class, 'reviewSend'])->name('reviewSend');
});
Route::get('/category/{slug}', [Controller::class, 'category'])->name('category');
Route::get('/product/{slug}', [ProductController::class, 'product'])->name('product');
