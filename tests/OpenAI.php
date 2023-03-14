<?php

namespace Tests;

use SwowCloud\OpenAI\Client;
use SwowCloud\OpenAI\OpenAI;

it('may create a client', function () {
    $openAI = OpenAI::client('foo');

    expect($openAI)->toBeInstanceOf(Client::class);
});

it('sets organization when provided', function () {
    $openAI = OpenAI::client('foo', 'nunomaduro');

    expect($openAI)->toBeInstanceOf(Client::class);
});
