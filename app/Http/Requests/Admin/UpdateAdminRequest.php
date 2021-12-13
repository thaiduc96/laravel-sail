<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => "required|email|unique:admins,email," . $this->admin . ",id,deleted_at,NULL|max:255",
            'code' => "required|unique:admins,code," . $this->admin . ",id,deleted_at,NULL|max:255",
            'phone' => "required|unique:admins,phone," . $this->admin . ",id,deleted_at,NULL|max:255",
            'warehouse_id' => 'nullable|exists:warehouse_id,id',
            'status' => ['required', Rule::in([STATUS_ACTIVE, STATUS_INACTIVE])],
            'admin_group_id' => 'required|uuid|exists:admin_groups,id,deleted_at,NULL',
            'password' => 'nullable|min:6|max:32'
        ];
    }
}
