<?php

use Illuminate\Support\Facades\Route;

//Start --- This route is to navigate to general main page 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//End

//Start - Admin routing (backend)
Route::prefix('/admin')->group(function() {
    Route::view('/','admin.dashboard')->name('admin.dashboard');
});
//End


//Start --- Below route will only use for SPA (frontend)
Route::get('/customer/{any?}', function () {
    return view('cusHome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');
//End