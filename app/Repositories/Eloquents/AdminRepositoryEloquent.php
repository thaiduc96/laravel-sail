<?php

namespace App\Repositories\Eloquents;

use App\Models\Admin;
use App\Models\AdminGroup;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use App\Repositories\Contracts\AdminContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class AdminRepositoryEloquent extends BaseRepositoryEloquent implements AdminContract
{
    public function getModel(): Model
    {
        return new Admin;
    }

    public function filter($conditions = [], $with = [], $columns = ['*'], $query = null)
    {
        $prefix = DB::getTablePrefix();
        $query = $this->model
            ->leftJoin($prefix . AdminGroup::getTableName() . ' as ag', 'ag.id', Admin::getTableName() . '.admin_group_id')
            ->leftJoin($prefix . District::getTableName() . ' as d', 'd.id', Admin::getTableName() . '.district_id')
            ->leftJoin($prefix . Province::getTableName() . ' as p', 'p.id', Admin::getTableName() . '.province_id')
            ->leftJoin($prefix . Ward::getTableName() . ' as w', 'w.id', Admin::getTableName() . '.ward_id')
            ->select([
                'ag.name as admin_group_name',
                'd.name as district_name',
                'p.name as province_name',
                'w.name_with_type as ward_name',
                'b.name as branch_name',
                Admin::getTableName() . '.*'
            ])
            ->filter($conditions)
            ->where('ag.key', '<>', SUPER_ADMIN);


        if ($value = @$conditions['search']) {
            $query = $query->where(function ($q) use ($value) {
                $q->where(Admin::getTableName() . '.code', 'ILIKE', "%" . $value . "%")
                    ->orWhere(Admin::getTableName() . '.name', 'ILIKE', "%" . $value . "%")
                    ->orWhere(Admin::getTableName() . '.email', 'ILIKE', "%" . $value . "%")
                    ->orWhere(Admin::getTableName() . '.phone', 'ILIKE', "%" . $value . "%")
                    ->orWhere(Admin::getTableName() . '.address', 'ILIKE', "%" . $value . "%")
                    ->orWhere('ag.name', 'ILIKE', "%" . $value . "%")
                    ->orWhere('d.name', 'ILIKE', "%" . $value . "%")
                    ->orWhere('p.name', 'ILIKE', "%" . $value . "%");
            });
        }

        return parent::filter($conditions, $with, $columns, $query);
    }
}
