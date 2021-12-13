<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminGroupController;
Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("admin-groups/options", [AdminGroupController::class,'options'])->name(".admin-groups.options");
    Route::match(['GET','PUT'],"admin-groups/{group_id}/permission",  [AdminGroupController::class,'permission'] )->name("AdminApi.admin-groups.permission");
    Route::resource("admin-groups", AdminGroupController::class, ["as" => ""]);
});
