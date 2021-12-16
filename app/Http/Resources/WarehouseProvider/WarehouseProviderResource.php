<?php

namespace App\Http\Resources\WarehouseProvider;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseProviderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $arr = parent::toArray($request);
        unset($arr['warehouse_warehouse_providers']);
        return array_merge($arr,[
            'warehouse_ids' => $this->whenLoaded('warehouseWarehouseProviders', array_unique(array_column($this->warehouseWarehouseProviders->toArray(), 'warehouse_id')))
        ]);
    }
}
