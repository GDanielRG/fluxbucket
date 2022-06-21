<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth:sanctum')
    ->name('home');

Route::resource('products', ProductController::class)
    ->only(['show'])
    ->middleware('auth:sanctum');

Route::resource('orders', OrderController::class)
    ->only(['store'])
    ->middleware('auth:sanctum');
