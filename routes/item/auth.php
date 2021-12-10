<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotEmailPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LogoutController;

Route::group(['prefix' =>'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', [LoginController::class,'login']);
    Route::post('register', [RegisterController::class,'register']);

//    Route::patch('register-verify', 'RegisterController@verifyCode');
//    Route::post('register-verify-resend', 'RegisterController@resendCode');
//
    Route::post('forgot-password', [ForgotEmailPasswordController::class,'sendCode']);
    Route::post('verify-forgot-password', [ForgotEmailPasswordController::class,'verifyCode']);

    Route::post('refresh', [LoginController::class,'refresh']);

    Route::group([ 'middleware' => ['auth:'. GUARD_ADMIN_API ]], function () {
        Route::post('logout',  [LogoutController::class,'logout'] );
        Route::patch('change-password',  [ChangePasswordController::class,'changePassword'] );
//        Route::patch('password/reset', 'ForgotEmailPasswordController@changePassword');
//
    });
});



