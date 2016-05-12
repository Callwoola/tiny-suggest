<?php

namespace Tiny;

class Container
{
    /**
     * @var \swoole_http_server
     */
    protected $http;


    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->http = new \swoole_http_server(
            $this->config['server']['address'],
            $this->config['server']['port']
        );
    }
}