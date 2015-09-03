<?php

namespace Validation\Schema;

use Validation\Assertions;

class ObjectSchema extends AbstractSchema
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
        $this->assert(new Assertions\Instance(['of' => $className]));

        return $this;
    }
}
