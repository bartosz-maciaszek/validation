<?php

namespace Validation;

class ValidationException extends \Exception
{
    /**
     * @var ValidationException[]
     */
    private $errors = [];

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }

    /**
     * @param ValidationException $error
     */
    public function addError(ValidationException $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @param ValidationException[] $errors
     */
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    public function count()
    {
        return count($this->errors);
    }
}
