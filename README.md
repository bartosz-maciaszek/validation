About
-----

Validation library for PHP 5.6+ / PHP 7 / HHVM inspired by [Joi](https://github.com/hapijs/joi) from [Hapi](http://hapijs.com).

[![Build Status](https://travis-ci.org/bartosz-maciaszek/validation.svg?branch=master)](https://travis-ci.org/bartosz-maciaszek/validation)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.4-8892BF.svg)](https://php.net/)
[![Coverage Status](https://coveralls.io/repos/bartosz-maciaszek/validation/badge.svg?branch=master&service=github)](https://coveralls.io/github/bartosz-maciaszek/validation?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/55f33bef3ed894001e000001/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55f33bef3ed894001e000001)


Installation
------------

The recommended way to install the library is through [Composer](http://getcomposer.com)

    composer require bartosz-maciaszek/validation


Examples
--------

Validation with the library is straightforward. You can validate primitives like this:

```php
<?php

use Validation\Validation as V;

V::validate('foobar', V::string(), function($err, $output) {
    if ($err) {
        echo 'Validation failed: ' . $err;
        exit;
    }
    
    echo $output; // 'foobar'
});
```

You can also chain other assertions:

```php
V::validate('user@example.com', V::string()->email(), function($err, $output) {
    // ...
});
```

The library also supports transformations:

```php
V::validate('FooBar', V::string()->lowercase(), function($err, $output) {
    // $output equals 'foobar'!
});
```

Wanna something more complex? Let's try to validate an array!

```php
$input = [
    'username' => 'foobar',
    'password' => 'secret123',
    'birthyear' => 1980,
    'email' => 'foobar@example.com',
    'sex' => 'male'
];

$schema = V::arr()->keys([
    'username' => V::string()->alphanum()->min(3)->max(30),
    'password' => V::string()->regex('/[a-z-A-Z0-9]{3,30}/'),
    'birthyear' => V::number()->integer()->min(1900)->max(2013),
    'email' => V::string()->email(),
    'sex' => V::string()->valid('male', 'female')
]);

V::validate($input, $schema, function ($err, $output) {
    // $err === null -> valid!
});
```

Documentation can be found [here](DOCUMENTATION.md) (please note it's not 100% completed :)).

Tests
-----

To run the unit test, simply install the dependencies and invoke `make test`

    $ make deps
    $ make test

Contributing
------------

Contributions are welcome. If you want to help, please fork the repo and submit a pull request. To maintain the coding style, please make sure your code complies with PSR2 standard.

    $ make cs
