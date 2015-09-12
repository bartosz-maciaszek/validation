<?php

namespace Validation\Tests;

use Validation\Validation as V;

class DateSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testDateType()
    {
        V::validate('2015-01-01', V::date(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('2015-01-01', $output);
        });

        V::validate('2004-02-12T15:19:21+00:00', V::date(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('2004-02-12T15:19:21+00:00', $output);
        });

        $dateTime = new \DateTime();
        V::validate($dateTime, V::date(), function ($err, $output) use ($dateTime) {
            $this->assertNull($err);
            $this->assertEquals($dateTime, $output);
        });

        V::validate('123', V::date(), function ($err, $output) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($output);
        });

        V::validate([], V::date(), function ($err, $output) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($output);
        });

        V::validate(new \stdClass(), V::date(), function ($err, $output) {
            $this->assertEquals('value is not a date', $err);
            $this->assertNull($output);
        });
    }

    public function testDateConvertToObject()
    {
        V::validate('2015-01-01', V::date()->dateTimeObject(), function ($err, $output) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $output);

            /** @var \DateTime $output */
            $this->assertEquals('2015-01-01', $output->format('Y-m-d'));
        });

        $dateTime = new \DateTime();

        V::validate($dateTime, V::date()->dateTimeObject(), function ($err, $output) use ($dateTime) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $output);

            /** @var \DateTime $output */
            $this->assertEquals($dateTime->format('Y-m-d'), $output->format('Y-m-d'));
        });
    }

    public function testDateConvertToObjectWithoutConversion()
    {
        $dateTime = new \DateTime();

        V::validate($dateTime, V::date()->dateTimeObject(false), function ($err, $output) use ($dateTime) {
            $this->assertNull($err);
            $this->assertInstanceOf('\DateTime', $output);

            /** @var \DateTime $output */
            $this->assertEquals($dateTime->format('Y-m-d'), $output->format('Y-m-d'));
        });

        V::validate('2015-01-01', V::date()->dateTimeObject(false), function ($err, $output) {
            $this->assertEquals('value is not a DateTime object', $err);
            $this->assertNull($output);
        });
    }
}
