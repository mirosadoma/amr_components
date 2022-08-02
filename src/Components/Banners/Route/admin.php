<?php

use Illuminate\Support\Facades\Route;
use App\Components\Banners\Controllers\Dashboard\BannersController;
use App\Components\Banners\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/banners')->name('banners.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Banners Area
Route::resource('banners', BannersController::class);
Route::get('banners/remove_image/{banner}', [BannersController::class, 'remove_image'])->name('banners.remove_image');
Route::get('banners/is_active/{leader}', [BannersController::class, 'is_active'])->name('banners.is_active');
