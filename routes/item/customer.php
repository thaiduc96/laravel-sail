<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("customers/options", [CustomerController::class, "options"])->name(".customers.options");
    Route::apiResource("customers", CustomerController::class, ["as" => ""]);
});

