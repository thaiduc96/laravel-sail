<?php


namespace App\Services;

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
        $res = OrderRepository::update($model, $data);
        if(!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $newDataUpdate = [
                    'order_id' => $res->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'provider_note' => $item['provider_note'] ?? null,
                    'provider_confirm' => $item['provider_confirm'] ?? null,
                    'supply_chain_note' => $item['supply_chain_note'] ?? null,
                    'expected_delivery_time' => $item['expected_delivery_time'] ?? null,
                    'quantity_sales_confirm' => $item['quantity_sales_confirm'] ?? null,
                    'quantity_provider_confirm' => $item['quantity_provider_confirm'] ?? null,
                ];
                if (!empty($item['is_delete']) && filter_var($item['is_delete'], FILTER_VALIDATE_BOOLEAN) == true) {
                    OrderItemRepository::delete($item['id']);
                } elseif (!empty($item['is_new']) && filter_var($item['is_new'], FILTER_VALIDATE_BOOLEAN) == true) {
                    $createdItem = OrderItemRepository::create($newDataUpdate);
                } else {
                    $createdItem = OrderItemRepository::update($item['id'], $newDataUpdate);
                }
            }
        }
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
