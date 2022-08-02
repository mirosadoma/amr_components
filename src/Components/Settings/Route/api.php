<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Settings\Controllers\Api\SettingsController;

Route::get('contact_us', [SettingsController::class,'contact_us']); // done
Route::get('settings_contact', [SettingsController::class,'settings_contact']); // done
Route::get('settings_mobile_links', [SettingsController::class,'settings_mobile_links']); // done