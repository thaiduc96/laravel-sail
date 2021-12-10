<?php

namespace App\Http\Controllers\Auth;

use App\Facades\AdminFacade;
use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Facades\AdminRepository;


class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = AuthHelper::getGuardApi(GUARD_ADMIN_API)->attempt($credentials)) {
            $user = AdminRepository::with('adminGroup')->find(AuthHelper::getUserApiId(GUARD_ADMIN_API));
            if($user->status != STATUS_ACTIVE){
                $this->failedResponse(trans('message.block_account'));
            }
            return $this->successResponse(AdminFacade::getAdminLogin(GUARD_ADMIN_API,$token));
        }
        $this->failedResponse(trans('message.wrong_username_or_password'));
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth(GUARD_ADMIN_API)->refresh();
        return $this->successResponse(AdminFacade::getAdminLogin(GUARD_ADMIN_API,$token));
    }
}
