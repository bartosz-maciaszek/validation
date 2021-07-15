<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

class ObjectKeys extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        foreach ($this->getOption('keys') as $key => $schema) {
            if (!property_exists($input->getValue(), $key)) {
                throw new ValidationException(sprintf('key "%s" is missing', $key));
            }

            $this->validateAndReplaceKey($input, $key, $schema);
        }
    }

    /**
     * @param InputValue $input
     * @param $key
     * @param AbstractSchema $schema
     * @throws ValidationException
     */
    private function validateAndReplaceKey(InputValue $input, $key, AbstractSchema $schema)
    {
        try {
            $input->replace(function ($value) use ($key, $schema) {
                $value->$key = V::assert($value->$key, $schema);

                return $value;
            });
        } catch (ValidationException $e) {
            throw new ValidationException(sprintf('key "%s" is invalid, because [ %s ]', $key, $e->getMessage()));
        }
    }
}
