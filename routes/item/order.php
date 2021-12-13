<?php
use App\Http\Controllers\OrderController;
            use Illuminate\Support\Facades\Route;
            Route::group([ "middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
            Route::get("orders/options", [OrderController::class,"options"])->name(".orders.options");
            Route::apiResource("orders", OrderController::class, ["as" => ""]);
        });
