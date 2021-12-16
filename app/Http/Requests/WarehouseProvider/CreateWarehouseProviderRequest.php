<?php

namespace App\Http\Requests\WarehouseProvider;

use Illuminate\Foundation\Http\FormRequest;

class CreateWarehouseProviderRequest extends FormRequest
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
            'name' => 'required|unique:admins,name,NULL,deleted_at|max:255',
            'description' => 'nullable|max:1000',
            'provider_id' => 'required|uuid|exists:providers,id,deleted_at,NULL',
            'warehouse_ids' => 'required|array',
            'warehouse_ids.*' => 'required|uuid|exists:warehouses,id,deleted_at,NULL',
        ];
    }
}
