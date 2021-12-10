<?php

namespace App\Http\Requests\Auth;

use App\Helpers\AuthHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => [
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, AuthHelper::getUserApi()->password)) {
                        $fail(trans('validation.wrong_old_pw'));
                    }
                },
            ],
            'password' => 'required|confirmed|min:6|max:32|different:old_password',
        ];
    }
}
