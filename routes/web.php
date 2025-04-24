<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CultureVesselController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Products;
use App\Models\CultureVessel;

// Public routes
// in routes/web.php
Route::view('/', 'home')->name('home');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('products', ProductsController::class)
    ->only(['index', 'show', 'store', 'edit', 'create', 'update', 'destroy']);

Route::resource('culture-vessels', CultureVesselController::class)
    ->only(['index', 'show', 'store', 'edit', 'create', 'update', 'destroy']);


// Protected dashboard routes
// Protected dashboard routes
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        $products = Products::orderBy('created_at', 'desc')->get();
        $vessels  = CultureVessel::orderBy('created_at',  'desc')->get();

        return view('dashboard.index', compact('products', 'vessels'));
    })->name('index');

    Route::get('/products', [ProductsController::class, 'dashboardIndex'])
        ->name('products');

    Route::get('/culture-vessels', [CultureVesselController::class, 'dashboardIndex'])
        ->name('culture-vessels');

    // Add dashboard-specific resource routes
    Route::resource('dashboard-culture-vessels', CultureVesselController::class)
        ->parameters(['dashboard-culture-vessels' => 'culture_vessel'])
        ->except(['index']);
});
