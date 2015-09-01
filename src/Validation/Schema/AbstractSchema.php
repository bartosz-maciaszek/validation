<?php

namespace Validation\Schema;

use Validation\ValidationException;

abstract class AbstractSchema
{
    /**
     * @var array
     */
    private $assertions = [];

    /**
     * @param $value
     * @throws ValidationException
     */
    public function validate($value)
    {
        foreach ($this->assertions as $assertion) {
            if (false === $assertion($value)) {
                throw new ValidationException('Validation failed');
            }
        }

        return $value;
    }

    /**
     * @param \Closure $assertion
     */
    protected function addAssertion(\Closure $assertion)
    {
        $this->assertions[] = $assertion;
    }
}
