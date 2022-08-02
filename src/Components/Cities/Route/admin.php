<?php

use Illuminate\Support\Facades\Route;
use App\Components\Cities\Controllers\Dashboard\CitiesController;
use App\Components\Cities\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/cities')->name('cities.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Cities Area
Route::resource('cities', CitiesController::class);