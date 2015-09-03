<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class MinLength extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $number = $this->getOption('number');
        $length = strlen($input->getValue());

        if ($length < $number) {
            throw new ValidationException(sprintf('value length < %d', $number));
        }
    }
}
