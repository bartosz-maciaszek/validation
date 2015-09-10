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

            V::validate($input->getValue()[$key], $schema, function ($err, $validated) use ($input, $key) {

                if ($err !== null) {
                    throw new ValidationException(sprintf('key "%s" is invalid, because [ %s ]', $key, $err));
                }

                $input->replace(function ($value) use ($key, $validated) {
                    $value[$key] = $validated;
                    return $value;
                });
            });
        }
    }
}
