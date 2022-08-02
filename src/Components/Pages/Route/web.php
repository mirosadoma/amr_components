<?php

use Illuminate\Support\Facades\Route;

use App\Components\Pages\Controllers\Site\PagesController;

Route::middleware('web')->group(function () {
    Route::get('pages/{page}', [PagesController::class, 'show'])->name('pages.show');
});