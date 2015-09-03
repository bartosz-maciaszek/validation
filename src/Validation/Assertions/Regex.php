<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Schema\AbstractSchema;
use Validation\Validation;
use Validation\ValidationException;

class Regex extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $pattern = $this->getOption('pattern');
        $message = $this->getOption('message', sprintf('value does not match pattern %s', $pattern));

        if (!preg_match($this->getOption('pattern'), $input->getValue())) {
            throw new ValidationException($message);
        }
    }

    /**
     * @return AbstractSchema
     */
    protected function getOptionsSchema()
    {
        return Validation::arr()->keys([
            'pattern' => Validation::string(),
//            'message' => Validation::string()->optional()
        ]);
    }
}