<?php


namespace App\Services;

use App\Facades\AdminPermissionFacade;
use App\Helpers\AuthHelper;
use App\Repositories\Facades\AdminRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminService
{
    public function getAdminLogin($guard, $token)
    {
        $user = AdminRepository::with('adminGroup')->find(AuthHelper::getUserApiId($guard));
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($guard)->factory()->getTTL() * 60,
            'admin' => $user,
            'permission' => AdminPermissionFacade::handleDataPermission($user)
        ];
    }

    public function loginByUser($user){
        return AuthHelper::getGuardApi(GUARD_ADMIN_API)->login($user);
    }


    public function filter($filter)
    {
        $list = AdminRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = AdminRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = AdminRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = AdminRepository::findOrFail($id);
        $res = AdminRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : AdminRepository::find($model);
        return AdminRepository::delete($model);
    }

    public function recovery($model)
    {
        return AdminRepository::recovery($model);
    }
}
