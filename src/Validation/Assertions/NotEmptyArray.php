<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class NotEmptyArray extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (count($input->getValue()) === 0) {
            throw new ValidationException('value is an empty array');
        }
    }
}
