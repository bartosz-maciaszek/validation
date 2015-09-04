<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IsDate extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!$input->getValue() instanceof \DateTime && false === strtotime($input->getValue())) {
            throw new ValidationException('value is not a date');
        }
    }
}
