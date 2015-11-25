<?php

namespace Validation\Schema;

use Validation\Assertions;

class StringSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsString());
    }

    /**
     * @return $this
     */
    public function alphanum()
    {
        $this->assert(new Assertions\StringAlphaNum());

        return $this;
    }

    /**
     * @return $this
     */
    public function email()
    {
        $this->assert(new Assertions\Email());

        return $this;
    }

    /**
     * @param int $options
     * @return $this
     */
    public function ip($options = null)
    {
        $this->assert(new Assertions\IpAddress(['options' => $options]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function length($length)
    {
        $this->assert(new Assertions\StringLength(['length' => $length]));

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function lowercase($convert = true)
    {
        $this->assert(new Assertions\StringLowercase(['convert' => $convert]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function max($length)
    {
        $this->assert(new Assertions\StringLengthMax(['length' => $length]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function min($length)
    {
        $this->assert(new Assertions\StringLengthMin(['length' => $length]));

        return $this;
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function regex($pattern)
    {
        $this->assert(new Assertions\Regex(['pattern' => $pattern]));

        return $this;
    }

    /**
     * @param $pattern
     * @param $replace
     * @return $this
     */
    public function regexReplace($pattern, $replace)
    {
        $this->assert(new Assertions\RegexReplace(['pattern' => $pattern, 'replace' => $replace]));

        return $this;
    }

    /**
     * @param $search
     * @param $replace
     * @return $this
     */
    public function replace($search, $replace)
    {
        $this->assert(new Assertions\StringReplace(['search' => $search, 'replace' => $replace]));

        return $this;
    }

    /**
     * @return $this
     */
    public function token()
    {
        $this->assert(new Assertions\Regex([
            'pattern' => '/^[A-Za-z0-9_]+$/',
            'message' => 'value is not a token'
        ]));

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function uppercase($convert = true)
    {
        $this->assert(new Assertions\StringUppercase(['convert' => $convert]));

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function trim($convert = true)
    {
        $this->assert(new Assertions\StringTrim(['convert' => $convert]));

        return $this;
    }

    /**
     * @param null $options
     * @return $this
     */
    public function uri($options = null)
    {
        $this->assert(new Assertions\Uri(['options' => $options]));

        return $this;
    }

    /**
     * @return $this
     */
    public function notEmpty()
    {
        $this->assert(new Assertions\StringLengthMin(['length' => 1]));

        return $this;
    }
}
