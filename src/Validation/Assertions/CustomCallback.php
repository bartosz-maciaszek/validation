<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\ArraySchema;
use Validation\Validation as V;
use Validation\ValidationException;

class CustomCallback extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        /** @var \Closure $callback */
        $callback = $this->getOption('callback');
        $callback($input);
    }

    /**
     * @return ArraySchema
     */
    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'callback' => V::closure()
        ]);
    }
}
