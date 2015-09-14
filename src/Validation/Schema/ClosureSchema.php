<?php

namespace Validation\Schema;

use Validation\Assertions;

class ClosureSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsCallable());
    }
}
