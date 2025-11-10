<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Customer\OngkirController;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Routes
Route::get('/', [CustomerProductController::class, 'index'])->name('home');
Route::get('/catalog', [CustomerProductController::class, 'catalog'])->name('product.catalog');
Route::get('/product/{id}', [CustomerProductController::class, 'show'])->name('product.show');

Route::get('/ongkos-kirim', [OngkirController::class, 'index'])->name('ongkos.kirim');
Route::post('/ongkos-kirim', [OngkirController::class, 'calculate'])->name('ongkos.kirim.calculate');

Route::view('about-us', 'customer.about-us')->name('about.us');

Route::post('/pesan-via-whatsapp', [OrderController::class, 'send'])->name('order.send');

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/product', [AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/{product}', [AdminProductController::class, 'show'])->name('admin.product.show');
    Route::get('/product/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/product/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

    Route::get('/product/autocomplete', [AdminProductController::class, 'autocomplete'])->name('admin.product.autocomplete');
});