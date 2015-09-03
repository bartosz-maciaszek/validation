<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsBoolean extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_bool($input->getValue())) {
            throw new ValidationException('value is not a boolean');
        }
    }
}
