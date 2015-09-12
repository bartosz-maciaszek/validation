<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateWithCallbackPositive()
    {
        V::validate('string', V::string(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('string', $output);
        });
    }

    public function testValidateWithCallbackNegative()
    {
        V::validate('string', V::number(), function ($err, $output) {
            $this->assertEquals('value is not a number', (string) $err);
            $this->assertNull($output);
        });
    }

    public function testValidateWithoutCallbackPositive()
    {
        $result = V::validate('string', V::string());

        $this->assertArrayHasKey('err', $result);
        $this->assertArrayHasKey('output', $result);

        $this->assertNull($result['err']);
        $this->assertEquals('string', $result['output']);
    }

    public function testValidateWithoutCallbackNegative()
    {
        $result = V::validate('string', V::number());

        $this->assertArrayHasKey('err', $result);
        $this->assertArrayHasKey('output', $result);

        $this->assertEquals('value is not a number', (string) $result['err']);
        $this->assertNull($result['output']);
    }

    public function testAssertPositive()
    {
        V::assert('string', V::string());
    }

    public function testAssertNegative()
    {
        $this->setExpectedException('\Validation\ValidationException');

        V::assert('string', V::number());
    }
}
