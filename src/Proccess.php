<?php

namespace Tiny;

use Callwoola\SearchSuggest\Suggest;

class Proccess extends Container
{

    public function __construct()
    {
        parent::__construct();

        // processing search suggest
        $this->http->on('request', 'proccessing');

        $this->http->start();
    }


    public function proccessing($request, $response)
    {
        $params = $request->get;

        $word = $params['word'];

        // config redis
        $suggest = new Suggest(new Predis\Client([
            'scheme'     => 'tcp',
            'host'       => '127.0.0.1',
            'port'       => 6379,
            'persistent' => true,
        ]));

        $results = $suggest->search($word);

        $response->header("Content-Type", "application/json");

        $response->end(
            json_encode($results)
        );
    }

    public function filter()
    {

    }
}

