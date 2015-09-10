<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class ArrayLengthMax extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $expected = $this->getOption('length');
        $actual = count($input->getValue());

        if ($actual > $expected) {
            $message = sprintf('array needs to be at most %d items long', $expected);
            throw new ValidationException($message);
        }
    }
}
