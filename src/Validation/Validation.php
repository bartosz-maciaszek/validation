<?php

namespace Validation;

use Validation\Schema\AbstractSchema;

class Validation
{
    /**
     * @param $value
     * @param AbstractSchema $schema
     * @param \Closure|null $callback
     * @return mixed
     */
    public static function validate($value, AbstractSchema $schema, \Closure $callback = null)
    {
        if ($callback === null) {
            $callback = function ($err, $validated) {
                return [ 'err' => $err, 'validated' => $validated ];
            };
        }

        try {
            return $callback(null, $schema->process(new InputValue($value)));
        } catch (ValidationException $e) {
            return $callback($e, null);
        }
    }

    /**
     * @param $value
     * @param AbstractSchema $schema
     */
    public static function assert($value, AbstractSchema $schema)
    {
        $schema->process(new InputValue($value));
    }

    /**
     * @param $value
     * @param AbstractSchema $schema
     * @return mixed
     */
    public static function attempt($value, AbstractSchema $schema)
    {
        return $schema->process(new InputValue($value));
    }

    /**
     * @return Schema\AnySchema
     */
    public static function any()
    {
        return new Schema\AnySchema();
    }

    /**
     * @return Schema\StringSchema
     */
    public static function string()
    {
        return new Schema\StringSchema();
    }

    /**
     * @return Schema\ObjectSchema
     */
    public static function object()
    {
        return new Schema\ObjectSchema();
    }

    /**
     * @return Schema\ArraySchema
     */
    public static function arr()
    {
        return new Schema\ArraySchema();
    }

    /**
     * @return Schema\NumberSchema
     */
    public static function number()
    {
        return new Schema\NumberSchema();
    }

    /**
     * @return Schema\DateSchema
     */
    public static function date()
    {
        return new Schema\DateSchema();
    }

    /**
     * @return Schema\BooleanSchema
     */
    public static function boolean()
    {
        return new Schema\BooleanSchema();
    }

    /**
     * @return Schema\ResourceSchema
     */
    public static function resource()
    {
        return new Schema\ResourceSchema();
    }

    /**
     * @return Schema\AlternativeSchema
     */
    public static function alternative()
    {
        return new Schema\AlternativeSchema();
    }
}
