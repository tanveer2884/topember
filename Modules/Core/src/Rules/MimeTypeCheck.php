<?php

namespace Topdot\Core\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use function array_filter;
use function implode;
use function in_array;

class MimeTypeCheck implements Rule
{
    private $allowed;

    /**
     * Create a new rule instance.
     *
     * @param array $allowed
     */
    public function __construct(array $allowed = [])
    {
        $this->allowed = array_filter($allowed,'trim');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param $file
     * @return bool
     */
    public function passes($attribute, $file)
    {
        if ( $file instanceof UploadedFile){
            return in_array($file->getClientMimeType(),$this->allowed);
        }
        return  false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'File Type must be one of the '.implode(',',$this->allowed);
    }
}
