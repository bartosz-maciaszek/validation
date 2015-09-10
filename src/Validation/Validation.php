<?php

namespace Validation;

use Validation\Schema\AbstractSchema;

class Validation
{
    /**
     * @param mixed $value
     * @param AbstractSchema $schema
     * @param \Closure $callback
     */
    public static function validate($value, AbstractSchema $schema, \Closure $callback)
    {
        try {
            $callback(null, $schema->process(new InputValue($value)));
        } catch (ValidationException $e) {
            $callback(new ValidationError($e), null);
        }
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
     * @param ...$arguments
     * @return Schema\AlternativeSchema
     */
    public static function alternative(...$arguments)
    {
        return new Schema\AlternativeSchema(Utils::variadicToArray($arguments));
    }
}
