<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Validation as V;
use Validation\ValidationException;

class AlternativeAny extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        foreach ($this->getOption('options') as $schema) {
            try {
                $input->replace(function ($value) use ($schema) {
                    return V::attempt($value, $schema);
                });
                return;
            } catch (ValidationException $e) {
                var_dump($e);
                exit;
            }
        }

        throw new ValidationException('none of the alternatives matched');
    }
}
