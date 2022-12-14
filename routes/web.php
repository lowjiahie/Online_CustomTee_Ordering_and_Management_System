<?php

use Illuminate\Support\Facades\Route;

//Start --- This route is to navigate to general main page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//End

//Start - Admin routing (backend)
Route::prefix('/admin')->group(function() {
    /* User Management */
    Route::view('/login','admin.login')->name('admin.login');
    Route::post('/login/submit', 'App\Http\Controllers\StaffController@login')->name('admin.loginSubmit');

    Route::view('/forgotPassword','admin.forgotPassword')->name('admin.forgotPassword');
    Route::post('/forgotPasswordSubmit','App\Http\Controllers\StaffController@forgotPassword')->name('admin.forgotPasswordSubmit');

    Route::view('/tokenDisplay','admin.tokenDisplay')->name('admin.tokenDisplay');

    Route::view('/passwordRecovery','admin.passwordRecovery')->name('admin.passwordRecovery');
    Route::post('/passwordRecoverySubmit','App\Http\Controllers\StaffController@passwordRecovery')->name('admin.passwordRecoverySubmit');

    Route::view('/passwordRecoveryForm','admin.passwordRecoveryForm')->name('admin.passwordRecoveryForm');
    Route::post('/passwordRecoveryFormSubmit','App\Http\Controllers\StaffController@passwordRecoverySubmit')->name('admin.passwordRecoveryFormSubmit');

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

    /* Design */
    Route::get('/designList','App\Http\Controllers\PublishedDesignController@designList')->name('admin.designList');
    Route::view('/design', 'admin.designList')->name('admin.design');
    Route::post('/designSearch','App\Http\Controllers\PublishedDesignController@designSearch')->name('admin.designSearch');

    Route::get('/designDetailInfo/{designID}', 'App\Http\Controllers\PublishedDesignController@designDetail')->name('admin.designDetailID');
    Route::view('/designDetail', 'admin.designDetail')->name('admin.designDetail');
    Route::post('/designDetailFunction', 'App\Http\Controllers\PublishedDesignController@designFunction')->name('admin.designDetailFunction');

    Route::view('/designUpdate', 'admin.designUpdate')->name('admin.designUpdate');
    Route::post('/designDetailUpdate', 'App\Http\Controllers\PublishedDesignController@designDetailUpdate')->name('admin.designDetailUpdate');

    Route::get('/designReportList', 'App\Http\Controllers\PublishedDesignController@designReportList')->name('admin.designReportList');
    Route::view('/designReport', 'admin.designReportList')->name('admin.designReport');
    Route::post('/designReportSearch','App\Http\Controllers\PublishedDesignController@designReportSearch')->name('admin.designReportSearch');

    Route::get('/designReportDetailInfo/{designID}', 'App\Http\Controllers\PublishedDesignController@designReportDetail')->name('admin.designReportDetailID');
    Route::view('/designReportDetail', 'admin.designReportDetail')->name('admin.designReportDetail');
    Route::post('/designReportDetailFunction', 'App\Http\Controllers\PublishedDesignController@designReportFunction')->name('admin.designReportDetailFunction');

    /* Order */
    Route::get('/orderList','App\Http\Controllers\OrderController@orderList')->name('admin.orderList');
    Route::view('/order','admin.order')->name('admin.order');
    Route::post('/orderSearch','App\Http\Controllers\OrderController@orderSearch')->name('admin.orderSearch');

    Route::get('/orderDetailInfo/{order_id}', 'App\Http\Controllers\OrderController@orderDetail')->name('admin.orderDetailID');
    Route::view('/orderDetail', 'admin.orderDetail')->name('admin.orderDetail');
    Route::post('/orderDetailFunction', 'App\Http\Controllers\OrderController@orderFunction')->name('admin.orderDetailFunction');


    /* Plain Tee */
    Route::get('/plainTeeColorList', 'App\Http\Controllers\PlainTeeTypeColorController@colorList')->name('admin.plainTeeColorList');
    Route::view('/plainTeeColor','plainTeeColorList')->name('admin.plainTeeColor');
    Route::post('/plainTeeColorSearch','App\Http\Controllers\PlainTeeTypeColorController@colorSearch')->name('admin.plainTeeColorSearch');

    Route::get('/plainTeeTypeList', 'App\Http\Controllers\PlainTeeTypeColorController@typeList')->name('admin.plainTeeTypeList');
    Route::view('/plainTeeType', 'plainTeeType')->name('admin.plainTeeType');
    Route::post('/plainTeeTypeSearch','App\Http\Controllers\PlainTeeTypeColorController@typeSearch')->name('admin.plainTeeTypeSearch');


    Route::get('/plainTeeAddColorPage', 'App\Http\Controllers\PlainTeeTypeColorController@addColor')->name('admin.plainTeeAddColorPage');
    Route::view('/plainTeeAddColor', 'plainTeeAddColor')->name('admin.plainTeeAddColor');
    Route::post('/plainTeeAddColorSubmit', 'App\Http\Controllers\PlainTeeTypeColorController@addColorSubmit')->name('admin.plainTeeAddColorSubmit');

    Route::get('/plainTeeColorDetailInfo/{colorID}', 'App\Http\Controllers\PlainTeeTypeColorController@colorDetail')->name('admin.plainTeeColorDetailID');
    Route::view('/plainTeeColorDetail', 'admin.plainTeeColorDetail')->name('admin.plainTeeColorDetail');
    Route::post('/plainTeeColorDetailFunction', 'App\Http\Controllers\PlainTeeTypeColorController@colorFunction')->name('admin.plainTeeColorDetailFunction');

    Route::view('/plainTeeColorUpdate', 'admin.plainTeeColorUpdate')->name('admin.plainTeeColorUpdate');
    Route::post('/plainTeeColorDetailUpdate', 'App\Http\Controllers\PlainTeeTypeColorController@colorDetailUpdate')->name('admin.plainTeeColorDetailUpdate');


    Route::get('/plainTeeAddTypePage', 'App\Http\Controllers\PlainTeeTypeColorController@addType')->name('admin.plainTeeAddTypePage');
    Route::view('/plainTeeAddType', 'plainTeeAddType')->name('admin.plainTeeAddType');
    Route::post('/plainTeeAddTypeSubmit','App\Http\Controllers\PlainTeeTypeColorController@addTypeSubmit')->name('admin.plainTeeAddTypeSubmit');

    Route::get('/plainTeeTypeDetailInfo/{typeID}', 'App\Http\Controllers\PlainTeeTypeColorController@typeDetail')->name('admin.plainTeetypeDetailID');
    Route::view('/plainTeeTypeDetail', 'admin.plainTeeTypeDetail')->name('admin.plainTeeTypeDetail');
    Route::post('/plainTeeTypeDetailFunction', 'App\Http\Controllers\PlainTeeTypeColorController@typeFunction')->name('admin.plainTeeTypeDetailFunction');

    Route::view('/plainTeeTypeUpdate', 'admin.plainTeeTypeUpdate')->name('admin.plainTeeTypeUpdate');
    Route::post('/plainTeeTypeDetailUpdate', 'App\Http\Controllers\PlainTeeTypeColorController@typeDetailUpdate')->name('admin.plainTeeTypeDetailUpdate');


    Route::get('/plainTeeAddTypeColorPage', 'App\Http\Controllers\PlainTeeTypeColorController@addTypeColor')->name('admin.plainTeeAddTypeColorPage');
    Route::view('/plainTeeAddTypeColor', 'plainTeeAddTypeColor')->name('admin.plainTeeAddTypeColor');
    Route::post('/plainTeeAddTypeColorSubmit','App\Http\Controllers\PlainTeeTypeColorController@addTypeColorSubmit')->name('admin.plainTeeAddTypeColorSubmit');

    Route::get('/plainTeeTypeColorList', 'App\Http\Controllers\PlainTeeTypeColorController@typeColorList')->name('admin.plainTeeTypeColorList');
    Route::view('/plainTeeTypeColorListView','plainTeeTypeColorListView')->name('admin.plainTeeTypeColorListView');
    Route::post('/plainTeeTypeColorSearch','App\Http\Controllers\PlainTeeTypeColorController@typeColorSearch')->name('admin.plainTeeTypeColorSearch');

    Route::get('/plainTeeTypeColorDetailInfo/{pt_type_color_id}', 'App\Http\Controllers\PlainTeeTypeColorController@typeColorDetail')->name('admin.plainTeeTypeColorDetailID');
    Route::view('/plainTeeTypeColorDetail', 'admin.plainTeeTypeColorDetail')->name('admin.plainTeeTypeColorDetail');
    Route::post('/plainTeeTypeColorDetailFunction', 'App\Http\Controllers\PlainTeeTypeColorController@typeColorFunction')->name('admin.plainTeeTypeColorDetailFunction');

    Route::view('/plainTeeTypeColorUpdate', 'admin.plainTeeTypeColorUpdate')->name('admin.plainTeeTypeColorUpdate');
    Route::post('/plainTeeTypeColorDetailUpdate', 'App\Http\Controllers\PlainTeeTypeColorController@typeColorDetailUpdate')->name('admin.plainTeeTypeColorDetailUpdate');


    Route::get('/plainTeeAddShirt', 'App\Http\Controllers\PlainTeeTypeColorController@addShirt')->name('admin.plainTeeAddShirt');
    Route::view('/plainTeeAddAdd', 'plainTeeAddShirt')->name('admin.plainTeeAdd');
    Route::post('/plainTeeAddSubmit','App\Http\Controllers\PlainTeeTypeColorController@addShirtSubmit')->name('admin.plainTeeAddSubmit');

    Route::get('/plainTeeList', 'App\Http\Controllers\PlainTeeTypeColorController@plainTeeList')->name('admin.plainTeeList');
    Route::view('/plainTeeListView','plainTeeListView')->name('admin.plainTeeListView');
    Route::post('/plainTeeSizeSearch','App\Http\Controllers\PlainTeeTypeColorController@sizeSearch')->name('admin.plainTeeSizeSearch');

    Route::get('/plainTeeDetailInfo/{plain_tee_size_id}', 'App\Http\Controllers\PlainTeeTypeColorController@plainTeeDetail')->name('admin.plainTeeDetailID');
    Route::view('/plainTeeDetail', 'admin.plainTeeDetail')->name('admin.plainTeeDetail');
    Route::post('/plainTeeDetailFunction', 'App\Http\Controllers\PlainTeeTypeColorController@plainTeeFunction')->name('admin.plainTeeDetailFunction');

    Route::view('/plainTeeUpdate', 'admin.plainTeeUpdate')->name('admin.plainTeeUpdate');
    Route::post('/plainTeeDetailUpdate', 'App\Http\Controllers\PlainTeeTypeColorController@plainTeeDetailUpdate')->name('admin.plainTeeDetailUpdate');


    /* Printing Method */
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

    /* Competition */
    Route::get('/competitionList', 'App\Http\Controllers\CompetitionController@competitionList')->name('admin.competitionList');
    Route::view('/competition','competitionList')->name('admin.competition');
    Route::post('/competitionSearch','App\Http\Controllers\CompetitionController@competitionSearch')->name('admin.competitionSearch');

    Route::get('/competitionAddPage', 'App\Http\Controllers\CompetitionController@competitionAddPage')->name('admin.competitionAddPage');
    Route::view('/competitionAdd', 'admin.competitionAdd')->name('admin.competitionAdd');
    Route::post('/competitionAddSubmit', 'App\Http\Controllers\CompetitionController@competitionAddSubmit')->name('admin.competitionAddSubmit');

    Route::get('/competitionDetailInfo/{competition_id}', 'App\Http\Controllers\CompetitionController@competitionDetail')->name('admin.competitionDetailID');
    Route::view('/competitionDetail', 'admin.competitionDetail')->name('admin.competitionDetail');
    Route::post('/competitionDetailFunction', 'App\Http\Controllers\CompetitionController@competitionFunction')->name('admin.competitionDetailFunction');

    Route::get('/participantList', 'App\Http\Controllers\CompetitionController@participantList')->name('admin.participantList');
    Route::view('/participant','participantList')->name('admin.participant');
    Route::post('/participantSearch','App\Http\Controllers\CompetitionController@participantSearch')->name('admin.participantSearch');

    Route::post('/competitionParticipantFunction', 'App\Http\Controllers\CompetitionController@participantFunction')->name('admin.participantFunction');
    Route::view('/competitionUpdate', 'admin.competitionUpdate')->name('admin.competitionUpdate');
    Route::post('/competitionDetailUpdate', 'App\Http\Controllers\CompetitionController@competitionDetailUpdate')->name('admin.competitionDetailUpdate');
    Route::post('/competitionAnnounceWinner', 'App\Http\Controllers\CompetitionController@competitionAnnounceWinner')->name('admin.competitionAnnounceWinner');
});
//End


//Start --- Below route will only use for SPA (frontend)
Route::get('/customer/{any?}', function () {
    return view('cusHome');
})->where('any', '^(?!api\/)[\/\w\.\,-]*');
//End
