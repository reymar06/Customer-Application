<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getCustomerInformation', [CustomerController::class, 'getCustomerInformation']);
Route::post('/addInformation', [CustomerController::class, 'addInformation']);
Route::post('/updateCustomerInformation', [CustomerController::class, 'updateCustomerInformation']);
Route::post('/deleteCustomerInfo', [CustomerController::class, 'deleteCustomerInfo']);



