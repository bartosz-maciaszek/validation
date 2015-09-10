<?php

namespace Validation\Tests;

use Validation\ValidationError;
use Validation\ValidationException;

class ValidationErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testCases()
    {
        $error = new ValidationError(new ValidationException('test'));

        $this->assertEquals('test', $error->getMessage());
        $this->assertEquals('test', (string) $error);

        $error->setMessage('foobar');

        $this->assertEquals('foobar', $error->getMessage());
        $this->assertEquals('foobar', (string) $error);
    }
}
