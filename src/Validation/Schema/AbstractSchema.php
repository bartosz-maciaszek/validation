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
     * @param Assertions\AbstractAssertion[] $assertions
     */
    protected function assertAll(array $assertions)
    {
        $this->assertions = array_merge($this->assertions, $assertions);
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
    public function valid()
    {
        $this->assert(new Assertions\InArray(['allowed' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }
}
