<?php

namespace Validation\Tests;

use Validation\Validation as V;
use Validation\ValidationException;

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

    public function testAfter()
    {
        V::validate('2015-06-01', V::date()->after('2015-05-30'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:01', V::date()->after('2015-06-01 06:00:00'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:00', V::date()->after('2015-06-01 06:00:00'), function ($err, $output) {
            $this->assertNull($output);
            /** @var ValidationException $err */
            $this->assertContains('Date should be after', $err->getMessage());
        });
    }

    public function testBefore()
    {
        V::validate('2015-05-30', V::date()->before('2015-06-01'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:00', V::date()->before('2015-06-01 06:00:01'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:00', V::date()->before('2015-06-01 06:00:00'), function ($err, $output) {
            $this->assertNull($output);
            /** @var ValidationException $err */
            $this->assertContains('Date should be before', $err->getMessage());
        });
    }

    public function testBetween()
    {
        V::validate('2015-05-30', V::date()->between('2015-05-01', '2015-06-01'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:00', V::date()->between('2015-06-01 05:59:59', '2015-06-01 06:00:01'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 06:00:00', V::date()->between('2015-06-01 06:00:00', '2015-06-01 07:00:00'), function ($err, $output) {
            $this->assertNotNull($output);
            $this->assertNull($err);
        });

        V::validate('2015-06-01 05:00:00', V::date()->between('2015-06-01 06:00:00', '2015-06-01 07:00:00'), function ($err, $output) {
            $this->assertNull($output);
            /** @var ValidationException $err */
            $this->assertContains('Date should be between', $err->getMessage());
        });
    }
}
