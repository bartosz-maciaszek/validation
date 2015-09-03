<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsArray extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_array($input->getValue())) {
            throw new ValidationException('value is not an array');
        }
    }
}
