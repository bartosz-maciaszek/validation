<?php

namespace Validation\Tests;

use Validation\Validation as V;

class AlternativeSchemaTest extends \PHPUnit_Framework_TestCase
{
    public function testAlternative()
    {
        V::validate('foo', V::alternative()->any(V::string()->valid('foo'), V::boolean()), function ($err, $output) {
            $this->assertNull($err);
            $this->assertEquals('foo', $output);
        });

        V::validate(true, V::alternative()->any(V::string()->valid('foo'), V::boolean()), function ($err, $output) {
            $this->assertNull($err);
            $this->assertTrue(true, $output);
        });

        V::validate(null, V::alternative()->any(V::string()->valid('foo'), V::boolean()), function ($err, $output) {
            $this->assertEquals('none of the alternatives matched', $err);
            $this->assertNull($output);
        });
    }
}
