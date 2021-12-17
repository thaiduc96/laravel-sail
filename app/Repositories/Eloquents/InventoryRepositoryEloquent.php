<?php

namespace App\Repositories\Eloquents;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Province;
use App\Models\Warehouse;
use App\Models\WarehouseProvider;
use App\Repositories\Contracts\InventoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class InventoryRepositoryEloquent extends BaseRepositoryEloquent implements InventoryContract
{
    public function getModel(): Model
    {
        return new Inventory;
    }

    public function filter($conditions = [],$with = [], $columns = ['*'], $query = null)
    {
        $prefix = DB::getTablePrefix();
        $query =  $this->model
            ->leftJoin($prefix . Product::getTableName() . ' as p', 'p.id', Inventory::getTableName() . '.product_id')
            ->leftJoin($prefix . WarehouseProvider::getTableName() . ' as wp', 'wp.id', Inventory::getTableName() . '.warehouse_provider_id')
            ->leftJoin($prefix . Provider::getTableName() . ' as pp', 'pp.id', Inventory::getTableName() . '.provider_id')
            ->select([
                'p.code as product_code',
                'pp.name as provider_name',
                'wp.name as warehouse_provider_name',
                Inventory::getTableName() . '.quantity'
            ])
            ->filter($conditions)
        ;

        if ($value = @$conditions['search']) {
            $query = $query->where(function ($q) use ($value) {
                $q->where(
                  'p.code', 'ILIKE', "%" . $value . "%")
                ->orWhere('pp.name', 'ILIKE', "%" . $value . "%")
                ->orWhere('wp.name', 'ILIKE', "%" . $value . "%")
                ;
            });
        }

        return parent::filter($conditions,$with, $columns, $query);
    }
}
