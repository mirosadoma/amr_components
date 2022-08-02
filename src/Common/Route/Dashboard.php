<?php
Route::middleware(['web', 'auth'])->prefix('/dashboard')->group(function () {
    Route::get('/', 'Amr\AmrComponents\Common\Controller\Dashboard\DashboardController@index')->name('dashboard.Dindex');
    Route::get('/profile', 'Amr\AmrComponents\Common\Controller\Dashboard\DashboardController@profile')->name('dashboard.DProfile.index');
    Route::post('/profile', 'Amr\AmrComponents\Common\Controller\Dashboard\DashboardController@profile')->name('dashboard.DProfile.update');
});
