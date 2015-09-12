<?php

namespace Validation\Schema;

use Validation\Assertions;

class BooleanSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsBoolean());
    }

    /**
     * @return $this
     */
    public function false()
    {
        $this->assert(new Assertions\BooleanFalse());

        return $this;
    }

    /**
     * @return $this
     */
    public function true()
    {
        $this->assert(new Assertions\BooleanTrue());

        return $this;
    }
}
