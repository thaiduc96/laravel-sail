<?php
namespace App\Services;

use App\Repositories\Facades\InventoryRepository;
use Illuminate\Database\Eloquent\Model;

class InventoryService
{
    public function filter($filter)
    {
        $list = InventoryRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = InventoryRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = InventoryRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = InventoryRepository::findOrFail($id);
        $res = InventoryRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : InventoryRepository::find($model);
        return InventoryRepository::delete($model);
    }

    public function recovery($model)
    {
        return InventoryRepository::recovery($model);
    }
}
