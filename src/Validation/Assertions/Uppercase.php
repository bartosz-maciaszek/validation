<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

class Uppercase extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($this->getOption('convert') === false && !ctype_upper($input->getValue())) {
            throw new ValidationException('value must be uppercase');
        }

        $input->replace(function($value) {
            return strtoupper($value);
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
