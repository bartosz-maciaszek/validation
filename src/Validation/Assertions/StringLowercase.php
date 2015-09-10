<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

class StringLowercase extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($this->getOption('convert') === false && !ctype_lower($input->getValue())) {
            throw new ValidationException('value must be lowercase');
        }

        $input->replace(function ($value) {
            return strtolower($value);
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
