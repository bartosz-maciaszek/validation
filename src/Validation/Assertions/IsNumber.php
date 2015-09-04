<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsNumber extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_integer($input->getValue()) && !is_float($input->getValue())) {
            throw new ValidationException('value is not a number');
        }
    }
}
