<?php

namespace Validation\Tests;

use Validation\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testVaradicToArray()
    {
        $function = $this->provideVariadicFunction();

        $this->assertEquals(['abc'], $function('abc'));
        $this->assertEquals(['abc'], $function(['abc']));
        $this->assertEquals(['abc', 'def'], $function(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $function('abc', 'def'));
    }

    public function testVariadicToArrayEmptyArray()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $function = $this->provideVariadicFunction();
        $function([]);
    }

    public function testVariadicToArrayNoArgs()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $function = $this->provideVariadicFunction();
        $function();
    }

    /**
     * @return \Closure
     */
    protected function provideVariadicFunction()
    {
        return function (...$arguments) {
            return Utils::variadicToArray($arguments);
        };
    }
}
