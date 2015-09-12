<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Validation as V;
use Validation\ValidationException;

class ArrayKeys extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        foreach ($this->getOption('keys') as $key => $schema) {
            if (!isset($input->getValue()[$key])) {
                throw new ValidationException(sprintf('key "%s" is missing', $key));
            }

            try {
                $input->replace(function ($value) use ($key, $schema) {
                    $value[$key] = V::attempt($value[$key], $schema);
                    return $value;
                });
            } catch (ValidationException $e) {
                throw new ValidationException(sprintf('key "%s" is invalid, because [ %s ]', $key, $e->getMessage()));
            }
        }
    }
}
