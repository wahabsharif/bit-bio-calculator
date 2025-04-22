<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CultureVesselController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\Products;

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
        $products = Products::orderBy('created_at', 'desc')->get();
        return view('dashboard.index', compact('products'));
    })->name('dashboard');

    // Keep only one definition for /dashboard/products
    Route::get('/dashboard/products', [ProductsController::class, 'dashboardIndex'])
        ->name('dashboard.products');
});
