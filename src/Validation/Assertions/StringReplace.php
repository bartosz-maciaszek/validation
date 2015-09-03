<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;

class StringReplace extends AbstractAssertion
{
    /**
     * @param InputValue $input
     */
    public function process(InputValue $input)
    {
        $input->replace(function($value) {
            return str_replace($this->getOption('search'), $this->getOption('replace'), $value);
        });
    }

    /**
     * @return AbstractSchema
     */
    public function getOptionsSchema()
    {
        return V::arr()->keys([
            'search' => V::alternative(V::string()->min(1), V::arr()->notEmpty()),
            'replace' => V::alternative(V::string(), V::arr()->notEmpty())
        ]);
    }
}