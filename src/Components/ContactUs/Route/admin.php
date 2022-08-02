<?php

use Illuminate\Support\Facades\Route;
use App\Components\ContactUs\Controllers\Dashboard\ContactUsController;
use App\Components\ContactUs\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/contactus')->name('contactus.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// ContactUs Area
Route::resource('contactus', ContactUsController::class);