<?php

namespace Validation\Assertions;

use Validation\InputValue;
use Validation\Utils;
use Validation\Validation as V;
use Validation\ValidationException;

class DateBetween extends AbstractAssertion
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

        $time1 = $this->getOption('time1');
        $time2 = $this->getOption('time2');

        if ($date < $time1 || $date > $time2 ) {
            throw new ValidationException('Date should be between '
                . $time1->format(\DateTime::ISO8601) . ' and '
                . $time2->format(\DateTime::ISO8601));
        }
    }

    protected function getOptionsSchema()
    {
        return V::arr()->keys([
            'time1' => V::date()->dateTimeObject(),
            'time2' => V::date()->dateTimeObject()
        ]);
    }
}
