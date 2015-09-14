## Table of contents

- [Example](#example)
- [Usage](#usage)
    - [`validate($value, $schema[, $callback])`](#validatevalue-schema-callback)
    - [`assert($value, $schema)`](#assertvalue-schema)
    - [`attempt($value, $schema)`](#attemptvalue-schema)
    - [`any()`](#any)
        - [`any::custom($callable)`](#anycustomcallable)
        - [`any::defaultValue($value)`](#anydefaultvaluevalue)
        - [`any::invalid($value)`](#anyinvalidvalue)
        - [`any::required()`](#anyrequired)
        - [`any::strip()`](#anystrip)
        - [`any::valid($value)`](#anyvalidvalue)
    - [`arr()`](#arr)
        - [`arr::keys([$keys])`](#arrkeyskeys)
        - [`arr::length($length)`](#arrlengthlength)
        - [`arr::max($length)`](#arrmaxlength)
        - [`arr::min($length)`](#arrminlength)
        - [`arr::notEmpty()`](#arrnotempty)
    - [`boolean()`](#array)
        - [`boolean::false()`](#booleanfalse)
        - [`boolean::true()`](#booleantrue)
    - [`closure()`](#closure)
    - [`date()`](#date)
        - [`date::dateTimeObject($convert)`](#datedatetimeobjectconvert)
    - [`number()`](#number)
        - [`number::integer()`](#numberinteger)
        - [`number::float()`](#numberfloat)
    - [`object()`](#object)
        - [`object::instance($className)`](#objectinstanceclassname)
    - [`resource()`](#resource)
    - [`string()`](#string)
        - [`string::alphanum()`](#stringalphanum)
        - [`string::email()`](#stringemail)
        - [`string::ip($options)`](#stringipoptions)
        - [`string::length($length)`](#stringlengthlength)
        - [`string::lowercase($convert)`](#stringlowercaseconvert)
        - [`string::max($length)`](#stringmaxlength)
        - [`string::min($length)`](#stringminlength)
        - [`string::regex($pattern)`](#stringregexpattern)
        - [`string::regexReplace($pattern, $replace)`](#stringregexreplacepattern-replace)
        - [`string::replace($search, $replace)`](#stringreplacesearch-replace)
        - [`string::token()`](#stringtoken)
        - [`string::trim($convert)`](#stringurloptions)
        - [`string::uppercase($convert)`](#stringuppercaseconvert)
        - [`string::url($options)`](#stringurloptions)
    - [`alternative()`](#alternative)
        - [`string::any($schemas)`](#alternativeanyschemas)

# Example

```php
<?php

use Validation\Validation as V;

$schema = V::arr()->keys([
    'username' => V::string()->alphanum()->min(3)->max(30),
    'password' => V::string()->regex('/[a-z-A-Z0-9]{3,30}/'),
    'birthyear' => V::number()->integer()->min(1900)->max(2013),
    'email' => V::string()->email(),
    'sex' => V::string()->valid('male', 'female')
]);

$input = [
    'username' => 'foobar',
    'password' => 'dupa.8',
    'birthyear' => 1980,
    'email' => 'foobar@example.com'
];

V::validate($input, $schema, function ($err, $output) {
    // $err === null -> valid!
});
```

The code snippet illustrates how to check an input array against a set of constraints:
* `username`
    * must be a string
    * must contain only alphanumeric characters
    * the length must be between 3 and 30 alphanumeric characters
* `password`
    * must be a string
    * must satisfy the custom regex
* `birthyear`
    * an integer between 1900 and 2013
* `email`
    * a valid email address string
* `sex`
    * "male" or "female" string, any other values are disallowed

Once validation process has completed, the callback is invoked. If there was a failure, `$err` argument contains
`ValidationException` object and `$output` argument is `null`. Otherwise `$err` argument is `null` and
`$output` argument contains validated/filtered input value. 

# Usage

### `validate($value, $schema[, $callback])`

Validates the given `$value` against `$schema` and, if `$callback` attribute is specified, invokes
the callback with attributes `$err` and `$output` as described above. If `$callback` is not specified, the method
returns an array with two keys: `err` and `output`.

Examples with callback:

```php
V::validate('string', V::string(), function ($err, $output) {
    // $err is null
    // $output is 'string'
});
```

```php
V::validate('string', V::number(), function ($err, $output) {
    // $err contains the ValidationException object
    // $output is null
});
```

Examples without callback:

```php
$result = V::validate('string', V::string());

// $result['err'] is null
// $result['output'] is 'string'
```

```php
$result = V::validate('string', V::number());

// $result['err'] contains the ValidationException object
// $result['output'] is null
```

### `assert($value, $schema)`

Validates given `$value` against `$schema` and throws `ValidationException` if validation fails.
This method does not return any value.

```php
V::assert('string', V::string()); // No exception
V::assert('string', V::number()); // ValidationException is thrown
```

### `attempt($value, $schema)`

Validates given `$value` against `$schema` and throws `ValidationException` if validation fails.
Otherwise it returns validated/filtered value.

### `any()`

Does not check the input value for any specific type and gives access to the shared assertions like `valid`
or `invalid`.

```php
V::attempt('string', V::any()); // 'string'
V::attempt(123, V::any()); // 123
V::attempt(null, V::any()); // null
```

#### `any::custom($callable)`

Applies a custom validation implemented as a callback or any other callable expression. The callable need to accept
one parameter, which is an `InputValue` object. To raise a validation error, callable needs to throw
`ValidationException`. If exception is not thrown, library assumes the input value is valid.

```php
V::attempt('string', V::any()->custom(function (InputValue $input) {
    if ($input->getValue() !== 'string') {
        throw new ValidationException('A custom validation message');
    }
})); // Success - the result is 'string'

V::attempt('string', V::any()->custom(function (InputValue $input) {
    if ($input->getValue() === 'string') {
        throw new ValidationException('A custom validation message');
    }
})); // ValidationException with message 'A custom validation message' is thrown
```

Custom callable also supports transformations.

```php
V::attempt('string', V::string()->custom(function (InputValue $input) {
    $input->replace(function ($value) {
        return md5($value);
    });
    // above is the same as: $input->setValue(md5($input->getValue()));
})); // Result is 'b45cffe084dd3d20d928bee85e7b0f21'
```

#### `any::defaultValue($value)`

Sets a default value if the relevant array key is missing. `$value` attribute might be a callback.

Example:

```php
$input = [ 'firstname' => 'Smok', 'lastname' => 'Wawelski' ];

$schema = V::arr()->keys([
    'firstname' => V::string(),
    'lastname' => V::string(),
    'username' => V::string()->default(function ($context) {
        return strtolower($context['firstname'] . '-' . $context['lastname']);
    }),
    'created' => V::date()->default(new \DateTime),
    'status' => V::string()->default('registered')
]);

$user = V::attempt($input, $schema);

// $user['firstname'] - 'Smok'
// $user['lastname'] - 'Wawelski'
// $user['username'] - 'smok-wawelski'
// $user['created'] - instance of \DateTime
// $user['status'] - registered
```

#### `any::invalid($value)`

This shared assertion checks if the input value is none of the passed values.

```php
V::attempt('a', V::any()->invalid('a')); // ValidationException!
V::attempt('a', V::any()->invalid('a', 'b')); // ValidationException!
V::attempt('a', V::any()->invalid(['a', 'b'])); // ValidationException!
V::attempt('a', V::any()->invalid('c', 'd')); // 'a'
```

#### `any::required()`

Checks if value is not `null` or an empty string.

```php
V::attempt(null, V::any->required()); // ValidationException!
V::attempt('', V::any->required()); // ValidationException!
V::attempt('foo', V::any->required()); // 'foo'
```

#### `any::strip()`

Removes the given array ket from the `$output` value.

```php
$input = [ 'foo' => 'bar', 'baz' => 'quux' ];

$schema = V::arr()->keys([
    'foo' => V::string(),
    'baz' => V::string()->strip()
]);

V::attempt($input, $schema); // -> [ 'foo' => 'bar' ]
```

#### `any::valid($value)`

This shared assertion checks if the input value is one of the passed values.

```php
V::attempt('a', V::any()->valid('a')); // 'a'
V::attempt('a', V::any()->valid('a', 'b')); // 'a'
V::attempt('a', V::any()->valid(['a', 'b'])); // 'a'
V::attempt('a', V::any()->valid('c', 'd')); // ValidationException!
```

### `arr()`

Checks if the input value is an array. Gives access to any array-specific assertions and filters.

```php
V::attempt([], V::arr()); // []
V::attempt(123, V::arr()); // ValidationException!
```

#### `arr::keys($length)`

*To be documented.*

#### `arr::length($length)`

*To be documented.*

#### `arr::max($length)`

*To be documented.*

#### `arr::min($length)`

*To be documented.*

#### `arr::notEmpty($length)`

*To be documented.*


### `boolean()`

Checks if the input value is a boolean. Gives access to any boolean-specific assertions and filters.

#### `boolean::false()`

*To be documented.*

#### `boolean::true()`

*To be documented.*


### `closure()`

Checks if the input value is a closure or any other callable expression.

### `date()`

Checks if the input value is a valid date string or `DateTime` object. Gives access to any date-specific assertions and filters.

#### `date::dateTimeObject()`

*To be documented.*


### `number()`

Checks if the input value is a number. Gives access to any number-specific assertions and filters.

#### `number::integer()`

*To be documented.*

#### `number::float()`

*To be documented.*


### `object()`

Checks if the input value is an object. Gives access to any object-specific assertions and filters.

#### `object::instance($className)`

*To be documented.*


### `resource()`

Checks if the input value is a resource. Gives access to any resource-specific assertions and filters.

### `string()`

Checks if the input value is a string. Gives access to any string-specific assertions and filters.

#### `string::alphanum()`

*To be documented.*

#### `string::email()`

*To be documented.*

#### `string::ip($options)`

*To be documented.*

#### `string::length($length)`

*To be documented.*

#### `string::lowercase($convert)`

*To be documented.*

#### `string::max($length)`

*To be documented.*

#### `string::min($length)`

*To be documented.*

#### `string::regex($pattern)`

*To be documented.*

#### `string::regexReplace($pattern, $replace)`

*To be documented.*

#### `string::replace($search, $replace)`

*To be documented.*

#### `string::token()`

*To be documented.*

#### `string::uppercase($convert)`

*To be documented.*

#### `string::trim($convert)`

*To be documented.*

#### `string::url($options)`

*To be documented.*


### `alternative()`

Enables alternative schema. Details below.

#### `alternative::any($schemas)`

*To be documented.*
