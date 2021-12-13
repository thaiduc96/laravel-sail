<?php

namespace App\Http\Requests\AdminGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdminGroupRequest extends FormRequest
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
            'name' => 'required|max:255|unique:admin_groups,name,NULL,deleted_at',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in([STATUS_ACTIVE,STATUS_INACTIVE])],
        ];
    }
}
