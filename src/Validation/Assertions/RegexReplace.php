<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;

class RegexReplace extends AbstractAssertion
{
    /**
     * @param InputValue $input
     */
    public function process(InputValue $input)
    {
        $input->replace(function ($value) {
            return preg_replace($this->getOption('pattern'), $this->getOption('replace'), $value);
        });
    }

    /**
     * @return AbstractSchema
     */
    public function getOptionsSchema()
    {
        return V::arr()->keys([
            'pattern' => V::string()->min(1),
            'replace' => V::string()
        ]);
    }
}
