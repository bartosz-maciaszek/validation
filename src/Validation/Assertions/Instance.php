<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

class Instance extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $name = $this->getOption('of');

        if (!$input->getValue() instanceof $name) {
            throw new ValidationException(sprintf('object is not an instance of %s', $name));
        }
    }

    /**
     * @return AbstractSchema
     */
    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'of' => V::string()->min(1)
        ]);
    }
}