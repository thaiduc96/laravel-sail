<?php 


namespace App\Services;

use App\Repositories\Facades\WarehouseRepository;
use Illuminate\Database\Eloquent\Model;

class WarehouseService
{
    public function filter($filter)
    {
        $list = WarehouseRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = WarehouseRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = WarehouseRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = WarehouseRepository::findOrFail($id);
        $res = WarehouseRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : WarehouseRepository::find($model);
        return WarehouseRepository::delete($model);
    }

    public function recovery($model)
    {
        return WarehouseRepository::recovery($model);
    }
}
        