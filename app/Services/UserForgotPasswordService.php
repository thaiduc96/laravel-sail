<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Facades\AdminFacade;
use App\Facades\UserFacade;
use App\Repositories\Facades\AdminRepository;
use App\Repositories\Facades\UserForgotPasswordRepository;
use App\Repositories\Facades\UserRepository;

class UserForgotPasswordService
{

    public function getVerifyCode($user, $type = SEND_EMAIL)
    {
        UserForgotPasswordRepository::deleteByCondition([
            'user_id' => $user->id
        ]);
        $random = mt_rand(100000, 999999);
        UserForgotPasswordRepository::create([
            'code' => $random,
            'target' => $type == SEND_EMAIL ? $user->email : $user->phone,
            'sending_method' => $type,
            'user_id' => $user->id
        ]);
        return $random;
    }
    public function verifyCode($email, $code, $guard = GUARD_USER_API){
        $code = UserForgotPasswordRepository::verifyCode($code, $email);
        if (empty($code)) {
            throw new CustomException(
                trans('message.forgot_password_otp_wrong')
            );
        }

        if($guard == GUARD_USER_API){
            $user = UserRepository::findOrFail($code->user_id);

            if (empty($user)) {
                throw new CustomException(
                    trans('message.user_not_found')
                );
            }
            $code->delete();

            $token = UserFacade::loginByUser($user);
            return UserFacade::getUserLogin($guard,$token);
        }elseif($guard == GUARD_ADMIN_API){
            $user = AdminRepository::findOrFail($code->user_id);

            if (empty($user)) {
                throw new CustomException(
                    trans('message.user_not_found')
                );
            }
            $code->delete();
            $token = AdminFacade::loginByUser($user);
            return AdminFacade::getUserLogin($guard,$token);
        }
        return null;
    }

}
