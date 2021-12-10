<?php 


namespace App\Services;

use App\Repositories\Facades\AdminGroupRepository;
use Illuminate\Database\Eloquent\Model;

class AdminGroupService
{
    public function filter($filter)
    {
        $list = AdminGroupRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = AdminGroupRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = AdminGroupRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = AdminGroupRepository::findOrFail($id);
        $res = AdminGroupRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : AdminGroupRepository::find($model);
        return AdminGroupRepository::delete($model);
    }

    public function recovery($model)
    {
        return AdminGroupRepository::recovery($model);
    }
}
        