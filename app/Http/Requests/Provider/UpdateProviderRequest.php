<?php

namespace App\Http\Requests\Provider;

use App\Rules\CheckPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
