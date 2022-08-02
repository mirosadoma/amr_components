<?php

use Illuminate\Support\Facades\Route;
use App\Components\Notifications\Controllers\Dashboard\NotificationsController;
use App\Components\Notifications\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/notifications')->name('notifications.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Notifications Area
Route::resource('notifications', NotificationsController::class);
Route::get('markallasread', [NotificationsController::class, 'markAllAsRead'])->name('markAllAsRead');
Route::get('deleteall', [NotificationsController::class, 'destroyAll'])->name('destroyAll');
Route::get('update_status/{id}', [NotificationsController::class, 'update_status'])->name('notifications.update_status');