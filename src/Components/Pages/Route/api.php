<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Pages\Controllers\Api\PagesController;

// Route::group(['middleware' => 'auth:api'], function() {
    // Pages
    Route::get('pages', [PagesController::class,'index']); // done
    Route::get('pages/{id}', [PagesController::class,'show']); // done
    Route::get('fallBack', [PagesController::class,'fallBack']); // done
// });