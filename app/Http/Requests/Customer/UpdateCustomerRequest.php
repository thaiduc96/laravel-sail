<?php

namespace App\Http\Requests\Customer;

use App\Rules\CheckPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'email' => "nullable|email|unique:customers,name," . $this->customer . ",id,deleted_at,NULL|max:255",
//            'phone' => "required|unique:customers,phone," . $this->customer . ",id,deleted_at,NULL|max:255",
            'phones' => ['required','array','min:1', new CheckPhoneNumber()],
            'phones.*' => ['required'],
        ];
    }
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'phones' => explode(',',$this->phones),
        ]);
    }
}
