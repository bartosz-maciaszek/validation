<?php

namespace Validation\Schema;

use Validation\Assertions;

class NumberSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsNumber());
    }

    /**
     * @return $this
     */
    public function integer()
    {
        $this->assert(new Assertions\IsInteger());

        return $this;
    }

    /**
     * @return $this
     */
    public function float()
    {
        $this->assert(new Assertions\IsFloat());

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function min($number)
    {
        $this->assert(new Assertions\NumberMin(['number' => $number]));

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function max($number)
    {
        $this->assert(new Assertions\NumberMax(['number' => $number]));

        return $this;
    }

    /**
     * @param $min
     * @param $max
     * @return $this
     */
    public function between($min, $max)
    {
        $this->min($min);
        $this->max($max);

        return $this;
    }
}
