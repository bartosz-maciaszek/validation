<?php

namespace Validation\Schema;

use Validation\Assertions;

class NumberSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsNumber());
    }

    public function integer()
    {
        $this->assert(new Assertions\IsInteger());

        return $this;
    }

    public function float()
    {
        $this->assert(new Assertions\IsFloat());

        return $this;
    }
}
