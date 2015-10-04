<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\InputValue;
use Validation\Processor;
use Validation\ValidationException;
use Validation\Visitable;
use Validation\Visitor;

abstract class AbstractSchema implements Visitable
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
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $processor = new Processor($input);

        $this->accept($processor);

        if ($processor->hasErrors()) {
            $exception = new ValidationException($processor->getErrorMessage());
            $exception->setErrors($processor->getErrors());
            throw $exception;
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

    /**
     * @param Visitor $visitor
     */
    public function accept(Visitor $visitor)
    {
        foreach ($this->assertions() as $assertion) {
            $assertion->accept($visitor);
        }
    }
}
