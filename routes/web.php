<?php

use Illuminate\Support\Facades\Route;

//Start --- This route is to navigate to general main page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//End

//Start - Admin routing (backend)
Route::prefix('/admin')->group(function() {
    // User Management
    Route::view('/login','admin.login')->name('admin.login');
    Route::post('/login/submit', 'App\Http\Controllers\StaffController@login')->name('admin.loginSubmit');
    Route::view('/passwordRecovery','admin.passwordRecovery')->name('admin.passwordRecovery');
    Route::get('/logout', 'App\Http\Controllers\StaffController@logout')->name('admin.logout');

    Route::view('/dashboard','admin.dashboard')->name('admin.dashboard');
    Route::get('/dashboardStaffInfo','App\Http\Controllers\StaffController@dashboardStaffInfo')->name('admin.dashboardStaffInfo');

    Route::get('/update','App\Http\Controllers\StaffController@getInfo')->name('admin.update');
    Route::view('/updateProfile','admin.updateProfile')->name('admin.updateProfile');
    Route::post('/updateProfile/submit','App\Http\Controllers\StaffController@updateProfile')->name('admin.updateProfileSubmit');

    Route::get('/change', 'App\Http\Controllers\StaffController@changePasswordInfo')->name('admin.change');
    Route::view('/changePassword','admin.changePassword')->name('admin.changePassword');
    Route::post('/changePassword/submit','App\Http\Controllers\StaffController@changePassword')->name('admin.changePasswordSubmit');

    // Order
    Route::view('/order','admin.order')->name('admin.order');

    // Plain-T


    // Printing Method
    Route::get('/printingMethodList', 'App\Http\Controllers\PrintingMethodController@printingMethodList')->name('admin.printingMethodList');
    Route::view('/printingMethod','admin.printingMethod')->name('admin.printingMethod');
    Route::post('/printingMethod/submit','App\Http\Controllers\PrintingMethod@printingMethod')->name('admin.printingMethodSubmit');

    //Route::get('/printingMethod/sorting/{sortingDecision}/{sort}','App\Http\Controllers\PrintingMethodController@sorting')->name('admin.printingMethodSorting');
});
//End


//Start --- Below route will only use for SPA (frontend)
Route::get('/customer/{any?}', function () {
    return view('cusHome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');
//End
