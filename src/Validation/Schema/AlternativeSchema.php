<?php

namespace Validation\Schema;

use Validation\InputValue;
use Validation\ValidationException;

class AlternativeSchema extends AbstractSchema
{
    /**
     * @param array $assertions
     */
    public function __construct(array $assertions)
    {
        $this->assertAll($assertions);
    }

    /**
     * @param InputValue $input
     * @return mixed
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        foreach ($this->assertions() as $assertion) {
            try {
                $assertion->process($input);
                return $input->getValue();
            } catch (ValidationException $e) {
            }
        }

        throw new ValidationException('none of the alternatives matched');
    }
}
