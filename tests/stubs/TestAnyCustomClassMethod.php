<?php

namespace Validation\Tests\stubs;

use Validation\InputValue;
use Validation\ValidationException;

class TestAnyCustomClassMethod
{
    /**
     * @param InputValue $input
     */
    public function toUpper(InputValue $input)
    {
        $input->replace(function ($value) {
            return strtoupper($value);
        });
    }

    /**
     * @throws ValidationException
     */
    public function throwException()
    {
        throw new ValidationException('A custom validation message');
    }
}
