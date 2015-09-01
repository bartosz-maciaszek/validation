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
        $err = null;

        try {
            $value = $schema->validate($value);
        }
        catch (ValidationException $e) {
            $value = null;
            $err = $e->getMessage();
        }
        finally {
            $callback($err, $value);
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
    public function date()
    {
        return new Schema\DateSchema();
    }

    /**
     * @return Schema\BooleanSchema
     */
    public function boolean()
    {
        return new Schema\BooleanSchema();
    }

    /**
     * @return Schema\ResourceSchema
     */
    public function resource()
    {
        return new Schema\ResourceSchema();
    }
}
