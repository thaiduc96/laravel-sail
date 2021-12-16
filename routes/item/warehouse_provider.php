<?php

use App\Http\Controllers\WarehouseProviderController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("warehouse-providers/options", [WarehouseProviderController::class, "options"])->name(".warehouse-providers.options");
    Route::apiResource("warehouse-providers", WarehouseProviderController::class, ["as" => ""]);
});

