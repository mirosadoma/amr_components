<?php

use Illuminate\Support\Facades\Route;
use App\Components\Admins\Controllers\Dashboard\AdminsController;
use App\Components\Admins\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/admins')->name('admins.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Admins Area
Route::resource('admins', AdminsController::class);
Route::get('admins/deleteForever/{admin}', [AdminsController::class, 'deleteForever'])->name('admins.deleteForever');
Route::get('admins/restore/{admin}', [AdminsController::class, 'restore'])->name('admins.restore');
Route::get('admins/is_active/{admin}', [AdminsController::class, 'is_active'])->name('admins.is_active');
Route::get('admins/remove_image/{admin}', [AdminsController::class, 'remove_image'])->name('admins.remove_image');
Route::post('admins/update_dark_position', [AdminsController::class, 'update_dark_position'])->name('admins.update_dark_position'); // Done

