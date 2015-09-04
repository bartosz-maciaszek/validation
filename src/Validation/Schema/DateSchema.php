<?php

namespace Validation\Schema;

use Validation\Assertions;

class DateSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsDate());
    }
}
