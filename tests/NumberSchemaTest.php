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

    public function testNumberMin()
    {
        V::validate(10, V::number()->min(5), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(10, $output);
        });

        V::validate(5, V::number()->min(5), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(5, $output);
        });

        V::validate(4, V::number()->min(5), function ($err, $output) {
            $this->assertEquals('value must be >= 5', $err);
            $this->assertNull($output);
        });

        V::validate(0, V::number()->min(5), function ($err, $output) {
            $this->assertEquals('value must be >= 5', $err);
            $this->assertNull($output);
        });

        V::validate(-5, V::number()->min(5), function ($err, $output) {
            $this->assertEquals('value must be >= 5', $err);
            $this->assertNull($output);
        });
    }

    public function testNumberMax()
    {
        V::validate(-5, V::number()->max(5), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(-5, $output);
        });

        V::validate(0, V::number()->max(5), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(0, $output);
        });

        V::validate(5, V::number()->max(5), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(5, $output);
        });

        V::validate(6, V::number()->max(5), function ($err, $output) {
            $this->assertEquals('value must be <= 5', $err);
            $this->assertNull($output);
        });

        V::validate(10, V::number()->max(5), function ($err, $output) {
            $this->assertEquals('value must be <= 5', $err);
            $this->assertNull($output);
        });
    }

    public function testNumberBetween()
    {
        V::validate(0, V::number()->between(5, 10), function ($err, $output) {
            $this->assertEquals('value must be >= 5', $err);
            $this->assertNull($output);
        });

        V::validate(4, V::number()->between(5, 10), function ($err, $output) {
            $this->assertEquals('value must be >= 5', $err);
            $this->assertNull($output);
        });

        V::validate(5, V::number()->between(5, 10), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(5, $output);
        });

        V::validate(7, V::number()->between(5, 10), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(7, $output);
        });

        V::validate(10, V::number()->between(5, 10), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(10, $output);
        });

        V::validate(11, V::number()->between(5, 10), function ($err, $output) {
            $this->assertEquals('value must be <= 10', $err);
            $this->assertNull($output);
        });

        V::validate(100, V::number()->between(5, 10), function ($err, $output) {
            $this->assertEquals('value must be <= 10', $err);
            $this->assertNull($output);
        });
    }
}
