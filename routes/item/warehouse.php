<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("warehouses/options", [WarehouseController::class, 'options'])->name(".warehouses.options");
    Route::resource("warehouses", WarehouseController::class, ["as" => ""]);
});
