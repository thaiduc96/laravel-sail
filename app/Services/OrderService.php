<?php 


namespace App\Services;

use App\Repositories\Facades\OrderRepository;
use Illuminate\Database\Eloquent\Model;

class OrderService
{
    public function filter($filter)
    {
        $list = OrderRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = OrderRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = OrderRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = OrderRepository::findOrFail($id);
        $res = OrderRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : OrderRepository::find($model);
        return OrderRepository::delete($model);
    }

    public function recovery($model)
    {
        return OrderRepository::recovery($model);
    }
}
        