<?php

namespace Validation\Tests;

use Validation\Validation as V;

class StringSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testStringType()
    {
        V::validate('string', V::string(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('string', $validated);
        });

        V::validate(123, V::string(), function ($err, $validated) {
            $this->assertEquals('value is not a string', $err);
            $this->assertNull($validated);
        });

        V::validate([], V::string(), function ($err, $validated) {
            $this->assertEquals('value is not a string', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringMin()
    {
        V::validate('foo', V::string()->min(1), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo', V::string()->min(8), function ($err, $validated) {
            $this->assertEquals('value length < 8', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringMax()
    {
        V::validate('foo', V::string()->max(10), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo', V::string()->max(1), function ($err, $validated) {
            $this->assertEquals('value length > 1', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringValid()
    {
        V::validate('foo', V::string()->valid('foo'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo', V::string()->valid('foo', 'bar'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo', V::string()->valid(['foo', 'bar']), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo', V::string()->valid('bar'), function ($err, $validated) {
            $this->assertEquals('value "foo" is not allowed', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringInvalid()
    {
        V::validate('bar', V::string()->invalid('foo'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('bar', $validated);
        });

        V::validate('bar', V::string()->invalid('foo', 'bar'), function ($err, $validated) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($validated);
        });

        V::validate('bar', V::string()->invalid(['foo', 'bar']), function ($err, $validated) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($validated);
        });

        V::validate('bar', V::string()->invalid('bar'), function ($err, $validated) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringLength()
    {
        V::validate('bar', V::string()->length(3), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('bar', $validated);
        });

        V::validate('bar', V::string()->length(5), function ($err, $validated) {
            $this->assertEquals('value length is 3, expected 5', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringRegex()
    {
        V::validate('test-123456', V::string()->regex('/test\-[0-9]+/'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('test-123456', $validated);
        });

        V::validate('test-abcdef', V::string()->regex('/test\-[0-9]+/'), function ($err, $validated) {
            $this->assertEquals('value does not match pattern /test\-[0-9]+/', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringAlphanum()
    {
        V::validate('ABCdef123', V::string()->alphanum(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCdef123', $validated);
        });

        V::validate('ABCdef!', V::string()->alphanum(), function ($err, $validated) {
            $this->assertEquals('value contains not alphanumeric chars', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringToken()
    {
        V::validate('ABCdef123', V::string()->token(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCdef123', $validated);
        });

        V::validate('ABC_def_123', V::string()->token(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABC_def_123', $validated);
        });

        V::validate('ABCdef!', V::string()->token(), function ($err, $validated) {
            $this->assertEquals('value is not a token', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringLowercase()
    {
        V::validate('abcdef', V::string()->lowercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $validated);
        });

        V::validate('AbCdEf', V::string()->lowercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $validated);
        });

        V::validate('ABCDEF', V::string()->lowercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $validated);
        });
    }

    public function testStringLowercaseWithoutConversion()
    {
        V::validate('abcdef', V::string()->lowercase(false), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $validated);
        });

        V::validate('AbCdEf', V::string()->lowercase(false), function ($err, $validated) {
            $this->assertEquals('value must be lowercase', $err);
            $this->assertNull($validated);
        });

        V::validate('ABCDEF', V::string()->lowercase(false), function ($err, $validated) {
            $this->assertEquals('value must be lowercase', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringUppercase()
    {
        V::validate('ABCDEF', V::string()->uppercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $validated);
        });

        V::validate('AbCdEf', V::string()->uppercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $validated);
        });

        V::validate('abcdef', V::string()->uppercase(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $validated);
        });
    }

    public function testStringUppercaseWithoutConversion()
    {
        V::validate('ABCDEF', V::string()->uppercase(false), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $validated);
        });

        V::validate('AbCdEf', V::string()->uppercase(false), function ($err, $validated) {
            $this->assertEquals('value must be uppercase', $err);
            $this->assertNull($validated);
        });

        V::validate('abcdef', V::string()->uppercase(false), function ($err, $validated) {
            $this->assertEquals('value must be uppercase', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringReplace()
    {
        V::validate('foobar', V::string()->replace('bar', 'baz'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foobaz', $validated);
        });

        V::validate('foobar', V::string()->replace(['foo', 'bar'], ['baz', 'quux']), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('bazquux', $validated);
        });

        V::validate('foobar', V::string()->replace(['foo', 'bar'], 'baz'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('bazbaz', $validated);
        });
    }

    public function testStringEmail()
    {
        V::validate('foo@example.com', V::string()->email(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo@example.com', $validated);
        });

        V::validate('@example.com', V::string()->email(), function ($err, $validated) {
            $this->assertEquals('"@example.com" is not a valid email', $err);
            $this->assertNull($validated);
        });

        V::validate('example.com', V::string()->email(), function ($err, $validated) {
            $this->assertEquals('"example.com" is not a valid email', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringRegexReplace()
    {
        V::validate('foobar', V::string()->regexReplace('/...$/', 'baz'), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foobaz', $validated);
        });
    }

    public function testStringIp()
    {
        V::validate('127.0.0.1', V::string()->ip(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('127.0.0.1', $validated);
        });

        V::validate('::1', V::string()->ip(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('::1', $validated);
        });

        V::validate('127.0.0.1', V::string()->ip(FILTER_FLAG_IPV6), function ($err, $validated) {
            $this->assertEquals('"127.0.0.1" is not a valid IP address', $err);
            $this->assertNull($validated);
        });

        V::validate('::1', V::string()->ip(FILTER_FLAG_IPV4), function ($err, $validated) {
            $this->assertEquals('"::1" is not a valid IP address', $err);
            $this->assertNull($validated);
        });

        V::validate('127.00.1', V::string()->ip(), function ($err, $validated) {
            $this->assertEquals('"127.00.1" is not a valid IP address', $err);
            $this->assertNull($validated);
        });

        V::validate(':1', V::string()->ip(), function ($err, $validated) {
            $this->assertEquals('":1" is not a valid IP address', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringUriSimple()
    {
        V::validate('http://localhost/', V::string()->uri(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/', $validated);
        });
    }

    public function testStringUriWithPath()
    {
        V::validate('http://localhost/dir/test.html', V::string()->uri(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html', $validated);
        });
    }

    public function testStringUriPathRequired()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED);

        V::validate('http://localhost/dir/test.html', $schema, function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html', $validated);
        });
    }

    public function testStringUriWithQs()
    {
        $schema = V::string()->uri();

        V::validate('http://localhost/dir/test.html?foo=bar', $schema, function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html?foo=bar', $validated);
        });
    }

    public function testStringUriQsRequired()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED);

        V::validate('http://localhost/dir/test.html?foo=bar', $schema, function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html?foo=bar', $validated);
        });
    }

    public function testStringUriPathRequiredNoPath()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED);

        V::validate('http://localhost', $schema, function ($err, $validated) {
            $this->assertEquals('"http://localhost" is not a valid URI', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringUriQsRequiredNoQs()
    {
        $schema = V::string()->uri(FILTER_FLAG_QUERY_REQUIRED);

        V::validate('http://localhost/', $schema, function ($err, $validated) {
            $this->assertEquals('"http://localhost/" is not a valid URI', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringUriQsRequiredWithPath()
    {
        $schema = V::string()->uri(FILTER_FLAG_QUERY_REQUIRED);
        V::validate('http://localhost/dir/test.html', $schema, function ($err, $validated) {
            $this->assertEquals('"http://localhost/dir/test.html" is not a valid URI', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringUriPlainString()
    {
        V::validate('foobar', V::string()->uri(), function ($err, $validated) {
            $this->assertEquals('"foobar" is not a valid URI', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringTrim()
    {
        V::validate('foo', V::string()->trim(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate(' foo', V::string()->trim(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate('foo ', V::string()->trim(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate(' foo ', V::string()->trim(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });
    }

    public function testStringTrimWithoutConversion()
    {
        V::validate('foo', V::string()->trim(false), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('foo', $validated);
        });

        V::validate(' foo', V::string()->trim(false), function ($err, $validated) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($validated);
        });

        V::validate('foo ', V::string()->trim(false), function ($err, $validated) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($validated);
        });

        V::validate(' foo ', V::string()->trim(false), function ($err, $validated) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($validated);
        });
    }

    public function testStringTrimInvalidOption()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'key "convert" is invalid, because [ value is not a boolean ]'
        );

        V::validate('foo', V::string()->trim('foo'), function ($err, $validated) {

        });
    }
}
