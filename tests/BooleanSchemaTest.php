<?php

namespace Validation\Tests;

use Validation\Validation as V;

class BooleanSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        V::validate(true, V::boolean(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertTrue($validated);
        });

        V::validate(false, V::boolean(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertFalse($validated);
        });

        V::validate(null, V::boolean(), function ($err, $validated) {
            $this->assertEquals('value is not a boolean', $err);
            $this->assertNull($validated);
        });
    }

    public function testBooleanTrue()
    {
        V::validate(true, V::boolean()->true(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertTrue($validated);
        });

        V::validate(false, V::boolean()->true(), function ($err, $validated) {
            $this->assertEquals('value is not TRUE', $err);
            $this->assertNull($validated);
        });
    }

    public function testBooleanFalse()
    {
        V::validate(false, V::boolean()->false(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertFalse($validated);
        });

        V::validate(true, V::boolean()->false(), function ($err, $validated) {
            $this->assertEquals('value is not FALSE', $err);
            $this->assertNull($validated);
        });
    }
}
