<?php 


namespace App\Services;

use App\Repositories\Facades\WardRepository;
use Illuminate\Database\Eloquent\Model;

class WardService
{
    public function filter($filter)
    {
        $list = WardRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = WardRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = WardRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = WardRepository::findOrFail($id);
        $res = WardRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : WardRepository::find($model);
        return WardRepository::delete($model);
    }

    public function recovery($model)
    {
        return WardRepository::recovery($model);
    }
}
        