<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Notifications\Controllers\Api\NotificationsController;

Route::group(['middleware' => 'auth:api'], function() {
    // Notifications
    Route::get('notifications', [NotificationsController::class,'notifications']); // done
    Route::get('check_notifications', [NotificationsController::class,'check_notifications']); // done
    Route::post('notifications/{id}/delete', [NotificationsController::class,'deleteNotifications']); // done
});