<?php

namespace Validation\Schema;

use Validation\Assertions;

class NumberSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsNumber());
    }
}
