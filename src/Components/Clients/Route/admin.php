<?php

use Illuminate\Support\Facades\Route;
use App\Components\Clients\Controllers\Dashboard\ClientsController;
use App\Components\Clients\Controllers\Dashboard\LocalesController;

// Locales Area
Route::prefix('/clients')->name('clients.')->group(function () {
    Route::resource('locales', LocalesController::class);
});


// Clients Area
Route::resource('clients', ClientsController::class);
Route::get('clients/deleteForever/{admin}', [ClientsController::class, 'deleteForever'])->name('clients.deleteForever');
Route::get('clients/restore/{admin}', [ClientsController::class, 'restore'])->name('clients.restore');
Route::get('clients/is_active/{admin}', [ClientsController::class, 'is_active'])->name('clients.is_active');
Route::get('clients/remove_image/{admin}', [ClientsController::class, 'remove_image'])->name('clients.remove_image');
Route::get('clients/get_cities/{country}', [ClientsController::class, 'get_cities'])->name('clients.get_cities');
Route::get('clients/generat_string/{string}', [ClientsController::class, 'generat_string'])->name('clients.generat_string');