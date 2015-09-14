<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsCallable extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!is_callable($input->getValue())) {
            throw new ValidationException('value is not callable');
        }
    }
}
