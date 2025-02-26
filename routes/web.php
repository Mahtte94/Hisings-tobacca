<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index');

Route::get('/index', [ProductController::class, 'index'])
->name('index');

Route::get('/create', [ProductController::class, 'create'])
->name('create');

Route::post('/store', [ProductController::class, 'store'])
->name('store');

Route::get('/{id}', [ProductController::class, 'show'])
->name('show')
->where('id', '[0-9]+');


