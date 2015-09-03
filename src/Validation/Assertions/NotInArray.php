<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation;
use Validation\ValidationException;

class NotInArray extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if (in_array($input->getValue(), $this->getOption('disallowed'))) {
            throw new ValidationException(sprintf('value "%s" is disallowed', $input->getValue()));
        }
    }

    /**
     * @return AbstractSchema
     */
    protected function getOptionsSchema()
    {
        return Validation::arr()->keys([
            'disallowed' => Validation::arr()->notEmpty()
        ]);
    }
}
