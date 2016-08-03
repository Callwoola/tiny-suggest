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
    const DEFAULT_TYPE = 'default';

    protected $config;

    protected $headers = [
        "Access-Control-Allow-Origin" => "*",
        "Content-Type"                => "application/json",
    ];

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
     * 处理请求
     *
     * @param $request
     * @param $response
     */
    public function onProccessing($request, $response)
    {
        list($word, $type) = $this->filter(isset($request->get) ? $request->get : '');

        foreach ($this->headers as $name => $value) {
            $response->header($name, $value);
        }

        // return a empty result
        if (!$word) {
            return $response->end(json_encode([]));
        }

        $config = [];
        
        if (isset($this->config['redis']['database'])) {
            $config['database'] = $this->config['redis']['database'];
        }

        if (isset($this->config['redis']['database'])) {
            $config['database'] = $this->config['redis']['database'];
        }
        
        // config redis
        $suggest = new Suggest(new Predis\Client($this->config['redis']), $config);

        $results = $suggest->search($word, $type);

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

        return [
            urldecode($get['word']),
            urldecode(
                (isset($get['type']) AND !empty($get['type'])) ? $get['type'] : self::DEFAULT_TYPE
            ),
        ];
    }
}

