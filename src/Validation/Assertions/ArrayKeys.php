<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
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
        /** @var AbstractSchema $schema */
        foreach ($this->getOption('keys') as $key => $schema) {
            $this->processKey($input, $key, $schema);
        }
    }

    /**
     * @param InputValue $input
     * @param $key
     * @param AbstractSchema $schema
     * @throws ValidationException
     */
    private function processKey(InputValue $input, $key, AbstractSchema $schema)
    {
        if (!array_key_exists($key, $input->getValue())) {
            $this->handleMissingKey($input, $key, $schema->getOption('default'));
        } else {
            $this->validateAndReplaceKey($input, $key, $schema);
        }
    }

    /**
     * @param InputValue $input
     * @param $key
     * @param $defaultValue
     * @throws ValidationException
     */
    private function handleMissingKey(InputValue $input, $key, $defaultValue)
    {
        if (!isset($defaultValue)) {
            throw new ValidationException(sprintf('key "%s" is missing', $key));
        }

        $input->replace(function ($value) use ($key, $defaultValue) {
            $value[$key] = is_callable($defaultValue) ? $defaultValue($value) : $defaultValue;

            return $value;
        });
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
                $value[$key] = V::attempt($value[$key], $schema);

                return $value;
            });

            if ($schema->getOption('strip')) {
                $input->replace(function ($value) use ($key) {
                    unset($value[$key]);

                    return $value;
                });
            }
        } catch (ValidationException $e) {
            throw new ValidationException(sprintf('key "%s" is invalid, because [ %s ]', $key, $e->getMessage()));
        }
    }
}
