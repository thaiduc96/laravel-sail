<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'customer_id' => 'required|uuid|exists:customers,id,deleted_at,NULL',
            'provider_id' => 'required|uuid|exists:providers,id,deleted_at,NULL',
            'warehouse_id' => 'required|uuid|exists:warehouses,id,deleted_at,NULL',
            'status' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|uuid|exists:products,id,deleted_at,NULL',
            'items.*.quantity' => 'required|min:1|max:99999999',
            'items.*.quantity_provider_confirm' => 'required|min:0|max:99999999',
            'items.*.quantity_sales_confirm' => 'required|min:0|max:99999999',
        ];

        if ($this->status == Order::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM) {
            $rules ['items.*.expected_delivery_time'] = 'required|date|date_format:Y-m-d';
        }
        if ($this->status == Order::STATUS_WAITING_PROVIDER_CONFIRM) {
            $rules ['items.*.quantity_provider_confirm'] = 'required|min:0|max:99999999';
        }
        if ($this->status == Order::STATUS_WAITING_SALE_CONFIRM) {
            $rules ['items.*.quantity_sales_confirm'] = 'required|min:0|max:99999999';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'items.*.expected_delivery_time.required' => 'Vui lòng chọn thời gian dự kiến giao hàng',
            'items.*.quantity_provider_confirm.required' => 'Vui lòng nhập số lượng',
            'items.*.quantity_sales_confirm.required' => 'Vui lòng nhập số lượng',
        ];
    }
}
