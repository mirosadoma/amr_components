<?php

use Illuminate\Support\Facades\Route;
use App\Components\Locales\Controllers\Dashboard\LocalesController;

// Locales Area
Route::resource('locales', LocalesController::class);
