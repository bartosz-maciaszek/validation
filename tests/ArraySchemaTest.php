<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ArraySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        V::validate([], V::arr(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([], $output);
        });

        V::validate(123, V::arr(), function ($err, $output) {
            $this->assertEquals('value is not an array', $err);
            $this->assertNull($output);
        });


        V::validate('foo', V::arr(), function ($err, $output) {
            $this->assertEquals('value is not an array', $err);
            $this->assertNull($output);
        });
    }

    public function testKeys()
    {
        $input = [ 'foo' => 'bar', 'baz' => 'quux' ];

        $schema = V::arr()->keys([
            'foo' => V::string()->valid('bar'),
            'baz' => V::string()->valid('quux')
        ]);

        V::validate($input, $schema, function ($err, $output) use ($input) {
            $this->assertNull($err);
            $this->assertEquals($input, $output);
        });
    }

    public function testKeysMissingKey()
    {
        $input = [ 'foo' => 'bar' ];

        $schema = V::arr()->keys([
            'foo' => V::string(),
            'baz' => V::string()
        ]);

        V::validate($input, $schema, function ($err, $output) use ($input) {
            $this->assertEquals('key "baz" is missing', $err);
            $this->assertNull($output);
        });
    }

    public function testKeysNestedWithConversion()
    {
        $input = [ 'foo' => [ 'bar' => 'baz' ]];

        $schema = V::arr()->keys([
            'foo' => V::arr()->keys([
                'bar' => V::string()->uppercase()
            ])
        ]);

        V::validate($input, $schema, function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([ 'foo' => [ 'bar' => 'BAZ' ]], $output);
        });
    }

    public function testKeysNestedInvalid()
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

        V::validate($input, $schema, function ($err, $output) {
            $message = 'key "array" is invalid, because '
                     . '[ key "baz" is invalid, because '
                     . '[ value "quux" is not allowed ] ]';
            $this->assertEquals($message, $err);
            $this->assertNull($output);
        });
    }

    public function testArrayNotEmpty()
    {
        V::validate([1, 2, 3], V::arr()->notEmpty(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $output);
        });

        V::validate([], V::arr()->notEmpty(), function ($err, $output) {
            $this->assertEquals('value is an empty array', $err);
            $this->assertNull($output);
        });
    }

    public function testArrayLength()
    {
        V::validate([1, 2, 3], V::arr()->length(3), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $output);
        });

        V::validate([1, 2, 3], V::arr()->length(4), function ($err, $output) {
            $this->assertEquals('array length is 3, while length of 4 was expected', $err);
            $this->assertNull($output);
        });
    }

    public function testArrayMin()
    {
        V::validate([1, 2, 3], V::arr()->min(3), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $output);
        });

        V::validate([1, 2, 3, 4], V::arr()->min(3), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3, 4], $output);
        });

        V::validate([1, 2, 3], V::arr()->min(4), function ($err, $output) {
            $this->assertEquals('array needs to have at least 4 items', $err);
            $this->assertNull($output);
        });
    }

    public function testArrayMax()
    {
        V::validate([1, 2, 3], V::arr()->max(3), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $output);
        });

        V::validate([1, 2, 3], V::arr()->max(4), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([1, 2, 3], $output);
        });

        V::validate([1, 2, 3], V::arr()->max(2), function ($err, $output) {
            $this->assertEquals('array needs to have at most 2 items', $err);
            $this->assertNull($output);
        });
    }
}
