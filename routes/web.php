<?php

use Illuminate\Support\Facades\Route;

//Start --- This route is to navigate to general main page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//End

//Start - Admin routing (backend)
Route::prefix('/admin')->group(function() {
    Route::view('/login','admin.login')->name('admin.login');
    Route::view('/passwordRecovery','admin.passwordRecovery')->name('admin.passwordRecovery');
    Route::view('/dashboard','admin.dashboard')->name('admin.dashboard');
    Route::view('/order','admin.order')->name('admin.order');
});
//End


//Start --- Below route will only use for SPA (frontend)
Route::get('/customer/{any?}', function () {
    return view('cusHome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');
//End
