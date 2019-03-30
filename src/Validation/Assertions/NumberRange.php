<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\ValidationException;
use Validation\Validation as V;

class NumberRange extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        switch (true) {
            case $this->hasOption('min') && $this->hasOption('max'):
                $min = $this->getOption('min');
                $max = $this->getOption('max');

                if (!$this->gte($input, $min) || !$this->lte($input, $max)) {
                    throw new ValidationException(sprintf('value should be between %d and %d', $min, $max));
                }

                break;

            case $this->hasOption('min'):
                $min = $this->getOption('min');

                if ($this->gte($input, $min)) {
                    throw new ValidationException(sprintf('value should be higher than %d', $min));
                }

                break;

            case $this->hasOption('max'):
                $max = $this->getOption('max');

                if ($this->lte($input, $max)) {
                    throw new ValidationException(sprintf('value should be lower than %d', $max));
                }

                break;
        }
    }

    /**
     * @param InputValue $input
     * @param int $number
     *
     * @return bool
     */
    protected function gte(InputValue $input, int $number): bool
    {
        return $input->getValue() >= $number;
    }

    /**
     * @param InputValue $input
     * @param int $number
     *
     * @return bool
     */
    protected function lte(InputValue $input, int $number): bool
    {
        return $input->getValue() <= $number;
    }

    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'min' => V::number()
        ])
    }
}
