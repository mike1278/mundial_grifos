<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Lat implements Rule
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

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!preg_match('/^[-]?\d+[\.]?\d*$/',$value)) {
            return false;
        }
        return ($value > -90 && $value < 90);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La latitud no es valida';
    }
}
