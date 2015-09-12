<?php

namespace Validation\Tests;

use Validation\Validation as V;

class BooleanSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testObjectType()
    {
        V::validate(true, V::boolean(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertTrue($output);
        });

        V::validate(false, V::boolean(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertFalse($output);
        });

        V::validate(null, V::boolean(), function ($err, $output) {
            $this->assertEquals('value is not a boolean', $err);
            $this->assertNull($output);
        });
    }

    public function testBooleanTrue()
    {
        V::validate(true, V::boolean()->true(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertTrue($output);
        });

        V::validate(false, V::boolean()->true(), function ($err, $output) {
            $this->assertEquals('value is not TRUE', $err);
            $this->assertNull($output);
        });
    }

    public function testBooleanFalse()
    {
        V::validate(false, V::boolean()->false(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertFalse($output);
        });

        V::validate(true, V::boolean()->false(), function ($err, $output) {
            $this->assertEquals('value is not FALSE', $err);
            $this->assertNull($output);
        });
    }
}
