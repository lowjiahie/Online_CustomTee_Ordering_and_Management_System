<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomTeeDesignController;
use App\Http\Controllers\customer\PublishedDesignController;
use App\Http\Controllers\customer\PlainTeeTypeColorController;

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

//CustomTeeDesignController
Route::post("saveDesign", [CustomTeeDesignController::class, 'saveDesign']);
Route::post("chkExstCusTeeDesign", [CustomTeeDesignController::class, 'chkExstCusTeeDesign']);
Route::post("getPresetDesign", [CustomTeeDesignController::class, 'getPresetDesign']);
Route::post("deletePresetDesign", [CustomTeeDesignController::class, 'deletePresetDesign']);
Route::post("loadPresetDesign", [CustomTeeDesignController::class, 'loadPresetDesign']);

//PlainTeeTypeColorController
Route::post("getPlainTeeTypeColor", [PlainTeeTypeColorController::class, 'getPlainTeeTypeColor']);


//PublishedDesignController
Route::post("publishDesign", [PublishedDesignController::class, 'publishDesign']);
Route::post("getPublishDesignWithStatus", [PublishedDesignController::class, 'getPublishDesignWithStatus']);
Route::post("getPublishedDesignsOnSelling", [PublishedDesignController::class, 'getPublishedDesignsOnSelling']);
Route::post("getPublishedDesignsOnSharing", [PublishedDesignController::class, 'getPublishedDesignsOnSharing']);
Route::post("reportPublishedDesign", [PublishedDesignController::class, 'reportPublishedDesign']);
Route::post("saveToMyDesign", [PublishedDesignController::class, 'saveToMyDesign']);
Route::post("getSavedPurchasedDesigns", [PublishedDesignController::class, 'getSavedPurchasedDesigns']);


// Route::group(['middleware' => 'auth:sanctum'], function () {
//     //All secure URL's

// });
