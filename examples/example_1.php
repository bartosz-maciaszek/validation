<?php
require '../vendor/autoload.php';

use Validation\Validation as V;

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
    var_dump($err);
    var_dump($output);
    exit;
});