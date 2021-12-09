<?php

namespace App\Modules\AdminApi\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Modules\Api\Http\Requests\Auth\LogoutRequest;
use App\Repositories\Facades\DeviceTokenRepository;
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
