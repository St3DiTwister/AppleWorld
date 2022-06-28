<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
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

Route::get('/categories', [HomeController::class, 'show_categories'])->name('categories');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [HomeController::class, 'index'])->name('profile');
    Route::get('/basket', [BasketController::class, 'show'])->name('basket');
    Route::get('/basketAdd/{id}', [BasketController::class, 'add'])->name('basketAdd');
    Route::get('/basketRemove/{id}', [BasketController::class, 'remove'])->name('basketRemove');
    Route::get('/basketDelete/{id}', [BasketController::class, 'delete'])->name('basketDelete');
    Route::get('/basket/place', [BasketController::class, 'place'])->name('basketPlace');
    Route::post('/basket/confirm', [BasketController::class, 'confirm'])->name('basketConfirm');
    Route::post('/like', [LikeController::class, 'like'])->name('like');
    Route::post('/unlike', [LikeController::class, 'unlike'])->name('unlike');
});
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category');
