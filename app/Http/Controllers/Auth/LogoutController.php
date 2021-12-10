<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LogoutRequest;
use Illuminate\Support\Facades\Auth;


class LogoutController extends Controller
{
    public function logout(LogoutRequest $request)
    {
        try {
            DeviceTokenRepository::deleteByConditions($request->only('device_token', 'device_type'));
            AuthHelper::getGuardApi()->logout();
        } catch (\Exception $e) {
            throw $e;
        }
        return $this->successResponse(true);
    }

}
