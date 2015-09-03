<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;

class IpAddress extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $options = $this->getOption('options', FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);

        if (!filter_var($input->getValue(), FILTER_VALIDATE_IP, $options)) {
            throw new ValidationException(sprintf('"%s" is not a valid IP address', $input->getValue()));
        }
    }
}
