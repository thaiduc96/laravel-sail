<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
            'group_secondary_id' => 'required|uuid|exists:group_secondaries,id,deleted_at,NULL',
            'code' => 'required|max:255|unique:products,code,NULL,deleted_at',
            'name' => 'required|max:255|unique:products,name,NULL,deleted_at',
            'status' => ['required', Rule::in([STATUS_INACTIVE, STATUS_ACTIVE])],
        ];
    }
}
