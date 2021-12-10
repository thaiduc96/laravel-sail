<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Repositories\Facades\AdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $password = $request->password;
            AdminRepository::update(AuthHelper::getUserApiId(GUARD_ADMIN_API), [
                'password' => Hash::make($password)
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);

    }
}
