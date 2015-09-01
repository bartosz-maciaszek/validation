<?php

namespace Validation\Schema;

use Validation\ValidationException;

abstract class AbstractSchema
{
    /**
     * @var \Closure[]
     */
    private $assertions = [];

    /**
     * @param $value
     * @throws ValidationException
     */
    public function validate($value)
    {
        foreach ($this->assertions as $assertion) {
            $value = $assertion($value);
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
