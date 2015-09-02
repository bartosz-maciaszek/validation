<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ArraySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        V::validate([], V::arr(), function($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals([], $validated);
        });

        V::validate(123, V::arr(), function($err, $validated) {
            $this->assertEquals('value is not an array', $err);
            $this->assertNull($validated);
        });


        V::validate('foo', V::arr(), function($err, $validated) {
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

        V::validate($input, $schema, function($err, $validated) use ($input) {
            $this->assertNull($err);
            $this->assertEquals($input, $validated);
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

        V::validate($input, $schema, function($err, $validated) {
            $this->assertEquals('"array" is invalid, because [ "baz" is invalid, because [ "quux" is not allowed ] ]', $err);
            $this->assertNull($validated);
        });
    }
}
