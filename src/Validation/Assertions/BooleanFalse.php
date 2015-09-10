<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class BooleanFalse extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($input->getValue() !== false) {
            throw new ValidationException('value is not FALSE');
        }
    }
}
