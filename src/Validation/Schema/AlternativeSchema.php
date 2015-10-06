<?php

namespace Validation\Schema;

use Validation\Utils;
use Validation\Assertions;

class AlternativeSchema extends AnySchema
{
    /**
     * @param ...$arguments
     * @return $this
     */
    public function any(...$arguments)
    {
        $this->assert(new Assertions\AlternativeAny(['options' => Utils::variadicToArray($arguments)]));

        return $this;
    }
}
