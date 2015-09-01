<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ObjectSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        $instance = new \stdClass();

        V::validate($instance, V::object(), function($err, $validated) use ($instance) {
            $this->assertNull($err);
            $this->assertEquals($instance, $validated);
        });

        V::validate(123, V::object(), function($err, $validated) {
            $this->assertEquals('value is not an object', $err);
            $this->assertNull($validated);
        });

        V::validate([], V::object(), function($err, $validated) {
            $this->assertEquals('value is not an object', $err);
            $this->assertNull($validated);
        });

        V::validate('foo', V::object(), function($err, $validated) {
            $this->assertEquals('value is not an object', $err);
            $this->assertNull($validated);
        });
    }

    public function testObjectInstance()
    {
        $instance = new \DateTime();

        V::validate($instance, V::object()->instance('\DateTime'), function($err, $validated) use ($instance) {
            $this->assertNull($err);
            $this->assertEquals($instance, $validated);
        });

        V::validate(new \stdClass(), V::object()->instance('\DateTime'), function($err, $validated) {
            $this->assertEquals('object is not an instance of \DateTime', $err);
            $this->assertNull($validated);
        });
    }
}
