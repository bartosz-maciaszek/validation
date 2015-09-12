<?php

namespace Validation\Schema;

use Validation\Assertions;

class ResourceSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsResource());
    }
}
