<?php

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;

class SendCodeForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email'
        ];
    }

    public function merge(array $input)
    {
        return [
          'email.exists' => trans('message.email_not_exists')
        ];
    }
}
