<?php 


namespace App\Services;

use App\Repositories\Facades\DistrictRepository;
use Illuminate\Database\Eloquent\Model;

class DistrictService
{
    public function filter($filter)
    {
        $list = DistrictRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = DistrictRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = DistrictRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = DistrictRepository::findOrFail($id);
        $res = DistrictRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : DistrictRepository::find($model);
        return DistrictRepository::delete($model);
    }

    public function recovery($model)
    {
        return DistrictRepository::recovery($model);
    }
}
        