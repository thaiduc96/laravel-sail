<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("inventories/options", [InventoryController::class, "options"])->name(".inventories.options");
    Route::apiResource("inventories", InventoryController::class, ["as" => ""]);
});

