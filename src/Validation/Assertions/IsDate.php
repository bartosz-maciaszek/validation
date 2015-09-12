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
        if ($input->getValue() instanceof \DateTime) {
            return;
        }

        if (is_string($input->getValue()) && false !== strtotime($input->getValue())) {
            return;
        }

        throw new ValidationException('value is not a date');
    }
}
