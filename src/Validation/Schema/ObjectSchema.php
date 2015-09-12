<?php

namespace Validation\Schema;

use Validation\Assertions;

class ObjectSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsObject());
    }

    /**
     * @param $className
     * @return $this
     */
    public function instance($className)
    {
        $this->assert(new Assertions\ObjectInstanceOf(['of' => $className]));

        return $this;
    }
}
