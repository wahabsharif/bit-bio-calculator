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


Route::resource('products', ProductsController::class)
    ->only(['index', 'show', 'store', 'edit', 'create', 'update', 'destroy']);


Route::get('/culture-vessels', [CultureVesselController::class, 'index']);
Route::get('/culture-vessels/{id}', [CultureVesselController::class, 'show']);

// Protected dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/products', [ProductsController::class, 'dashboardIndex'])
        ->name('dashboard.products');
});
