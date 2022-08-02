<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Cities\Controllers\Api\CitiesController;

// Cities
Route::get('cities', [CitiesController::class,'cities']); // done