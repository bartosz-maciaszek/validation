<?php

namespace Validation\Schema;

class StringSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->addAssertion(function($value) {
            return is_string($value);
        });
    }

    public function min($number)
    {
        $this->addAssertion(function($value) use ($number) {
            return strlen($value) >= $number;
        });

        return $this;
    }

    public function max($number)
    {
        $this->addAssertion(function($value) use ($number) {
            return strlen($value) <= $number;
        });

        return $this;
    }

    public function valid(...$arguments)
    {
        $validValues = $arguments;

        if (count($arguments) === 1) {
            $arg = current($arguments);

            if (is_array($arg)) {
                $validValues = $arg;
            }
            elseif (is_string($arg)) {
                $validValues = [$arg];
            }
        }

        $this->addAssertion(function($value) use ($validValues) {

            foreach ($validValues as $val) {
                if ($value === $val) {
                    return true;
                }
            }

            return false;
        });

        return $this;
    }
}
