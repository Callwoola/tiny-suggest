<?php

namespace Tiny;

class Container
{
    protected $http;

    public function __construct()
    {
        $this->http = new \swoole_http_server("0.0.0.0", 9501);


    }
}