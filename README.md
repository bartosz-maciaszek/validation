About
-----

Validation library for PHP 5.6+ inspired by [Joi](https://github.com/hapijs/joi) from [Hapi](http://hapijs.com).

[![Build Status](https://travis-ci.org/bartosz-maciaszek/validation.svg?branch=master)](https://travis-ci.org/bartosz-maciaszek/validation) [![Coverage Status](https://coveralls.io/repos/bartosz-maciaszek/validation/badge.svg?branch=master&service=github)](https://coveralls.io/github/bartosz-maciaszek/validation?branch=master)


Installation
------------

The recommended way to install the library is through [Composer](http://getcomposer.com)

    composer require bartosz-maciaszek/validation


Examples
--------

Validation with the library is straightforward. You can validate primitives like this:

    <?php
    
    use Validation\Validation as V;
    
    V::validate('foobar', V::string(), function($err, $validated) {
        if ($err) {
            echo 'Validation failed: ' . $err;
            exit;
        }
        
        echo $validated; // 'foobar'
    });

You can also chain other assertions:

    V::validate('user@example.com', V::string()->email(), function($err, $validated) {
        // ...
    });

Library also supports conversions:

    V::validate('FooBar', V::string()->lowercase(), function($err, $validated) {
        // $validated equals 'foobar'!
    });

Wanna something more complex? Let's try to validate an array!

    $input = [
        'foo' => 'bar',
        'baz' => [
            'quux' => 'foo',
            'baz' => 'test-123456',
            'bar' => 123,
            'foo' => 'test123test'
        ]
    ];
    
    $schema = V::arr()->keys([
        'foo' => V::string()->length(3),
        'baz' => V::arr()->keys([
            'quux' => V::string()->valid('foo', 'bar', 'baz')->uppercase(),
            'baz' => V::string()->regex('/^test\-[0-9]+$/'),
            'bar' => V::number()->min(100)->max(200),
            'foo' => V::string()->replace('test', 123)
        ])
    ]);
    
    V::validate($input, $schema, function($err, $validated) {
        var_dump($validated);
    });

Full documentation is on the way.

Tests
-----

To run the unit test, simply install the dependencies and invoke `make test`

    $ make deps
    $ make test

Contributing
------------

Contributions are welcome. If you want to help, please fork the repo and submit a pull request. To maintain the coding style, please make sure your code complies with PSR2 standard.

    $ make cs