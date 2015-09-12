<?php

namespace Validation\Tests;

use Validation\Validation as V;

class AnySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testAny()
    {
        V::validate('foo', V::any(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate(null, V::any(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(null, $validated);
        });

        V::validate(true, V::any(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(true, $validated);
        });

        V::validate([], V::any(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals([], $validated);
        });
    }
}
