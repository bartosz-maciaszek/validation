<?php

namespace Validation\Schema;

use Validation\Assertions;

class ResourceSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsResource());
    }
}
