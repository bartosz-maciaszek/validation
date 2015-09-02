<?php

namespace Validation\Schema;

use Validation\Validation;
use Validation\ValidationException;

class ArraySchema extends AbstractSchema
{
    public function __construct()
    {
        $this->addAssertion(function($value) {

            if (!is_array($value)) {
                throw new ValidationException('value is not an array');
            }

            return $value;
        });
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function keys(array $keys)
    {
        $this->addAssertion(function($value) use ($keys) {

            foreach ($keys as $key => $schema) {

                if (!isset($value[$key])) {
                    throw new ValidationException(sprintf('key "%s" is missing', $key));
                }

                Validation::validate($value[$key], $schema, function($err, $validated) use ($value, $key) {

                    if ($err !== null) {
                        throw new ValidationException(sprintf('"%s" is invalid, because [ %s ]', $key, $err));
                    }

                    $value[$key] = $validated;
                });
            }

            return $value;
        });

        return $this;
    }
}
