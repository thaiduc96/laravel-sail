<?php

namespace App\Repositories\Eloquents;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerContract;
use Illuminate\Database\Eloquent\Model;


class CustomerRepositoryEloquent extends BaseRepositoryEloquent implements CustomerContract
{
    public function getModel(): Model
    {
        return new Customer;
    }

    public function filter($conditions = [], $with = [], $columns = ['*'], $query = null)
    {
        $query = $this->model
            ->select([
                Customer::getTableName() . '.*'
            ]);

        if ($value = @$conditions['search']) {
            $query = $query->where(function ($q) use ($value) {
                $q->where( Customer::getTableName() . '.email', 'ILIKE', "%" . $value . "%")
                    ->orWhere( Customer::getTableName() . '.name', 'ILIKE', "%" . $value . "%")
                    ->orWhere( Customer::getTableName() . '.phones', 'ILIKE', "%" . $value . "%")
                    ->orWhere( Customer::getTableName() . '.address', 'ILIKE', "%" . $value . "%")
                    ;
            });
        }
        return parent::filter($conditions, $with, $columns, $query);
    }
}
