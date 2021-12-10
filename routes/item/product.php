<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::group(["middleware" => ['auth:' . GUARD_ADMIN_API]], function () {
    Route::get("products/options", [ProductController::class, 'options'])->name(".products.options");
    Route::resource("products", ProductController::class, ["as" => ""]);
});
