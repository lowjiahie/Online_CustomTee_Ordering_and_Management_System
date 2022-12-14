<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\customer\PrintingMethodController;
use App\Http\Controllers\Customer\CustomTeeDesignController;
use App\Http\Controllers\customer\PublishedDesignController;
use App\Http\Controllers\customer\PlainTeeTypeColorController;
use App\Http\Controllers\customer\CompetitionController;
use App\Http\Controllers\customer\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//CustomerController
Route::post("login", [CustomerController::class, 'login']);
Route::post("register", [CustomerController::class, 'register']);
Route::post("logout", [CustomerController::class, 'logout']);
Route::post("getAuthCusProfile", [CustomerController::class, 'getAuthCusProfile']);
Route::post("editAuthCusProfile", [CustomerController::class, 'editAuthCusProfile']);
Route::post("getAuthPaypalProfile", [CustomerController::class, 'getAuthPaypalProfile']);
Route::post("editAuthPaypalProfile", [CustomerController::class, 'editAuthPaypalProfile']);
Route::post("changePassword", [CustomerController::class, 'changePassword']);
Route::post("sendToken", [CustomerController::class, 'sendToken']);
Route::get("validateToken/{token}", [CustomerController::class, 'validateToken']);
Route::post("passwordRecovery", [CustomerController::class, 'passwordRecovery']);

//CustomTeeDesignController
Route::post("saveDesign", [CustomTeeDesignController::class, 'saveDesign']);
Route::post("chkExstCusTeeDesign", [CustomTeeDesignController::class, 'chkExstCusTeeDesign']);
Route::post("getPresetDesign", [CustomTeeDesignController::class, 'getPresetDesign']);
Route::post("deletePresetDesign", [CustomTeeDesignController::class, 'deletePresetDesign']);
Route::post("loadPresetDesign", [CustomTeeDesignController::class, 'loadPresetDesign']);
Route::get("getOnePresetDesign/{id}", [CustomTeeDesignController::class, 'getOnePresetDesign']);

//PlainTeeTypeColorController
Route::post("getPlainTeeTypeColor", [PlainTeeTypeColorController::class, 'getPlainTeeTypeColor']);
Route::post("checkStock", [PlainTeeTypeColorController::class, 'checkStock']);
Route::get("getAvailableSize/{id}", [PlainTeeTypeColorController::class, 'getAvailableSize']);

//PrintingMethodController
Route::post("getAvailablePrintingMethods", [PrintingMethodController::class, 'getAvailablePrintingMethods']);

//PublishedDesignController
Route::post("publishDesign", [PublishedDesignController::class, 'publishDesign']);
Route::post("getPublishDesignWithStatus", [PublishedDesignController::class, 'getPublishDesignWithStatus']);
Route::post("getPublishedDesignsOnSelling", [PublishedDesignController::class, 'getPublishedDesignsOnSelling']);
Route::post("getPublishedDesignsOnSharing", [PublishedDesignController::class, 'getPublishedDesignsOnSharing']);
Route::post("reportPublishedDesign", [PublishedDesignController::class, 'reportPublishedDesign']);
Route::post("saveToMyDesign", [PublishedDesignController::class, 'saveToMyDesign']);
Route::post("getSavedPurchasedDesigns", [PublishedDesignController::class, 'getSavedPurchasedDesigns']);


//OrderController
Route::post("checkOut", [OrderController::class, 'checkOut']);
Route::post("getOrderWithStatus", [OrderController::class, 'getOrderWithStatus']);
Route::post("cancelOrder", [OrderController::class, 'cancelOrder']);
Route::post("searchOrderByID", [OrderController::class, 'searchOrderByID']);
Route::get("getOrderDetails/{id}", [OrderController::class, 'getOrderDetails']);


// Competition
Route::post("getCurrentCompetition", [CompetitionController::class, 'getCurrentCompetition']);
Route::post("getMyCompetitionDesign", [CompetitionController::class, 'getMyCompetitionDesign']);
Route::post("getCompetitionList", [CompetitionController::class, 'getCompetitionList']);
Route::post("submitCompetition", [CompetitionController::class, 'submitCompetition']);
Route::post("withdrawCompetition", [CompetitionController::class, 'withdrawCompetition']);

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     //All secure URL's

// });
