<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DateEqualGreaterThen implements Rule
{
    private $carbon;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
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
        // $value .= "-{$this->carbon->lastD} 23:59:59";
        $valueData = Carbon::createFromFormat('Y-m',$value);

        if ( $valueData->endOfMonth()->gte($this->carbon) ){
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
        return 'The Date must be equal or greater then: '. $this->carbon->now()->format('Y-m');
    }
}
