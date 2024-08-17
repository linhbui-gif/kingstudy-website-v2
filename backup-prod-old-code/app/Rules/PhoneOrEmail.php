<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneOrEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return $this->isValidPhoneNumber($value) || $this->isValidEmail($value);
    }

    /**
     * Determine if the value is a valid phone number.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isValidPhoneNumber($value)
    {
        return preg_match('/^\+?[0-9]{10,15}$/', $value);
    }

    /**
     * Determine if the value is a valid email address.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isValidEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid phone number or email address.';
    }
}
