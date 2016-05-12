<?php

require __DIR__ . '/vendor/autoload.php';

// config server
$preparing = [
    'redis' => [
        'scheme'     => 'tcp',
        'host'       => '127.0.0.1',
        'port'       => 6379,
        'persistent' => true,
    ],
    'server' => [
        'address' => "0.0.0.0",
        'port'    => 9501,
    ],
];

// initialize server
$test=new Tiny\Proccess($preparing);
$test->filter();