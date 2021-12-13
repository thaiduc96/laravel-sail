<?php 


namespace App\Services;

use App\Repositories\Facades\OrderItemRepository;
use Illuminate\Database\Eloquent\Model;

class OrderItemService
{
    public function filter($filter)
    {
        $list = OrderItemRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = OrderItemRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = OrderItemRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = OrderItemRepository::findOrFail($id);
        $res = OrderItemRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : OrderItemRepository::find($model);
        return OrderItemRepository::delete($model);
    }

    public function recovery($model)
    {
        return OrderItemRepository::recovery($model);
    }
}
        