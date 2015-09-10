<?php

namespace Validation;

class InputValue
{
    /**
     * @var mixed
     */
    private $value = null;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \Closure $callback
     */
    public function replace(\Closure $callback)
    {
        $this->setValue($callback($this->getValue()));
    }
}
