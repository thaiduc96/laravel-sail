<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
Route::group(['prefix' => 'v1', 'middleware' => ['api']], function () {
    include_once('item/auth.php');
    include_once('item/location.php');
    Route::group([ 'middleware' => ['check.permission.admin' ]], function () {
        include_once('item/admin.php');
        include_once('item/admin_group.php');
        include_once('item/location.php');
        include_once('item/product.php');
        include_once('item/warehouse.php');
        include_once('item/customer.php');
        include_once('item/order.php');
        include_once('item/provider.php');
    });
});
