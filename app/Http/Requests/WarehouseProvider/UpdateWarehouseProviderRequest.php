<?php

namespace App\Http\Requests\WarehouseProvider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseProviderRequest extends FormRequest
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
            'provider_id' => 'required|uuid|exists:providers,id,deleted_at,NULL',
            'name' => "required|unique:warehouse_providers,name," . $this->warehouse_provider . ",id,deleted_at,NULL,provider_id,".$this->provider_id,
            'description' => 'nullable|max:1000',
            'warehouse_ids' => 'required|array',
            'warehouse_ids.*' => 'required|uuid|exists:warehouses,id,deleted_at,NULL',
        ];
    }
}
