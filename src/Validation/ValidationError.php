<?php

namespace Validation;

class ValidationError
{
    /**
     * @var string
     */
    private $message = null;

    public function __construct(ValidationException $e)
    {
        $this->setMessage($e->getMessage());
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
