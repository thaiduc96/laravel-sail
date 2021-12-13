<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $regex = '(84|0[3|5|7|8|9])+([0-9]{8})\b';
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach (request()->get('phones') as $key => $value){
            if (!preg_match('/(028|064|032|033|034|035|036|037|038|039|086|096|097|098|081|082|083|084|085|088|091|094|056|058|092|070|076|077|078|079|089|090|093|099|059)+([0-9]{7,8})\b/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $phoneInvalid = [];
        foreach (request()->get('phones') as $key => $value){
            if (!preg_match('/(028|032|033|034|035|036|037|038|039|086|096|097|098|081|082|083|084|085|088|091|094|056|058|092|070|076|077|078|079|089|090|093|099|059)+([0-9]{7,8})\b/', $value)) {
                $phoneInvalid[] = $value;
            }
        }
        return trans('validation.phone_invalid_index',['phone' => implode(', ',$phoneInvalid)]);
    }
}
