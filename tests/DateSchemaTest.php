<?php

namespace Validation\Tests;

use Validation\Validation as V;

class DateSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testDateType()
    {
        V::validate('2015-01-01', V::date(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('2015-01-01', $validated);
        });

        V::validate('2004-02-12T15:19:21+00:00', V::date(), function ($err, $validated) {
            $this->assertNull($err);
            $this->assertEquals('2004-02-12T15:19:21+00:00', $validated);
        });

        $dateTime = new \DateTime();
        V::validate($dateTime, V::date(), function($err, $validated) use ($dateTime) {
            $this->assertNull($err);
            $this->assertEquals($dateTime, $validated);
        });

        V::validate('123', V::date(), function ($err, $validated) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($validated);
        });

        V::validate([], V::date(), function ($err, $validated) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($validated);
        });

        V::validate(new \stdClass(), V::date(), function ($err, $validated) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($validated);
        });
    }

    public function testDateConvertToObject()
    {
        V::validate('2015-01-01', V::date()->dateTimeObject(), function($err, $validated) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $validated);

            /** @var \DateTime $validated */
            $this->assertEquals('2015-01-01', $validated->format('Y-m-d'));
        });

        $dateTime = new \DateTime();

        V::validate($dateTime, V::date()->dateTimeObject(), function($err, $validated) use ($dateTime) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $validated);

            /** @var \DateTime $validated */
            $this->assertEquals($dateTime->format('Y-m-d'), $validated->format('Y-m-d'));
        });
    }

    public function testDateConvertToObjectWithoutConversion()
    {
        $dateTime = new \DateTime();

        V::validate($dateTime, V::date()->dateTimeObject(false), function($err, $validated) use ($dateTime) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $validated);

            /** @var \DateTime $validated */
            $this->assertEquals($dateTime->format('Y-m-d'), $validated->format('Y-m-d'));
        });

        V::validate('2015-01-01', V::date()->dateTimeObject(false), function($err, $validated) {
            $this->assertEquals('value is not a DateTime object', $err);
            $this->assertNull($validated);
        });
    }
}
