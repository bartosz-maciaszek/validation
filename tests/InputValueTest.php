<?php

namespace Validation\Tests;

use Validation\InputValue;

class InputValueTest extends \PHPUnit_Framework_TestCase
{
    public function testCases()
    {
        $input = new InputValue('foo');

        $this->assertEquals('foo', $input->getValue());

        $input->setValue('bar');
        $this->assertEquals('bar', $input->getValue());

        $input->setValue(2);

        $input->replace(function ($value) {
            return $value * 2;
        });

        $this->assertEquals(4, $input->getValue());
    }
}
