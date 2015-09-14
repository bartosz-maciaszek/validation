<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ClosureSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testClosureType()
    {
        $function = function () {
            return null;
        };

        V::validate($function, V::closure(), function ($err, $output) use ($function) {
            $this->assertNull($err);
            $this->assertEquals($function, $output);
        });

        V::validate('123', V::closure(), function ($err, $output) {
            $this->assertEquals('value is not callable', $err);
            $this->assertNull($output);
        });

        V::validate([], V::closure(), function ($err, $output) {
            $this->assertEquals('value is not callable', $err);
            $this->assertNull($output);
        });

        V::validate(new \stdClass(), V::closure(), function ($err, $output) {
            $this->assertEquals('value is not callable', $err);
            $this->assertNull($output);
        });
    }
}
