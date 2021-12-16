<?php

namespace App\Repositories\Eloquents;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Province;
use App\Models\Warehouse;
use App\Repositories\Contracts\OrderContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class OrderRepositoryEloquent extends BaseRepositoryEloquent implements OrderContract
{
    public function getModel(): Model
    {
        return new Order;
    }

    public function filter($conditions = [],$with = [], $columns = ['*'], $query = null)
    {
        $prefix = DB::getTablePrefix();
        $query =  $this->model
            ->leftJoin($prefix . Warehouse::getTableName() . ' as b', 'b.id', Order::getTableName() . '.warehouse_id')
            ->leftJoin($prefix . Province::getTableName() . ' as p', 'p.id', 'b.province_id')
            ->select([
                'b.name as warehouse_name',
                'p.region as region_title',
                Order::getTableName() . '.*'
            ])
            ->filter($conditions)
        ;

        if ($value = @$conditions['search']) {
            $query = $query->where(function ($q) use ($value) {
                $q->where(
                    Order::getTableName() . '.customer_name', 'ILIKE', "%" . $value . "%")
                    ->orWhere('b.name', 'ILIKE', "%" . $value . "%")
                ;
            });
        }

        return parent::filter($conditions,$with, $columns, $query);
    }

    public function getMaxCode()
    {
        $maxNumber = $this->model->withTrashed()->max('code_number');
        if (empty($maxNumber)) {
            $maxNumber = 0;
        }
        return ++$maxNumber;
    }

}
