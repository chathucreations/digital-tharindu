<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Validates Sri Lankan mobile numbers in the strict international
 * format: 947XXXXXXXX (e.g. 94712345678).
 */
class SriLankanPhone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! preg_match('/^947\d{8}$/', $value)) {
            $fail('The :attribute must be a valid Sri Lankan number in the format 947XXXXXXXX.');
        }
    }
}
