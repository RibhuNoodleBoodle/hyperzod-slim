<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'show']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::delete('/cart/{product}', [CartController::class, 'destroy']);
});

// Merchants
Route::get('/merchants/nearby', [MerchantController::class, 'nearby']);

// Orders
Route::post('/order', [OrderController::class, 'store']);
Route::get('/order/{order}', [OrderController::class, 'show']);

// Homepage
Route::get('/', function () {
    return view('welcome');
});