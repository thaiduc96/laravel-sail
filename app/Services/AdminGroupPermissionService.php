<?php 


namespace App\Services;

use App\Repositories\Facades\AdminGroupPermissionRepository;
use Illuminate\Database\Eloquent\Model;

class AdminGroupPermissionService
{
    public function filter($filter)
    {
        $list = AdminGroupPermissionRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = AdminGroupPermissionRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = AdminGroupPermissionRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = AdminGroupPermissionRepository::findOrFail($id);
        $res = AdminGroupPermissionRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : AdminGroupPermissionRepository::find($model);
        return AdminGroupPermissionRepository::delete($model);
    }

    public function recovery($model)
    {
        return AdminGroupPermissionRepository::recovery($model);
    }
}
        