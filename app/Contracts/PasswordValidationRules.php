<?php

namespace App\Contracts;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules(): array
    {
        $password = ( config('app.debug'))
            ? new Password
            : (new Password)->length(8)->requireNumeric()->requireUppercase();

        return ['required', 'string', $password];
    }
}
