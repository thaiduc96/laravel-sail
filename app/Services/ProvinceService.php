<?php 


namespace App\Services;

use App\Repositories\Facades\ProvinceRepository;
use Illuminate\Database\Eloquent\Model;

class ProvinceService
{
    public function filter($filter)
    {
        $list = ProvinceRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = ProvinceRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = ProvinceRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = ProvinceRepository::findOrFail($id);
        $res = ProvinceRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : ProvinceRepository::find($model);
        return ProvinceRepository::delete($model);
    }

    public function recovery($model)
    {
        return ProvinceRepository::recovery($model);
    }
}
        