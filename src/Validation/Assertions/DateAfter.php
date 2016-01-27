<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Utils;
use Validation\Validation as V;
use Validation\ValidationException;

class DateAfter extends AbstractAssertion
{
    /**
     * @param InputValue $input
     * @throws ValidationException
     */
    public function process(InputValue $input)
    {
        $isDate = new IsDate();
        $isDate->process($input);

        $date = Utils::toDateObject($input->getValue());

        $toCompare = $this->getOption('time');

        if ($date <= $toCompare) {
            throw new ValidationException('Date should be after ' . $toCompare->format(\DateTime::ISO8601));
        }
    }

    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'time' => V::date()->dateTimeObject()
        ]);
    }
}
