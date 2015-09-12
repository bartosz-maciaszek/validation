<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\Utils;

class AnySchema extends AbstractSchema
{
    /**
     * @return $this
     */
    public function invalid()
    {
        $this->assert(new Assertions\NotInArray(['disallowed' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }

    /**
     * @return $this
     */
    public function valid()
    {
        $this->assert(new Assertions\InArray(['allowed' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }
}
