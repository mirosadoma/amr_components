<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\ContactUs\Controllers\Api\ContactUsController;

Route::group(['middleware' => 'auth:api'], function() {
    // Contact Us
    Route::post('contact_us', [ContactUsController::class,'create']); // done
});