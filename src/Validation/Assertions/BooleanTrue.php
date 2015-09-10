<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class BooleanTrue extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($input->getValue() !== true) {
            throw new ValidationException('value is not TRUE');
        }
    }
}
