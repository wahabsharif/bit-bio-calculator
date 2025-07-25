<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CultureVesselController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CalculatorDownloadController;
use App\Models\Products;
use App\Models\CultureVessel;
use App\Http\Controllers\ClearCacheController;

// Public routes
Route::match(['GET', 'HEAD'], '/', function () {
    return view('home');
})->name('home');

Route::get('/clear', [ClearCacheController::class, 'clearAll']);

// Calculator download routes
Route::post('/calculator/download-excel', [CalculatorDownloadController::class, 'downloadExcel'])->name('calculator.download.excel');
Route::post('/calculator/download-pdf', [CalculatorDownloadController::class, 'downloadPdf'])->name('calculator.download.pdf');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('products', ProductsController::class)
    ->only(['index', 'show', 'store', 'edit', 'create', 'update', 'destroy']);

Route::resource('culture-vessels', CultureVesselController::class)
    ->only(['index', 'show', 'store', 'edit', 'create', 'update', 'destroy']);


// Protected dashboard routes
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        $products = Products::orderBy('created_at', 'desc')->get();
        $vessels  = CultureVessel::orderBy('created_at',  'desc')->get();

        return view('dashboard.index', compact('products', 'vessels'));
    })->name('index');

    Route::get('/products', [ProductsController::class, 'dashboardIndex'])
        ->name('products');

    Route::post('products/import', [ProductsController::class, 'import'])
        ->name('products.import');

    Route::get('products/export', [ProductsController::class, 'export'])
        ->name('products.export');

    Route::get('/culture-vessels', [CultureVesselController::class, 'dashboardIndex'])
        ->name('culture-vessels');

    Route::post('culture-vessels/import', [CultureVesselController::class, 'import'])
        ->name('culture-vessels.import');

    Route::get('culture-vessels/export', [CultureVesselController::class, 'export'])
        ->name('culture-vessels.export');

    // Add dashboard-specific resource routes
    Route::resource('dashboard-culture-vessels', CultureVesselController::class)
        ->parameters(['dashboard-culture-vessels' => 'culture_vessel'])
        ->except(['index']);
});
