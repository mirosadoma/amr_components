<?php

use Illuminate\Support\Facades\Route;
use App\Components\Pages\Controllers\Dashboard\PagesController;
use App\Components\Pages\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/pages')->name('pages.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Pages Area
Route::resource('pages', PagesController::class);
Route::get('active_page/{page}', [PagesController::class, 'active'])->name('pages.active_page');
Route::get('pages/remove_image/{admin}', [PagesController::class, 'remove_image'])->name('pages.remove_image');