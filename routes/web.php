<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([ 'middleware' => ['auth']], function () {
    Route::resource('categories', CategoryController::class);
    Route::POST('/image/delete_logo/{id}', [App\Http\Controllers\CategoryController::class, 'delete_logo'])->name('category.delete_logo');

    Route::resource('products', ProductController::class);
    Route::POST('/product/delete_image/{id}', [App\Http\Controllers\ProductController::class, 'delete_image'])->name('product.delete_image');
});
