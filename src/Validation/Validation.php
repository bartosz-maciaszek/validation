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
}
