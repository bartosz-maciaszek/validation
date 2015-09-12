<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsInteger extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_integer($input->getValue())) {
            throw new ValidationException('value is not an integer');
        }
    }
}
