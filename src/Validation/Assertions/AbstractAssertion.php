<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation as V;
use Validation\ValidationException;

abstract class AbstractAssertion
{
    /**
     * @var array
     */
    private $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }

    /**
     * @param $name
     * @param mixed $default
     * @return mixed
     */
    public function getOption($name, $default = null)
    {
        if (!isset($this->options[$name])) {
            return $default;
        }

        return $this->options[$name];
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options)
    {
        if ($schema = $this->getOptionsSchema()) {
            try {
                $this->options = V::attempt($options, $schema);
            } catch (ValidationException $e) {
                throw new \InvalidArgumentException($e);
            }
        } else {
            $this->options = $options;
        }
    }

    /**
     * @return AbstractSchema|null
     */
    protected function getOptionsSchema()
    {
        return null;
    }

    /**
     * @param InputValue $input
     */
    abstract public function process(InputValue $input);
}
