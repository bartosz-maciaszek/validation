<?php

namespace Validation\Schema;

use Validation\Utils;
use Validation\ValidationException;

class StringSchema extends AbstractSchema
{
    public function __construct()
    {
        $this->addAssertion(function($value) {

            if (!is_string($value)) {
                throw new ValidationException('value is not a string');
            }

            return $value;
        });
    }

    /**
     * @param $number
     * @return $this
     */
    public function min($number)
    {
        $this->addAssertion(function($value) use ($number) {

            if (strlen($value) < $number) {
                throw new ValidationException(sprintf('value length < %d', $number));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param $number
     * @return $this
     */
    public function max($number)
    {
        $this->addAssertion(function($value) use ($number) {

            if (strlen($value) > $number) {
                throw new ValidationException(sprintf('value length > %d', $number));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param ...$arguments
     * @return $this
     */
    public function valid(...$arguments)
    {
        $validValues = Utils::varadicToArray($arguments);

        $this->addAssertion(function($value) use ($validValues) {

            if (!in_array($value, $validValues)) {
                throw new ValidationException(sprintf('"%s" is not allowed', $value));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param ...$arguments
     * @return $this
     */
    public function invalid(...$arguments)
    {
        $invalidValues = Utils::varadicToArray($arguments);

        $this->addAssertion(function($value) use ($invalidValues) {

            if (in_array($value, $invalidValues)) {
                throw new ValidationException(sprintf('"%s" is disallowed', $value));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param $length
     * @return $this
     */
    public function length($length)
    {
        $this->addAssertion(function($value) use ($length) {

            if (strlen($value) != $length) {
                throw new ValidationException(sprintf('value length is %d, expected %d', strlen($value), $length));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param $pattern
     * @return $this
     */
    public function regex($pattern)
    {
        $this->addAssertion(function($value) use ($pattern) {

            if (!preg_match($pattern, $value)) {
                throw new ValidationException(sprintf('value does not match pattern %s', $pattern));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function alphanum()
    {
        $this->addAssertion(function($value) {

            if (!ctype_alnum($value)) {
                throw new ValidationException('value contains not alphanumeric chars');
            }

            return $value;
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function token()
    {
        $this->addAssertion(function($value) {

            if (!preg_match('/^[A-Za-z0-9_]+$/', $value)) {
                throw new ValidationException('value is not a token');
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function lowercase($convert = true)
    {
        $this->addAssertion(function($value) use ($convert) {

            if ($convert === false && !ctype_lower($value)) {
                throw new ValidationException('value must be lowercase');
            }

            return strtolower($value);
        });

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function uppercase($convert = true)
    {
        $this->addAssertion(function($value) use ($convert) {

            if ($convert === false && !ctype_upper($value)) {
                throw new ValidationException('value must be uppercase');
            }

            return strtoupper($value);
        });

        return $this;
    }

    /**
     * @param $search
     * @param $replace
     * @return $this
     */
    public function replace($search, $replace)
    {
        $this->addAssertion(function($value) use ($search, $replace) {
            return str_replace($search, $replace, $value);
        });

        return $this;
    }

    /**
     * @param $pattern
     * @param $replace
     * @return $this
     */
    public function regexReplace($pattern, $replace)
    {
        $this->addAssertion(function($value) use ($pattern, $replace) {
            return preg_replace($pattern, $replace, $value);
        });

        return $this;
    }

    /**
     * @return $this
     */
    public function email()
    {
        $this->addAssertion(function($value) {

            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                throw new ValidationException(sprintf('"%s" is not a valid email', $value));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param int $options
     * @return $this
     */
    public function ip($options = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)
    {
        $this->addAssertion(function($value) use ($options) {

            if (!filter_var($value, FILTER_VALIDATE_IP, $options)) {
                throw new ValidationException(sprintf('"%s" is not a valid IP address', $value));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param null $options
     * @return $this
     */
    public function uri($options = null)
    {
        $this->addAssertion(function($value) use ($options) {

            if ($options == null) {
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    throw new ValidationException(sprintf('"%s" is not a valid URI', $value));
                }

                return $value;
            }

            if (!filter_var($value, FILTER_VALIDATE_URL, $options)) {
                throw new ValidationException(sprintf('"%s" is not a valid URI', $value));
            }

            return $value;
        });

        return $this;
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function trim($convert = true)
    {
        $this->addAssertion(function($value) use ($convert) {

            if ($convert === false && trim($value) !== $value) {
                throw new ValidationException('value is not trimmed');
            }

            return trim($value);
        });

        return $this;
    }
}
