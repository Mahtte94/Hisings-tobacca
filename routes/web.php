<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])
    ->name('index');

Route::get('dashboard', DashboardController::class)->middleware('auth');

Route::post('login', LoginController::class)->middleware('guest');

Route::get('/create', [ProductController::class, 'create'])
    ->name('create');

Route::post('/store', [ProductController::class, 'store'])
    ->name('store');

Route::get('/{id}', [ProductController::class, 'show'])
    ->name('show')
    ->where('id', '[0-9]+');

Route::get('/{product}/edit', [ProductController::class, 'edit'])
    ->name('edit');

Route::patch('{product}', [ProductController::class, 'update'])
    ->name('update');

Route::delete('{product}', [ProductController::class, 'destroy'])
    ->name('destroy');

Route::get('/search-products', [ProductController::class, 'search'])
    ->name('search');
