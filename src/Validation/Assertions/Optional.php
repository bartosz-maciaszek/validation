<?php

namespace Validation\Assertions;

use Validation\InputValue;

class Optional extends AbstractAssertion
{
    /**
     * @param InputValue $input
     */
    public function process(InputValue $input)
    {
        $input->setOptional(true);
    }
}