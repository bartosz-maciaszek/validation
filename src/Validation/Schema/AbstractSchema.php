<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\InputValue;
use Validation\Utils;

abstract class AbstractSchema
{
    /**
     * @var Assertions\AbstractAssertion[]
     */
    private $assertions = [];

    /**
     * @var array
     */
    private $options = [
        'strip' => false,
        'default' => null
    ];

    /**
     * @param InputValue $input
     * @return mixed
     */
    public function process(InputValue $input)
    {
        foreach ($this->assertions() as $assertion) {
            $assertion->process($input);
        }

        return $input->getValue();
    }

    /**
     * @return Assertions\AbstractAssertion[]
     */
    protected function assertions()
    {
        return $this->assertions;
    }

    /**
     * @param Assertions\AbstractAssertion $assertion
     */
    protected function assert(Assertions\AbstractAssertion $assertion)
    {
        $this->assertions[] = $assertion;
    }

    /**
     * @param $name
     * @param $value
     */
    protected function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getOption($name)
    {
        return $this->options[$name];
    }
}
