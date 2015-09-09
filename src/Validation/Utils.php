<?php

namespace Validation;

class Utils
{
    /**
     * @param array $arguments
     * @return array
     */
    public static function variadicToArray(array $arguments)
    {
        if (count($arguments) === 0) {
            throw new \InvalidArgumentException('Argument needs to be a not empty array');
        }

        if (count($arguments) > 1) {
            return $arguments;
        }

        $arg = current($arguments);

        if (is_array($arg)) {
            if (count($arg) === 0) {
                throw new \InvalidArgumentException('Argument needs to be a not empty array');
            }

            return $arg;
        }

        return [$arg];
    }
}
