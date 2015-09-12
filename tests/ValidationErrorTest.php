<?php

namespace Validation\Tests;

use Validation\ValidationException;

class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testCases()
    {
        $error = new ValidationException('test');

        $this->assertEquals('test', $error->getMessage());
        $this->assertEquals('test', (string) $error);
        $this->assertEquals('test', $error);
    }
}
