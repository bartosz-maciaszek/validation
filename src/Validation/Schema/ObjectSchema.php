<?php

namespace Validation\Schema;

use Validation\ValidationException;

class ObjectSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->addAssertion(function($value) {

            if (!is_object($value)) {
                throw new ValidationException('value is not an object');
            }

            return $value;
        });
    }

    /**
     * @param $className
     * @return $this
     */
    public function instance($className)
    {
        $this->addAssertion(function($value) use ($className) {

            if (!$value instanceof $className) {
                throw new ValidationException(sprintf('object is not an instance of %s', $className));
            }

            return $value;
        });

        return $this;
    }
}
