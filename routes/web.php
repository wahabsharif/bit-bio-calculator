<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellTypeController;
use App\Http\Controllers\CultureVesselController;



Route::get('/', function () {
    return view('home');
});

Route::get('/cell-types', [CellTypeController::class, 'index']);
Route::get('/cell-types/{id}', [CellTypeController::class, 'show']);



Route::get('/culture-vessels', [CultureVesselController::class, 'index']);
Route::get('/culture-vessels/{id}', [CultureVesselController::class, 'show']);
