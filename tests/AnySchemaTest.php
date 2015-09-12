<?php

namespace Validation\Tests;

use Validation\Validation as V;

class AnySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testAny()
    {
        V::validate('foo', V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(123, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(123, $output);
        });

        V::validate(null, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(null, $output);
        });

        V::validate(true, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(true, $output);
        });

        V::validate([], V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([], $output);
        });
    }

    public function testAnyChain()
    {
        V::validate('string', V::any()->valid('string', 'foobar'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('string', $output);
        });

        V::validate('quux', V::any()->valid('string', 'foobar'), function ($err, $output) {
            $this->assertEquals('value "quux" is not allowed', $err);
            $this->assertNull($output);
        });
    }
}
