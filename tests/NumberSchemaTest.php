<?php

namespace Validation\Tests;

use Validation\Validation as V;

class NumberSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testNumberType()
    {
        V::validate(123, V::number(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(123, $validated);
        });

        V::validate(1.23, V::number(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(1.23, $validated);
        });

        V::validate('123', V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });

        V::validate('1.23', V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });

        V::validate(null, V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });

        V::validate(false, V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });

        V::validate([], V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });

        V::validate(new \stdClass(), V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($validated);
        });
    }

    public function testNumberInteger()
    {
        V::validate(123, V::number()->integer(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(123, $validated);
        });

        V::validate(1.23, V::number()->integer(), function ($err, $validated) {
            $this->assertEquals('value is not an integer', $err);
            $this->assertNull($validated);
        });
    }

    public function testNumberFloat()
    {
        V::validate(1.23, V::number()->float(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals(1.23, $validated);
        });

        V::validate(123, V::number()->float(), function ($err, $validated) {
            $this->assertEquals('value is not a float', $err);
            $this->assertNull($validated);
        });
    }
}
