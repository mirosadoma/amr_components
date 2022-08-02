<?php

use Illuminate\Support\Facades\Route;
// Namespaces
use App\Components\Clients\Controllers\Api\ClientsController;
use App\Components\Clients\Controllers\Api\FavouratesController;
use App\Components\Clients\Controllers\Api\FollowersController;

Route::group(['middleware' => 'auth:api'], function() {
    // Profile
    Route::get('get_profile', [ClientsController::class,'get_profile']); // done
    Route::post('profile', [ClientsController::class,'profile']); // done
    Route::post('new_password',[ClientsController::class,'new_password']); // done
    // Reset Password
    Route::post('new_password',[ClientsController::class,'new_password']); // done
    // Wallet
    Route::get('get_wallet', [ClientsController::class,'get_wallet']); // done
    Route::post('recharge_wallet', [ClientsController::class,'recharge_wallet']); // done
    // Favourates
    Route::get('get_favourates', [FavouratesController::class,'get_favourates']); // done
    Route::post('favourates_action/{advertise}', [FavouratesController::class,'favourates_action']); // done
    // Followers
    Route::get('followers', [FollowersController::class,'followers']); // done
    Route::post('followers_action/{advertise}', [FollowersController::class,'followers_action']); // done
    // Rate
    Route::post('rate_provider/{user}', [ClientsController::class,'rate_provider']); // done
    // Sales And Purchases
    Route::get('get_sales_purchases', [ClientsController::class,'get_sales_purchases']); // done
});
// My Fatoora Payment
Route::get('wallet/{user}/payment/success', [ClientsController::class,'success']); // done
Route::get('wallet/{user}/payment/error', [ClientsController::class,'error']); // done