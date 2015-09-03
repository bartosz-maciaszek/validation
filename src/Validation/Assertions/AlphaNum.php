<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class AlphaNum extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!ctype_alnum($input->getValue())) {
            throw new ValidationException('value contains not alphanumeric chars');
        }
    }
}