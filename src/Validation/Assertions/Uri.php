<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class Uri extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $options = $this->getOption('options');

        if ($options == null && !filter_var($input->getValue(), FILTER_VALIDATE_URL)) {
            throw new ValidationException(sprintf('"%s" is not a valid URI', $input->getValue()));
        }

        if ($options !== null && !filter_var($input->getValue(), FILTER_VALIDATE_URL, $options)) {
            throw new ValidationException(sprintf('"%s" is not a valid URI', $input->getValue()));
        }
    }
}
