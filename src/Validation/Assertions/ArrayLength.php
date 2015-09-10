<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class ArrayLength extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $expected = $this->getOption('length');
        $actual = count($input->getValue());

        if ($actual != $expected) {
            $message = sprintf('array length is %d, while length of %d was expected', $actual, $expected);
            throw new ValidationException($message);
        }
    }
}
