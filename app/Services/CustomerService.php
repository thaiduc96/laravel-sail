<?php 


namespace App\Services;

use App\Repositories\Facades\CustomerRepository;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{
    public function filter($filter)
    {
        $list = CustomerRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = CustomerRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = CustomerRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = CustomerRepository::findOrFail($id);
        $res = CustomerRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : CustomerRepository::find($model);
        return CustomerRepository::delete($model);
    }

    public function recovery($model)
    {
        return CustomerRepository::recovery($model);
    }
}
        