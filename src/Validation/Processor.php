<?php

namespace Validation;

use Validation\Assertions\AbstractAssertion;

class Processor implements Visitor
{
    /**
     * @var InputValue
     */
    private $input = null;

    /**
     * @var ValidationException[]
     */
    private $errors = null;

    /**
     * @param InputValue $input
     */
    public function __construct(InputValue $input)
    {
        $this->input = $input;
    }

    /**
     * @param Visitable|AbstractAssertion $assertion
     */
    public function visit(Visitable $assertion)
    {
        try {
            $assertion->process($this->input);
        } catch (ValidationException $e) {
            $this->errors[] = $e;
        }
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        if (count($this->errors) == 1) {
            return current($this->errors)->getMessage();
        }
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return ValidationException[]
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
