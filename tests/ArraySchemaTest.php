<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ArraySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        V::validate([], V::arr(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals([], $validated);
        });

        V::validate(123, V::arr(), function ($err, $validated) {
            $this->assertEquals('value is not an array', $err);
            $this->assertNull($validated);
        });


        V::validate('foo', V::arr(), function ($err, $validated) {
            $this->assertEquals('value is not an array', $err);
            $this->assertNull($validated);
        });
    }

    public function testKeys()
    {
        $input = [ 'foo' => 'bar', 'baz' => 'quux' ];

        $schema = V::arr()->keys([
            'foo' => V::string()->valid('bar'),
            'baz' => V::string()->valid('quux')
        ]);

        V::validate($input, $schema, function ($err, $validated) use ($input) {
            $this->assertNull($err);
            $this->assertEquals($input, $validated);
        });
    }

    public function testKeysMissing()
    {
        $input = [ 'foo' => 'bar' ];

        $schema = V::arr()->keys([
            'foo' => V::string(),
            'baz' => V::string()
        ]);

        V::validate($input, $schema, function ($err, $validated) use ($input) {
            $this->assertEquals('key "baz" is missing', $err);
            $this->assertNull($validated);
        });
    }

    public function testKeysNegative1()
    {
        $input = [ 'foo' => 'bar', 'baz' => 'quux', 'array' => [ 'foo' => 'bar', 'baz' => 'quux' ] ];

        $schema = V::arr()->keys([
            'foo' => V::string()->valid('bar'),
            'baz' => V::string()->valid('quux'),
            'array' => V::arr()->keys([
                'foo' => V::string()->valid('bar'),
                'baz' => V::string()->valid('quux1')
            ])
        ]);

        V::validate($input, $schema, function ($err, $validated) {
            $this->assertEquals('key "array" is invalid, because [ key "baz" is invalid, because [ value "quux" is not allowed ] ]', $err);
            $this->assertNull($validated);
        });
    }

    public function testArrayNotEmpty()
    {
        V::validate([1, 2, 3], V::arr()->notEmpty(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $validated);
        });

        V::validate([], V::arr()->notEmpty(), function ($err, $validated) {
            $this->assertEquals('value is an empty array', $err);
            $this->assertNull($validated);
        });
    }
}
