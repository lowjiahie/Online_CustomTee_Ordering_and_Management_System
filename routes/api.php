<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\CustomTeeDesignController;

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

//CustomTeeDesignController
Route::post("saveDesign", [CustomTeeDesignController::class, 'saveDesign']);
Route::post("chkExstCusTeeDesign", [CustomTeeDesignController::class, 'chkExstCusTeeDesign']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //All secure URL's
    Route::post("logout", [CustomerController::class, 'logout']);

});
