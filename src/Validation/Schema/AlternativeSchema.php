<?php

namespace Validation\Schema;

use Validation\Utils;
use Validation\Assertions;

class AlternativeSchema extends AnySchema
{
    /**
     * @return $this
     */
    public function any()
    {
        $this->assert(new Assertions\AlternativeAny(['options' => Utils::variadicToArray(func_get_args())]));

        return $this;
    }
}
