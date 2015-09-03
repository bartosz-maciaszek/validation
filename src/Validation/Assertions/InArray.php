<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class InArray extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (!in_array($input->getValue(), $this->getOption('allowed'))) {
            throw new ValidationException(sprintf('value "%s" is not allowed', $input->getValue()));
        }
    }
}
