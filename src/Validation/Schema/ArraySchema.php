<?php

namespace Validation\Schema;

use Validation\Assertions;

class ArraySchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsArray());
    }

    /**
     * @param array $keys
     * @return $this
     */
    public function keys(array $keys)
    {
        $this->assert(new Assertions\ArrayKeys(['keys' => $keys]));

        return $this;
    }

    /**
     * @return $this
     */
    public function notEmpty()
    {
        $this->assert(new Assertions\NotEmptyArray());

        return $this;
    }
}
