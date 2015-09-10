<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class StringLength extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $number = $this->getOption('length');
        $length = strlen($input->getValue());

        if ($length != $number) {
            throw new ValidationException(sprintf('value length is %d, expected %d', $length, $number));
        }
    }
}
