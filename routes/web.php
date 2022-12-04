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
    Route::get('/profile', 'App\Http\Controllers\StaffController@profile')->name('admin.profile');
    Route::get('/logout', 'App\Http\Controllers\StaffController@logout')->name('admin.logout');

    Route::view('/dashboard','admin.dashboard')->name('admin.dashboard');
    Route::get('/dashboardStaffInfo', 'App\Http\Controllers\StaffController@dashboardStaffInfo')->name('admin.dashboardStaffInfo');
    Route::post('/dashboardBack', 'App\Http\Controllers\StaffController@dashboardBack')->name('admin.dashboardBack');

    Route::get('/update','App\Http\Controllers\StaffController@getInfo')->name('admin.update');
    Route::view('/updateProfile','admin.updateProfile')->name('admin.updateProfile');
    Route::post('/updateProfile/submit','App\Http\Controllers\StaffController@updateProfile')->name('admin.updateProfileSubmit');

    Route::get('/change', 'App\Http\Controllers\StaffController@changePasswordInfo')->name('admin.change');
    Route::view('/changePassword','admin.changePassword')->name('admin.changePassword');
    Route::post('/changePassword/submit','App\Http\Controllers\StaffController@changePassword')->name('admin.changePasswordSubmit');

    Route::get('/add', 'App\Http\Controllers\StaffController@addAdminInfo')->name('admin.add');
    Route::view('/addAdmin', 'admin.addAdmin')->name('admin.addAdmin');
    Route::post('/addAdminSubmit', 'App\Http\Controllers\StaffController@addAdmin')->name('admin.addAdminSubmit');

    // Design
    Route::get('/designList','App\Http\Controllers\PublishedDesignController@designList')->name('admin.designList');
    Route::view('/design', 'admin.designList')->name('admin.design');
    Route::post('/designSearch','App\Http\Controllers\PublishedDesignController@designSearch')->name('admin.designSearch');

    Route::get('/designDetailInfo/{designID}', 'App\Http\Controllers\PublishedDesignController@designDetail')->name('admin.designDetailID');
    Route::view('/designDetail', 'admin.designDetail')->name('admin.designDetail');
    Route::post('/designDetailFunction', 'App\Http\Controllers\PublishedDesignController@designFunction')->name('admin.designDetailFunction');

    Route::view('/designUpdate', 'admin.designUpdate')->name('admin.designUpdate');
    Route::post('/designDetailUpdate', 'App\Http\Controllers\PublishedDesignController@designDetailUpdate')->name('admin.designDetailUpdate');


    // Order
    Route::view('/order','admin.order')->name('admin.order');

    // Plain-T


    // Printing Method
    Route::get('/printingMethodList', 'App\Http\Controllers\PrintingMethodController@printingMethodList')->name('admin.printingMethodList');
    Route::view('/printingMethod','admin.printingMethod')->name('admin.printingMethod');
    Route::post('/printingMethodSearch','App\Http\Controllers\PrintingMethodController@printingMethodSearch')->name('admin.printingMethodSearch');

    Route::get('/printingMethodAddPage', 'App\Http\Controllers\PrintingMethodController@printingMethodAddPage')->name('admin.printingMethodAddPage');
    Route::view('/printingMethodAdd', 'admin.printingMethodAdd')->name('admin.printingMethodAdd');
    Route::post('/printingMethodAddData', 'App\Http\Controllers\PrintingMethodController@printingMethodAddData')->name('admin.printingMethodAddData');

    Route::get('/printingMethodDetailInfo/{printingMethodID}', 'App\Http\Controllers\PrintingMethodController@printingMethodDetail')->name('admin.printingMethodDetailID');
    Route::view('/printingMethodDetail', 'admin.printingMethodDetail')->name('admin.printingMethodDetail');
    Route::post('/printingMethodDetailFunction', 'App\Http\Controllers\PrintingMethodController@printingMethodFunction')->name('admin.printingMethodDetailFunction');

    Route::view('/printingMethodUpdate', 'admin.printingMethodUpdate')->name('admin.printingMethodUpdate');
    Route::post('/printingMethodDetailUpdate', 'App\Http\Controllers\PrintingMethodController@printingMethodDetailUpdate')->name('admin.printingMethodDetailUpdate');

    // Competition

});
//End


//Start --- Below route will only use for SPA (frontend)
Route::get('/customer/{any?}', function () {
    return view('cusHome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');
//End
