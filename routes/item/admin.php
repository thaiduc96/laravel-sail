<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("admins/options", [AdminController::class,'options'])->name(".admins.options");
    Route::apiResource("admins", AdminController::class, ["as" => ""]);
});
