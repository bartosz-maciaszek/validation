<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class Required extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($input->getValue() === null) {
            throw new ValidationException('value is required');
        }

        if (is_string($input->getValue()) && !strlen($input->getValue())) {
            throw new ValidationException('value is required');
        }
    }
}
