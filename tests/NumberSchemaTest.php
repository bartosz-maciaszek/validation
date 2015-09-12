<?php

namespace Validation\Tests;

use Validation\Validation as V;

class NumberSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testNumberType()
    {
        V::validate(123, V::number(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(123, $output);
        });

        V::validate(1.23, V::number(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(1.23, $output);
        });

        V::validate('123', V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });

        V::validate('1.23', V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });

        V::validate(null, V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });

        V::validate(false, V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });

        V::validate([], V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });

        V::validate(new \stdClass(), V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', $err);
            $this->assertNull($output);
        });
    }

    public function testNumberInteger()
    {
        V::validate(123, V::number()->integer(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(123, $output);
        });

        V::validate(1.23, V::number()->integer(), function ($err, $output) {
            $this->assertEquals('value is not an integer', $err);
            $this->assertNull($output);
        });
    }

    public function testNumberFloat()
    {
        V::validate(1.23, V::number()->float(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(1.23, $output);
        });

        V::validate(123, V::number()->float(), function ($err, $output) {
            $this->assertEquals('value is not a float', $err);
            $this->assertNull($output);
        });
    }
}
