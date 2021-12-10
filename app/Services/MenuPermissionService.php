<?php 


namespace App\Services;

use App\Repositories\Facades\MenuPermissionRepository;
use Illuminate\Database\Eloquent\Model;

class MenuPermissionService
{
    public function filter($filter)
    {
        $list = MenuPermissionRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = MenuPermissionRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = MenuPermissionRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = MenuPermissionRepository::findOrFail($id);
        $res = MenuPermissionRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : MenuPermissionRepository::find($model);
        return MenuPermissionRepository::delete($model);
    }

    public function recovery($model)
    {
        return MenuPermissionRepository::recovery($model);
    }
}
        