<?php

namespace Validation;

class InputValue
{
    /**
     * @var mixed
     */
    private $value = null;

    /**
     * @var bool
     */
    private $optional = false;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->setOptional($value);
    }

    /**
     * @param boolean $flag
     */
    public function setOptional($flag)
    {
        $this->optional = (boolean) $flag;
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
