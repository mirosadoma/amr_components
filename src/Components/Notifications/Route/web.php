<?php

use Illuminate\Support\Facades\Route;

use App\Components\Notifications\Controllers\Site\NotificationsController;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('notifications', [NotificationsController::class, 'notifications'])->name('notifications');
});
