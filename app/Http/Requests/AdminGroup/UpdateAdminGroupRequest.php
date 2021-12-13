<?php

namespace App\Http\Requests\AdminGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminGroupRequest extends FormRequest
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
            'name' => "required|unique:admin_groups,name," . $this->admin_group . ",id,deleted_at,NULL|max:255",
            'description' => 'nullable|string',
            'status' => ['required', Rule::in([STATUS_ACTIVE,STATUS_INACTIVE])],
        ];
    }
}
