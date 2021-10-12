<?php

namespace MichaelDrennen\EnvoyerAPI;

use GuzzleHttp\Client;

class Envoyer {

    protected $API_KEY;
    protected $client;
    protected $headers = [];

    const BASE_URI = 'https://envoyer.io/api';
    const TIMEOUT  = 10;

    public function __construct( string $API_KEY ) {
        $this->API_KEY = $API_KEY;
        $config        = [
            // Base URI is used with relative requests
            'base_uri' => self::BASE_URI,
            'timeout'  => self::TIMEOUT,
        ];


        // Get sent with every request.
        $this->headers = [
            'User-Agent'    => 'envoyer-api-client/1.0',
            'Authorization' => 'Bearer ' . $this->API_KEY,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ];

        $this->client = new Client( $config );
    }


    public function projects(){
        $options = [
            'headers' => $this->headers
        ];

        $response = $this->client->get('projects',$options);

        var_dump($response->getBody());
    }
}