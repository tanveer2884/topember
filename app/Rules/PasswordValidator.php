<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordValidator implements Rule
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
        if ( preg_match("(.*[a-z].*)",$value) && preg_match("(.*[A-Z].*)", $value) && preg_match("(.*\d.*)", $value) ){
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
        return 'Password must contain atleast one upercase, one lowercase and one digit.';
    }
}
