<?php

use Illuminate\Support\Facades\Route;
use App\Components\Settings\Controllers\Dashboard\SettingsController;
use App\Components\Settings\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/settings')->name('settings.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Settings Area
Route::get('settings/config', [SettingsController::class, 'config'])->name('settings.config');
Route::get('settings/social', [SettingsController::class, 'social'])->name('settings.social');
Route::get('settings/maintenance', [SettingsController::class, 'maintenance'])->name('settings.maintenance');
Route::post('settings/update/{type}', [SettingsController::class, 'update'])->name('settings.update');
Route::get('settings/remove_logo/{setting}', [SettingsController::class, 'remove_logo'])->name('settings.remove_logo');
Route::get('settings/remove_footer_logo/{setting}', [SettingsController::class, 'remove_footer_logo'])->name('settings.remove_footer_logo');
Route::post('settings/update_dark_position', [SettingsController::class, 'update_dark_position'])->name('settings.update_dark_position');
// Route::post('settings/main_search', [SettingsController::class, 'main_search'])->name('settings.main_search');
