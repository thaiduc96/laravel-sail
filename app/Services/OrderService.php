<?php


namespace App\Services;

use App\Models\Order;
use App\Repositories\Facades\OrderItemRepository;
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
        $arrItem = [];
        if(!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $arrItem[] = [
                    'order_id' => $res->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ];
            }
        }
        OrderItemRepository::createMultiple($arrItem);
        return $res;
    }

    public function find($id)
    {
        $res = OrderRepository::with(['items','items.product','customer','provider'])->findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = OrderRepository::findOrFail($id);
        if(!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                switch ($model->status){
                    case Order::STATUS_WAITING_PROVIDER_CONFIRM:
                        $newDataUpdate = [
                            'provider_note' => $item['provider_note'] ?? null,
                            'provider_confirm' => $item['provider_confirm'] ?? null,
                            'quantity_provider_confirm' => $item['quantity_provider_confirm'] ?? null,
                        ];
                        break;
                    case Order::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM:
                        $newDataUpdate = [
                            'supply_chain_note' => $item['supply_chain_note'] ?? null,
                            'expected_delivery_time' => $item['expected_delivery_time'] ?? null,
                        ];
                        break;
                    case Order::STATUS_WAITING_SALE_CONFIRM:
                        $newDataUpdate = [
                            'quantity_sales_confirm' => $item['quantity_sales_confirm'] ?? null,
                        ];
                        break;
                }
                if(!empty($newDataUpdate)){
                    OrderItemRepository::update($item['id'], $newDataUpdate);
                }
            }
        }
        switch ($model->status){
            case Order::STATUS_WAITING_PROVIDER_CONFIRM:
                $model->status = Order::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM;
                break;
            case Order::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM:
                $model->status = Order::STATUS_WAITING_SALE_CONFIRM;
                break;
            case Order::STATUS_WAITING_SALE_CONFIRM:
                $model->status = Order::STATUS_WAITING_SUPPLY_CHAIN_ORDER;
                break;
            case Order::STATUS_WAITING_SUPPLY_CHAIN_ORDER:
                $model->status = Order::STATUS_ORDER;
        }
        $model->save();
        return $model;
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
