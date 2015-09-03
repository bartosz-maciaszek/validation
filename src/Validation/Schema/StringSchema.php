<?php

namespace Validation\Schema;

use Validation\Assertions;
use Validation\Utils;

class StringSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsString());
    }

    /**
     * @param $number
     * @return $this
     */
    public function min($number)
    {
        $this->assert(new Assertions\MinLength(['number' => $number]));

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function max($number)
    {
        $this->assert(new Assertions\MaxLength(['number' => $number]));

        return $this;
    }

    /**
     * @param ...$arguments
     * @return $this
     */
    public function valid(...$arguments)
    {
        $this->assert(new Assertions\InArray(['allowed' => Utils::varadicToArray($arguments)]));

        return $this;
    }

    /**
     * @param ...$arguments
     * @return $this
     */
    public function invalid(...$arguments)
    {
        $this->assert(new Assertions\NotInArray(['disallowed' => Utils::varadicToArray($arguments)]));

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function length($length)
    {
        $this->assert(new Assertions\Length(['number' => $length]));

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
     * @return $this
     */
    public function alphanum()
    {
        $this->assert(new Assertions\AlphaNum());

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
    public function lowercase($convert = true)
    {
        $this->assert(new Assertions\Lowercase(['convert' => $convert]));

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function uppercase($convert = true)
    {
        $this->assert(new Assertions\Uppercase(['convert' => $convert]));

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
     * @param null $options
     * @return $this
     */
    public function uri($options = null)
    {
        $this->assert(new Assertions\Uri(['options' => $options]));

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function trim($convert = true)
    {
        $this->assert(new Assertions\Trim(['convert' => $convert]));

        return $this;
    }
}
