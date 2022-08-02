<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Banners\Controllers\Api\BannersController;

// Banners
Route::get('banners', [BannersController::class,'banners']); // done
