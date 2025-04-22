<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CultureVesselController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public resources
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);

Route::get('/culture-vessels', [CultureVesselController::class, 'index']);
Route::get('/culture-vessels/{id}', [CultureVesselController::class, 'show']);

// Protected dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Add your protected dashboard routes here
    // Example:
    // Route::get('/dashboard/products', [ProductsController::class, 'dashboardIndex']);
});
