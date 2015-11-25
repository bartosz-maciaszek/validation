<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class NumberMin extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $number = $this->getOption('number');

        if ($input->getValue() < $number) {
            throw new ValidationException(sprintf('value must be >= %d', $number));
        }
    }
}
