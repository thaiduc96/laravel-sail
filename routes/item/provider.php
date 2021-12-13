<?php

use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("providers/options", [ProviderController::class, "options"])->name(".providers.options");
    Route::apiResource("providers", ProviderController::class, ["as" => ""]);
});
