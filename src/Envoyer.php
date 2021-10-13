<?php

namespace MichaelDrennen\EnvoyerAPI;

use GuzzleHttp\Client;
use MichaelDrennen\EnvoyerAPI\Models\Heartbeat;

class Envoyer {

    protected $API_KEY;
    protected $client;
    protected $headers = [];

    const BASE_URI = 'https://envoyer.io/api/';
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


    protected function sendRequest( string $path, array $query = [], string $key = null ) {
        $options = [
            'headers' => $this->headers,
        ];

        if( !empty($query)):
            $options['query'] = $query;
        endif;

        $response = $this->client->get( $path, $options );

        $string = (string)$response->getBody();
        $array  = json_decode( $string, TRUE );

        if($key):
            return $array[$key];
        endif;

        return $array;
    }

    public function projects() {
        return $this->sendRequest('projects',[],  'projects');
    }

    public function environment(string $projectId) {
        $query = [
            'key' => 'APP_NAME'
        ];
        return $this->sendRequest('projects/' . $projectId . '/environment', $query, null);
    }


    public function heartbeats(string $projectId): array {
        $heartbeatsFromAPI = $this->sendRequest('projects/' . $projectId . '/heartbeats', [], 'heartbeats');

        $heartbeats = [];
        foreach($heartbeatsFromAPI as $heartbeatFromAPI):
            $heartbeats[] = new Heartbeat($heartbeatFromAPI);
        endforeach;
        return $heartbeats;
    }
}