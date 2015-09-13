<?php

namespace Validation\Tests;

use Validation\Validation as V;

class AnySchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testAny()
    {
        V::validate('foo', V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(123, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(123, $output);
        });

        V::validate(null, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(null, $output);
        });

        V::validate(true, V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(true, $output);
        });

        V::validate([], V::any(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals([], $output);
        });
    }

    public function testAnyValid()
    {
        V::validate('string', V::any()->valid('string', 'foobar'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('string', $output);
        });

        V::validate('quux', V::any()->valid('string', 'foobar'), function ($err, $output) {
            $this->assertEquals('value "quux" is not allowed', $err);
            $this->assertNull($output);
        });
    }

    public function testAnyInvalid()
    {
        V::validate('quux', V::any()->invalid('string', 'foobar'), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('quux', $output);
        });

        V::validate('string', V::any()->invalid('string', 'foobar'), function ($err, $output) {
            $this->assertEquals('value "string" is disallowed', $err);
            $this->assertNull($output);
        });
    }

    public function testAnyRequired()
    {
        V::validate('quux', V::any()->required(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('quux', $output);
        });

        V::validate(0, V::any()->required(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(0, $output);
        });

        V::validate(false, V::any()->required(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(false, $output);
        });

        V::validate('', V::any()->required(), function ($err, $output) {
            $this->assertEquals('value is required', $err);
            $this->assertNull($output);
        });

        V::validate(null, V::any()->required(), function ($err, $output) {
            $this->assertEquals('value is required', $err);
            $this->assertNull($output);
        });
    }

    public function testAnyStrip()
    {
        $input = ['foo' => 'bar', 'baz' => 'quux'];

        $schema = V::arr()->keys([
            'foo' => V::string(),
            'baz' => V::string()->strip()
        ]);

        V::validate($input, $schema, function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals(['foo' => 'bar'], $output);
        });
    }

    public function testAnyDefault()
    {
        $input = ['firstname' => 'Smok', 'lastname' => 'Wawelski'];

        $schema = V::arr()->keys([
            'username' => V::string()->defaultValue(function ($context) {
                return strtolower($context['firstname']) . '-' . strtolower($context['lastname']);
            }),
            'firstname' => V::string(),
            'lastname' => V::string(),
            'created' => V::date()->defaultValue(new \DateTime()),
            'status' => V::string()->defaultValue('registered')
        ]);

        $user = V::attempt($input, $schema);

        $this->assertEquals('smok-wawelski', $user['username']);
        $this->assertEquals('Smok', $user['firstname']);
        $this->assertEquals('Wawelski', $user['lastname']);
        $this->assertEquals((new \DateTime())->format('Y-m-d'), $user['created']->format('Y-m-d'));
        $this->assertEquals('registered', $user['status']);
    }

    public function testAnyDefaultPreset()
    {
        $input = [
            'firstname' => 'Smok',
            'lastname' => 'Wawelski',
            'username' => 'foobar',
            'created' => '2015-01-01',
            'status' => 'foo'
        ];

        $schema = V::arr()->keys([
            'username' => V::string()->defaultValue(function ($context) {
                return strtolower($context['firstname']) . '-' . strtolower($context['lastname']);
            }),
            'firstname' => V::string(),
            'lastname' => V::string(),
            'created' => V::date()->dateTimeObject()->defaultValue(new \DateTime()),
            'status' => V::string()->defaultValue('registered')
        ]);

        $user = V::attempt($input, $schema);

        $this->assertEquals('foobar', $user['username']);
        $this->assertEquals('Smok', $user['firstname']);
        $this->assertEquals('Wawelski', $user['lastname']);
        $this->assertEquals('2015-01-01 00:00:00', $user['created']->format('Y-m-d H:i:s'));
        $this->assertEquals('foo', $user['status']);
    }
}
