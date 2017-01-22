<?php

namespace Validation\Tests;

use Validation\Validation as V;

class StringSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testStringType()
    {
        V::validate('string', V::string(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('string', $output);
        });

        V::validate(123, V::string(), function ($err, $output) {
            $this->assertEquals('value is not a string', $err);
            $this->assertNull($output);
        });

        V::validate([], V::string(), function ($err, $output) {
            $this->assertEquals('value is not a string', $err);
            $this->assertNull($output);
        });
    }

    public function testStringMin()
    {
        V::validate('foo', V::string()->min(1), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo', V::string()->min(8), function ($err, $output) {
            $this->assertEquals('value length < 8', $err);
            $this->assertNull($output);
        });
    }

    public function testStringMax()
    {
        V::validate('foo', V::string()->max(10), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo', V::string()->max(1), function ($err, $output) {
            $this->assertEquals('value length > 1', $err);
            $this->assertNull($output);
        });
    }

    public function testStringValid()
    {
        V::validate('foo', V::string()->valid('foo'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo', V::string()->valid('foo', 'bar'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo', V::string()->valid(['foo', 'bar']), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo', V::string()->valid('bar'), function ($err, $output) {
            $this->assertEquals('value "foo" is not allowed', $err);
            $this->assertNull($output);
        });
    }

    public function testStringInvalid()
    {
        V::validate('bar', V::string()->invalid('foo'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('bar', $output);
        });

        V::validate('bar', V::string()->invalid('foo', 'bar'), function ($err, $output) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($output);
        });

        V::validate('bar', V::string()->invalid(['foo', 'bar']), function ($err, $output) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($output);
        });

        V::validate('bar', V::string()->invalid('bar'), function ($err, $output) {
            $this->assertEquals('value "bar" is disallowed', $err);
            $this->assertNull($output);
        });
    }

    public function testStringLength()
    {
        V::validate('bar', V::string()->length(3), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('bar', $output);
        });

        V::validate('bar', V::string()->length(5), function ($err, $output) {
            $this->assertEquals('value length is 3, expected 5', $err);
            $this->assertNull($output);
        });
    }

    public function testStringRegex()
    {
        V::validate('test-123456', V::string()->regex('/test\-[0-9]+/'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('test-123456', $output);
        });

        V::validate('test-abcdef', V::string()->regex('/test\-[0-9]+/'), function ($err, $output) {
            $this->assertEquals('value does not match pattern /test\-[0-9]+/', $err);
            $this->assertNull($output);
        });
    }

    public function testStringAlphanum()
    {
        V::validate('ABCdef123', V::string()->alphanum(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCdef123', $output);
        });

        V::validate('ABCdef!', V::string()->alphanum(), function ($err, $output) {
            $this->assertEquals('value contains not alphanumeric chars', $err);
            $this->assertNull($output);
        });
    }

    public function testStringToken()
    {
        V::validate('ABCdef123', V::string()->token(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCdef123', $output);
        });

        V::validate('ABC_def_123', V::string()->token(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABC_def_123', $output);
        });

        V::validate('ABCdef!', V::string()->token(), function ($err, $output) {
            $this->assertEquals('value is not a token', $err);
            $this->assertNull($output);
        });
    }

    public function testStringLowercase()
    {
        V::validate('abcdef', V::string()->lowercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $output);
        });

        V::validate('AbCdEf', V::string()->lowercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $output);
        });

        V::validate('ABCDEF', V::string()->lowercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $output);
        });
    }

    public function testStringLowercaseWithoutConversion()
    {
        V::validate('abcdef', V::string()->lowercase(false), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('abcdef', $output);
        });

        V::validate('AbCdEf', V::string()->lowercase(false), function ($err, $output) {
            $this->assertEquals('value must be lowercase', $err);
            $this->assertNull($output);
        });

        V::validate('ABCDEF', V::string()->lowercase(false), function ($err, $output) {
            $this->assertEquals('value must be lowercase', $err);
            $this->assertNull($output);
        });
    }

    public function testStringUppercase()
    {
        V::validate('ABCDEF', V::string()->uppercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $output);
        });

        V::validate('AbCdEf', V::string()->uppercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $output);
        });

        V::validate('abcdef', V::string()->uppercase(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $output);
        });
    }

    public function testStringUppercaseWithoutConversion()
    {
        V::validate('ABCDEF', V::string()->uppercase(false), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('ABCDEF', $output);
        });

        V::validate('AbCdEf', V::string()->uppercase(false), function ($err, $output) {
            $this->assertEquals('value must be uppercase', $err);
            $this->assertNull($output);
        });

        V::validate('abcdef', V::string()->uppercase(false), function ($err, $output) {
            $this->assertEquals('value must be uppercase', $err);
            $this->assertNull($output);
        });
    }

    public function testStringReplace()
    {
        V::validate('foobar', V::string()->replace('bar', 'baz'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foobaz', $output);
        });

        V::validate('foobar', V::string()->replace(['foo', 'bar'], ['baz', 'quux']), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('bazquux', $output);
        });

        V::validate('foobar', V::string()->replace(['foo', 'bar'], 'baz'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('bazbaz', $output);
        });

        exit;
    }

    public function testStringEmail()
    {
        V::validate('foo@example.com', V::string()->email(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo@example.com', $output);
        });

        V::validate('@example.com', V::string()->email(), function ($err, $output) {
            $this->assertEquals('"@example.com" is not a valid email', $err);
            $this->assertNull($output);
        });

        V::validate('example.com', V::string()->email(), function ($err, $output) {
            $this->assertEquals('"example.com" is not a valid email', $err);
            $this->assertNull($output);
        });
    }

    public function testStringRegexReplace()
    {
        V::validate('foobar', V::string()->regexReplace('/...$/', 'baz'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foobaz', $output);
        });
    }

    public function testStringIp()
    {
        V::validate('127.0.0.1', V::string()->ip(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('127.0.0.1', $output);
        });

        V::validate('::1', V::string()->ip(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('::1', $output);
        });

        V::validate('127.0.0.1', V::string()->ip(FILTER_FLAG_IPV6), function ($err, $output) {
            $this->assertEquals('"127.0.0.1" is not a valid IP address', $err);
            $this->assertNull($output);
        });

        V::validate('::1', V::string()->ip(FILTER_FLAG_IPV4), function ($err, $output) {
            $this->assertEquals('"::1" is not a valid IP address', $err);
            $this->assertNull($output);
        });

        V::validate('127.00.1', V::string()->ip(), function ($err, $output) {
            $this->assertEquals('"127.00.1" is not a valid IP address', $err);
            $this->assertNull($output);
        });

        V::validate(':1', V::string()->ip(), function ($err, $output) {
            $this->assertEquals('":1" is not a valid IP address', $err);
            $this->assertNull($output);
        });
    }

    public function testStringUriSimple()
    {
        V::validate('http://localhost/', V::string()->uri(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/', $output);
        });
    }

    public function testStringUriWithPath()
    {
        V::validate('http://localhost/dir/test.html', V::string()->uri(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html', $output);
        });
    }

    public function testStringUriPathRequired()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED);

        V::validate('http://localhost/dir/test.html', $schema, function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html', $output);
        });
    }

    public function testStringUriWithQs()
    {
        $schema = V::string()->uri();

        V::validate('http://localhost/dir/test.html?foo=bar', $schema, function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html?foo=bar', $output);
        });
    }

    public function testStringUriQsRequired()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED);

        V::validate('http://localhost/dir/test.html?foo=bar', $schema, function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('http://localhost/dir/test.html?foo=bar', $output);
        });
    }

    public function testStringUriPathRequiredNoPath()
    {
        $schema = V::string()->uri(FILTER_FLAG_PATH_REQUIRED);

        V::validate('http://localhost', $schema, function ($err, $output) {
            $this->assertEquals('"http://localhost" is not a valid URI', $err);
            $this->assertNull($output);
        });
    }

    public function testStringUriQsRequiredNoQs()
    {
        $schema = V::string()->uri(FILTER_FLAG_QUERY_REQUIRED);

        V::validate('http://localhost/', $schema, function ($err, $output) {
            $this->assertEquals('"http://localhost/" is not a valid URI', $err);
            $this->assertNull($output);
        });
    }

    public function testStringUriQsRequiredWithPath()
    {
        $schema = V::string()->uri(FILTER_FLAG_QUERY_REQUIRED);
        V::validate('http://localhost/dir/test.html', $schema, function ($err, $output) {
            $this->assertEquals('"http://localhost/dir/test.html" is not a valid URI', $err);
            $this->assertNull($output);
        });
    }

    public function testStringUriPlainString()
    {
        V::validate('foobar', V::string()->uri(), function ($err, $output) {
            $this->assertEquals('"foobar" is not a valid URI', $err);
            $this->assertNull($output);
        });
    }

    public function testStringTrim()
    {
        V::validate('foo', V::string()->trim(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(' foo', V::string()->trim(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('foo ', V::string()->trim(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(' foo ', V::string()->trim(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });
    }

    public function testStringTrimWithoutConversion()
    {
        V::validate('foo', V::string()->trim(false), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(' foo', V::string()->trim(false), function ($err, $output) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($output);
        });

        V::validate('foo ', V::string()->trim(false), function ($err, $output) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($output);
        });

        V::validate(' foo ', V::string()->trim(false), function ($err, $output) {
            $this->assertEquals('value is not trimmed', $err);
            $this->assertNull($output);
        });
    }

    public function testStringTrimInvalidOption()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'key "convert" is invalid, because [ value is not a boolean ]'
        );

        V::assert('foo', V::string()->trim('foo'));
    }

    public function testStringNotEmpty()
    {
        V::validate('foo', V::string()->notEmpty(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate('', V::string()->notEmpty(), function ($err, $output) {
            $this->assertEquals('value length < 1', $err);
            $this->assertNull($output);
        });
    }
}
