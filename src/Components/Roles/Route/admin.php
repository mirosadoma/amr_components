<?php

use Illuminate\Support\Facades\Route;
use App\Components\Roles\Controllers\Dashboard\RolesController;
use App\Components\Roles\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/roles')->name('roles.')->group(function () {
    Route::resource('locales', LocalesController::class);
});

// Roles Area
Route::resource('roles', RolesController::class);