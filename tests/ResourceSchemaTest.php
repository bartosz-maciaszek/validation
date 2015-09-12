<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ResourceSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testResourceType()
    {
        $fileHandler = fopen(__FILE__, 'r');

        V::validate($fileHandler, V::resource(), function ($err, $output) use ($fileHandler) {
            $this->assertNull($err);
            $this->assertEquals($fileHandler, $output);
        });

        fclose($fileHandler);

        V::validate('123', V::resource(), function ($err, $output) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($output);
        });

        V::validate([], V::resource(), function ($err, $output) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($output);
        });

        V::validate(new \stdClass(), V::resource(), function ($err, $output) {
            $this->assertEquals('value is not a resource', $err);
            $this->assertNull($output);
        });
    }
}
