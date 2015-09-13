<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\Utils;

class AnySchema extends AbstractSchema
{
    /**
     * @param $value
     * @return $this
     */
    public function defaultValue($value)
    {
        $this->setOption('default', $value);

        return $this;
    }

    /**
     * @return $this
     */
    public function invalid()
    {
        $this->assert(new Assertions\NotInArray(['disallowed' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }

    /**
     * @return $this
     */
    public function required()
    {
        $this->assert(new Assertions\Required());

        return $this;
    }

    /**
     * @return $this
     */
    public function strip()
    {
        $this->setOption('strip', true);

        return $this;
    }

    /**
     * @return $this
     */
    public function valid()
    {
        $this->assert(new Assertions\InArray(['allowed' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }
}
