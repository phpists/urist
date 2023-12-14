<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;

class LetterDigitsRule implements ValidationRule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/[A-Za-z]/', $value) || !preg_match('/\d/', $value)) {
            $fail(Lang::get('validation.regex_letter_digits'));
        }
    }
}
