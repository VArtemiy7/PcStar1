<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\MainHomeController::class, 'welcome'])->name('welcome');

Route::get('/catalog', [App\Http\Controllers\MainHomeController::class, 'catalog'])->name('catalog');
Route::get('/about', [App\Http\Controllers\MainHomeController::class, 'about'])->name('about');
Route::get('/where', [App\Http\Controllers\MainHomeController::class, 'where'])->name('where');
Route::get('/product/{id}', [App\Http\Controllers\MainHomeController::class, 'product'])->name('product');

Route::get('/panel', [App\Http\Controllers\MainHomeController::class, 'panel'])->name('panel');

Route::post('/del-product', [App\Http\Controllers\MainHomeController::class, 'del'])->name('del');
Route::post('/add-product', [App\Http\Controllers\MainHomeController::class, 'add'])->name('add');
Route::post('/red-product', [App\Http\Controllers\MainHomeController::class, 'redact'])->name('redact');

Route::post('/add_img', [App\Http\Controllers\MainHomeController::class, 'add_img'])->name('add_img');


Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
Route::post('/add_cart', [App\Http\Controllers\CartController::class, 'add_cart'])->name('add_cart');
Route::post('/delete_cart', [App\Http\Controllers\CartController::class, 'delete_cart'])->name('delete_cart');

Route::get('/order/add', [App\Http\Controllers\CartController::class, 'add_order'])->name('add_order');
Route::get('/order', [App\Http\Controllers\CartController::class, 'order'])->name('order');
