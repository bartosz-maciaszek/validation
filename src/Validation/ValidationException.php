<?php

namespace Validation;

class ValidationException extends \Exception
{
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}
