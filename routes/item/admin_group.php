<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminGroupController;
Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("admin-groups/options", [AdminGroupController::class,'options'])->name(".admin-groups.options");
    Route::resource("admin-groups", AdminGroupController::class, ["as" => ""]);
});
