<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\Utils;

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
     * @param $length
     * @return $this
     */
    public function length($length)
    {
        $this->assert(new Assertions\ArrayLength(['length' => $length]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function max($length)
    {
        $this->assert(new Assertions\ArrayLengthMax(['length' => $length]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function min($length)
    {
        $this->assert(new Assertions\ArrayLengthMin(['length' => $length]));

        return $this;
    }

    /**
     * @return $this
     */
    public function notEmpty()
    {
        $this->assert(new Assertions\ArrayNotEmpty());

        return $this;
    }
}
