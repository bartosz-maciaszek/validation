<?php

namespace Validation\Tests;

use Validation\Validation as V;

class ValidationTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateWithCallbackPositive()
    {
        V::validate('string', V::string(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('string', $validated);
        });
    }

    public function testValidateWithCallbackNegative()
    {
        V::validate('string', V::number(), function ($err, $validated) {
            $this->assertEquals('value is not a number', (string) $err);
            $this->assertNull($validated);
        });
    }

    public function testValidateWithoutCallbackPositive()
    {
        $result = V::validate('string', V::string());

        $this->assertArrayHasKey('err', $result);
        $this->assertArrayHasKey('validated', $result);

        $this->assertNull($result['err']);
        $this->assertEquals('string', $result['validated']);
    }

    public function testValidateWithoutCallbackNegative()
    {
        $result = V::validate('string', V::number());

        $this->assertArrayHasKey('err', $result);
        $this->assertArrayHasKey('validated', $result);

        $this->assertEquals('value is not a number', (string) $result['err']);
        $this->assertNull($result['validated']);
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
