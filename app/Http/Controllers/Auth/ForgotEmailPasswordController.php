<?php

namespace App\Http\Controllers\Auth;

use App\Facades\UserForgotPasswordFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeForgotPasswordRequest;
use App\Http\Requests\Auth\VerifyCodeForgotPasswordByEmailRequest;
use App\Mail\ForgotPassword;
use App\Repositories\Facades\AdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotEmailPasswordController extends Controller
{

    public function sendCode(SendCodeForgotPasswordRequest $request)
    {
        $admin = AdminRepository::findByCondition($request->only('email'));
        DB::beginTransaction();
        try {
            $code = UserForgotPasswordFacade::getVerifyCode($admin);
            Mail::to($admin->email)->queue(new ForgotPassword(['code' => $code]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }


    public function verifyCode(VerifyCodeForgotPasswordByEmailRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = UserForgotPasswordFacade::verifyCode($request->email, $request->code);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse($data);
    }

}
