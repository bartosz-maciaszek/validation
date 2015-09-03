<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsObject extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_object($input->getValue())) {
            throw new ValidationException('value is not an object');
        }
    }
}
