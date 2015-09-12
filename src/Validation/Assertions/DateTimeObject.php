<?php

namespace Validation\Assertions;

use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\InputValue;
use Validation\ValidationException;

class DateTimeObject extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        if ($this->getOption('convert') === false && !$input->getValue() instanceof \DateTime) {
            throw new ValidationException('value is not a DateTime object');
        }

        if (!$input->getValue() instanceof \DateTime) {
            $input->replace(function ($value) {
                return new \DateTime($value);
            });
        }
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
