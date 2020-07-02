<?php

// You can find the keys here : https://apps.twitter.com/

return [
    'debug'               => function_exists('env') ? env('APP_DEBUG', false) : false,

    'API_URL'             => 'api.twitter.com',
    'UPLOAD_URL'          => 'upload.twitter.com',
    'API_VERSION'         => '1.1',
    'AUTHENTICATE_URL'    => 'https://api.twitter.com/oauth/authenticate',
    'AUTHORIZE_URL'       => 'https://api.twitter.com/oauth/authorize',
    'ACCESS_TOKEN_URL'    => 'https://api.twitter.com/oauth/access_token',
    'REQUEST_TOKEN_URL'   => 'https://api.twitter.com/oauth/request_token',
    'USE_SSL'             => true,

    'CONSUMER_KEY'        => function_exists('env') ? env('TWITTER_CONSUMER_KEY', '37d9GT5AM8Z4resWMKwKE8ppa') : '37d9GT5AM8Z4resWMKwKE8ppa',
    'CONSUMER_SECRET'     => function_exists('env') ? env('TWITTER_CONSUMER_SECRET', '3KJPmKJkBG8NP0W0PMGqRGbYlEgiVCe138fvF1vZbDdy4EvYhi') : '3KJPmKJkBG8NP0W0PMGqRGbYlEgiVCe138fvF1vZbDdy4EvYhi',
    'ACCESS_TOKEN'        => function_exists('env') ? env('TWITTER_ACCESS_TOKEN', '269329309-kxWjxiP6kCJNs5wrzOS0Cao3K2y1utdZ8HpoAxYy') : '269329309-kxWjxiP6kCJNs5wrzOS0Cao3K2y1utdZ8HpoAxYy',
    'ACCESS_TOKEN_SECRET' => function_exists('env') ? env('TWITTER_ACCESS_TOKEN_SECRET', 'TCsyOUC8ifHAIrSUWBTwtpuHspsxvSDmmrWz4xm2oEq4L') : 'TCsyOUC8ifHAIrSUWBTwtpuHspsxvSDmmrWz4xm2oEq4L',
];