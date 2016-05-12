<?php

namespace Tiny;

use Predis;
use Callwoola\SearchSuggest\Suggest;

/**
 * Class Proccess
 *
 * @author Neo <call@woola.net>
 * @package Tiny
 */
class Proccess extends Container
{
    protected  $config;

    /**
     * Proccess constructor.
     * @param $preparing
     */
    public function __construct($preparing)
    {
        $this->config = $preparing;

        parent::__construct();
        // processing search suggest
        $this->http->on('request', [$this, 'onProccessing']);

        $this->http->start();
    }

    /**
     * @param $request
     * @param $response
     */
    public function onProccessing($request, $response)
    {
        $word = $this->filter($request->get);

        // return a empty result
        if ($word) {
            $response->end(json_encode([]));
        }

        // config redis
        $suggest = new Suggest(new Predis\Client($this->config['redis']));

        $results = $suggest->search($word);

        $response->header("Content-Type", "application/json");

        $response->end(
            json_encode($results)
        );
    }

    /**
     * @param $get
     * @return bool|string
     */
    public function filter($get)
    {
        if (!isset($get['word'])) {
            return false;
        }

        return urldecode($get['word']);
    }
}

