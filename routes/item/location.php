<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::group(['prefix' =>'location'], function () {

    Route::get("provinces/options", [LocationController::class,'provinceOptions']);
    Route::get("districts/options",  [LocationController::class,'districtOptions']);
    Route::get("wards/options",  [LocationController::class,'wardOptions']);

    Route::get("provinces",  [LocationController::class,'province']);
    Route::get("districts",  [LocationController::class,'district']);
    Route::get("wards",  [LocationController::class,'ward']);
    Route::get("regions",  [LocationController::class,'region']);
});

