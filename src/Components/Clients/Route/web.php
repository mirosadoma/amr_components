<?php

use Illuminate\Support\Facades\Route;

use App\Components\Clients\Controllers\Site\ClientsController;

Route::middleware(['web','auth'])->group(function () {
    Route::get('profile', [ClientsController::class, 'profile_index'])->name('profile.index');
    Route::post('profile/update/{user}', [ClientsController::class, 'profile_update'])->name('profile.update');
    // Route::post('profile/update_image', [ClientsController::class, 'update_image'])->name('profile.update_image');
    Route::get('change_password', [ClientsController::class, 'change_password_index'])->name('change_password.index');
    Route::post('change_password/update/{user}', [ClientsController::class, 'change_password_update'])->name('change_password.update');
});