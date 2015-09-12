<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class ArrayLengthMin extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $expected = $this->getOption('length');
        $actual = count($input->getValue());

        if ($actual < $expected) {
            $message = sprintf('array needs to have at least %d items', $expected);
            throw new ValidationException($message);
        }
    }
}
