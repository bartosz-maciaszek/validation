## Table of contents

- [Example](#example)
- [Usage](#usage)
    - [`any`](#any)
        - [`any::invalid($value)`](#anyinvalidvalue)
        - [`any::valid($value)`](#anyvalidvalue)
    - [`arr`](#array)
        - [`arr::keys([$keys])`](#arraykeyskeys)
        - [`arr::length($length)`](#arraylengthlength)
        - [`arr::max($length)`](#arraymaxlength)
        - [`arr::min($length)`](#arrayminlength)
        - [`arr::notEmpty()`](#arraynotempty)
    - [`boolean`](#array)
        - [`boolean::false()`](#booleanfalse)
        - [`boolean::true()`](#booleantrue)
    - [`date`](#date)
        - [`date::dateTimeObject($convert)`](#datedatetimeobjectconvert)
    - [`number`](#number)
        - [`number::integer()`](#numberinteger)
        - [`number::float()`](#numberfloat)
    - [`object`](#object)
        - [`object::instance($className)`](#objectinstanceclassname)
    - [`resource`](#resource)
    - [`string`](#string)
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
    - [`alternative`](#alternative)

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

V::validate($input, $schema, function ($err, $validated) {
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

Once validation process has completed, the callback is invoked. If there was a failure, `$err` argument contains `ValidationError` object and `$validated` argument is `null`. Otherwise `$err` argument is `null` and `$validated` argument contains validated/filtered input value. 

# Usage

### `any`

#### `any::invalid($value)`
#### `any::valid($value)`

### `arr`

#### `arr::keys($length)`
#### `arr::length($length)`
#### `arr::max($length)`
#### `arr::min($length)`
#### `arr::notEmpty($length)`

### `boolean`

#### `boolean::false()`
#### `boolean::true()`

### `date`

#### `date::dateTimeObject()`

### `number`

#### `number::integer()`
#### `number::float()`

### `object`

#### `object::instance($className)`

### `resource`

### `string`

#### `string::alphanum()`
#### `string::email()`
#### `string::ip($options)`
#### `string::length($length)`
#### `string::lowercase($convert)`
#### `string::max($length)`
#### `string::min($length)`
#### `string::regex($pattern)`
#### `string::regexReplace($pattern, $replace)`
#### `string::replace($search, $replace)`
#### `string::token()`
#### `string::uppercase($convert)`
#### `string::trim($convert)`
#### `string::url($options)`

### `alternative`
