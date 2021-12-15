<?php

namespace App\Http\Requests\Order;

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
        return [
            'customer_id' => 'required|uuid|exists:customers,id,deleted_at,NULL',
            'provider_id' => 'required|uuid|exists:providers,id,deleted_at,NULL',
            'warehouse_id' => 'required|uuid|exists:warehouses,id,deleted_at,NULL',
            'items' => 'required|array',
            'items.*.product_id' => 'required|uuid|exists:products,id,deleted_at,NULL',
            'items.*.quantity' => 'required|min:1|max:99999999',
            'items.*.quantity_provider_confirm' => 'required|min:0|max:99999999',
            'items.*.quantity_sales_confirm' => 'required|min:0|max:99999999',
        ];
    }
}
