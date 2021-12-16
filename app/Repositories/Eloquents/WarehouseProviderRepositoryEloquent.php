<?php

namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Models\Provider;
use App\Models\WarehouseProvider;
use App\Repositories\Contracts\WarehouseProviderContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class WarehouseProviderRepositoryEloquent extends BaseRepositoryEloquent implements WarehouseProviderContract
{
    public function getModel(): Model
    {
        return new WarehouseProvider;
    }

    public function filter($conditions = [],$with = [], $columns = ['*'], $query = null)
    {
        $prefix = DB::getTablePrefix();
        $query =  $this->model
            ->leftJoin($prefix . Provider::getTableName() . ' as b', 'b.id', WarehouseProvider::getTableName() . '.provider_id')
            ->select([
                'b.name as provider_name',
                WarehouseProvider::getTableName() . '.*'
            ])
            ->filter($conditions)
        ;

        if ($value = @$conditions['search']) {
            $query = $query->where(function ($q) use ($value) {
                $q->where(
                    WarehouseProvider::getTableName() . '.name', 'ILIKE', "%" . $value . "%")
                    ->orWhere(WarehouseProvider::getTableName() . '.description', 'ILIKE', "%" . $value . "%")
                    ->orWhere('b.name', 'ILIKE', "%" . $value . "%")
                ;
            });
        }

        return parent::filter($conditions,$with, $columns, $query);
    }
}
