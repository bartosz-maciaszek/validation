<?php

namespace Validation\Tests;

use Validation\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testVaradicToArray()
    {
        $function = $this->provideVaradicFunction();

        $this->assertEquals(['abc'], $function('abc'));
        $this->assertEquals(['abc'], $function(['abc']));
        $this->assertEquals(['abc', 'def'], $function(['abc', 'def']));
        $this->assertEquals(['abc', 'def'], $function('abc', 'def'));
    }

    public function testVaradicToArrayEmptyArray()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $function = $this->provideVaradicFunction();
        $function([]);
    }

    public function testVaradicToArrayNoArgs()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $function = $this->provideVaradicFunction();
        $function();
    }

    /**
     * @return \Closure
     */
    protected function provideVaradicFunction()
    {
        return function(...$arguments) {
            return Utils::varadicToArray($arguments);
        };
    }
}
