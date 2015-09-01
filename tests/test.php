<?php

require_once '../vendor/autoload.php';

use Validation\Validation as V;

V::validate('string', V::string()->min(8)->max(10)->valid(['string', 'strong']), function($err, $validated) {

    if ($err) {
        var_dump($err);
        exit;
    }

    var_dump($validated);
});
