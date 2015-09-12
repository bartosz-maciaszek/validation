<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ResourceSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testResourceType()
    {
        $fileHandler = fopen(__FILE__, 'r');

        V::validate($fileHandler, V::resource(), function ($err, $validated) use ($fileHandler) {
            $this->assertNull($err);
            $this->assertEquals($fileHandler, $validated);
        });

        fclose($fileHandler);

        V::validate('123', V::resource(), function ($err, $validated) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($validated);
        });

        V::validate([], V::resource(), function ($err, $validated) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($validated);
        });

        V::validate(new \stdClass(), V::resource(), function ($err, $validated) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($validated);
        });
    }
}
