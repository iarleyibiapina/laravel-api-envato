<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// these routes are used to version 1 of your aplication. with this namespace   
// api/V1/customers 

// now using the sanctum middleware to api 
// and use in 'bearer token'
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    // save multiple invoices
    Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);
});

// Keys:
// admin
// g6jKDLVQSSrgDEetYJ9l1QO16uG82dSytKtRobNO1ff4c181
// update
// rQmkNXXkd1QTOoEIpHbffKNnY04yAfVD95isqmTt4ab3fba9
// basic
// dpIMUyncMrLjCL4P1kezMQ4xWo3gFAV5mSJCw8PT2b3756d2