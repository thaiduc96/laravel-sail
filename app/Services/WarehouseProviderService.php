<?php


namespace App\Services;

use App\Repositories\Facades\WarehouseProviderRepository;
use Illuminate\Database\Eloquent\Model;

class WarehouseProviderService
{
    public function filter($filter)
    {
        $list = WarehouseProviderRepository::filter($filter,['warehouseWarehouseProviders']);
        return $list;
    }

    public function create($data)
    {
        $res = WarehouseProviderRepository::create($data);
        $res->warehouses()->sync($data['warehouse_ids'] ?? []);

        return $res;
    }

    public function find($id)
    {
        $res = WarehouseProviderRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = WarehouseProviderRepository::findOrFail($id);
        $res = WarehouseProviderRepository::update($model, $data);
        $res->warehouses()->sync($data['warehouse_ids'] ?? []);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : WarehouseProviderRepository::find($model);
        return WarehouseProviderRepository::delete($model);
    }

    public function recovery($model)
    {
        return WarehouseProviderRepository::recovery($model);
    }
}
