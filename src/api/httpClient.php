<?php

namespace JerryHopper\JamesApiClient\api;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ConnectException;

class httpClient
{
    public $client;

    function __construct( $base_uri,$token = '' ){

        $this->client = new Client([
            'headers'=>['Authorization'=>'Bearer '.$token],
            // Base URI is used with relative requests
            'base_uri' => $base_uri,
            'http_errors' => false,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }

    function checkResponse($res,$validResponses){
        if (!in_array($res->getStatusCode(), $validResponses)) {
            throw new \Exception("UNKNOWN ERROR: ".$res->getStatusCode());
        }
    }


    function GET($method,$uri)
    {

        $client = new GuzzleHttp\Client();

        try {
                $res = $client->request('GET', 'https://api.github.com/user', [
                    'auth' => ['user', 'pass']
                ]);
        }
         catch ( ConnectException $e){
            throw new \Exception( 'Network error!' );
        }
        echo $res->getStatusCode();
        // "200"
        echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        echo $res->getBody();
        // {"type":"User"...'
    }
}