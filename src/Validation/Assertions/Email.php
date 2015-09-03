<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class Email extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!filter_var($input->getValue(), FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException(sprintf('"%s" is not a valid email', $input->getValue()));
        }
    }
}
