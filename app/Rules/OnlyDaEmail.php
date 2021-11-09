<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyDaEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        if(strpos($value, '@da.gov.ph') !== false){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only da.gov.ph Id is allowed.';
    }
}
