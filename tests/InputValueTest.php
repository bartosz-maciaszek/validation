<?php

namespace Validation\Tests;

use Validation\InputValue;

class InputValueTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultValues()
    {
        $input = new InputValue('foo');

        $this->assertEquals('foo', $input->getValue());
        $this->assertFalse(false, $input->isOptional());

        $input->setValue('bar');
        $this->assertEquals('bar', $input->getValue());

        $input->setOptional(true);
        $this->assertTrue($input->isOptional());

        $input->setOptional(false);
        $this->assertFalse($input->isOptional());

        $input->setOptional('foo');
        $this->assertTrue($input->isOptional());

        $input->setOptional(0);
        $this->assertFalse($input->isOptional());

        $input->setValue(2);

        $input->replace(function($value) {
            return $value * 2;
        });

        $this->assertEquals(4, $input->getValue());
    }
}
