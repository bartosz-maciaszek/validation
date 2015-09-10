<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

class StringTrim extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($this->getOption('convert') === false && trim($input->getValue()) !== $input->getValue()) {
            throw new ValidationException('value is not trimmed');
        }

        $input->replace(function ($value) {
            return trim($value);
        });
    }

    /**
     * @return AbstractSchema
     */
    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'convert' => V::boolean()
        ]);
    }
}
