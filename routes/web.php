<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellTypeController;
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
Route::get('/cell-types', [CellTypeController::class, 'index']);
Route::get('/cell-types/{id}', [CellTypeController::class, 'show']);

Route::get('/culture-vessels', [CultureVesselController::class, 'index']);
Route::get('/culture-vessels/{id}', [CultureVesselController::class, 'show']);

// Protected dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // Add your protected dashboard routes here
    // Example:
    // Route::get('/dashboard/cell-types', [CellTypeController::class, 'dashboardIndex']);
});
