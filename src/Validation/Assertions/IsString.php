<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsString extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_string($input->getValue())) {
            throw new ValidationException('value is not a string');
        }
    }
}
