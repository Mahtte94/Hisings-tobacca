<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('/auth/login');
});


Route::get('/dashboard', [ProductController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

Route::get('/categories/{category}', [ProductController::class, 'show'])
->name('category.show'); 




require __DIR__.'/auth.php';

